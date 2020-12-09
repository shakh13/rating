<?php
namespace frontend\controllers;

use backend\models\Answers;
use backend\models\CreatedAnswers;
use backend\models\Questions;
use backend\models\QuestionTitles;
use backend\models\Whois;
use common\models\User;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Symfony\Component\Console\Question\Question;
use Yii;
use yii\base\InvalidArgumentException;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'add-report', 'my-reports'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'add-report', 'my-reports'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionMyReports(){
        if (Yii::$app->user->isGuest){
            return $this->actionLogin();
        }

        $reports = CreatedAnswers::find()->where(['user_id' => Yii::$app->user->id])->all();

        return $this->render('myReports', [
            'reports' => $reports,
        ]);
    }

    public function actionAddReport(){
        if (Yii::$app->user->isGuest){
             return $this->actionLogin();
        }

        $result = 0; // 0 -> normal; 1->error; 2->done

        $question_titles = QuestionTitles::find()->where(['whois_id' => Yii::$app->user->identity->whois_id])->orderBy('position')->all();

        $getQuestions = Yii::$app->request->post('Question');

        if (!empty($getQuestions)){
            $err = false;

            $qts = QuestionTitles::find()->where(['whois_id' => Yii::$app->user->identity->whois_id])->all();
            foreach ($qts as $qt){
                foreach ($qt->questions as $question){
                    if ($question->type->mime_type == 'file'){
                        if (!isset($_FILES['Question'])){
                            $err = true;
                        }
                    }
                    if ($question->type->mime_type != 'file'){
                        if (!isset($getQuestions[0][$question->id])) {
                            $err = true;
                        }
                    }
                    if ($question->type2_id > 0){
                        if (!isset($getQuestions[1][$question->id])) {
                            $err = true;
                        }
                    }
                }
            }

            if ($err)
                $result = 1;
            else {
                $created_answer = new CreatedAnswers();
                $created_answer->status = 9; // inactive
                $created_answer->user_id = Yii::$app->user->id;
                $created_answer->save();
                $f = isset($_FILES['Question']) ? $_FILES['Question'] : null;
                foreach ($qts as $qt) {
                    foreach ($qt->questions as $question) {
                        $answer = new Answers();
                        $answer->created_answer_id = $created_answer->id;
                        $answer->question_id = $question->id;

                        if ($question->type->mime_type == 'file') {
                            $fdir = './files/'.$created_answer->id;
                            if (!file_exists($fdir))
                                mkdir('./files/' . $created_answer->id);
                            move_uploaded_file($f['tmp_name'][0][$question->id], $fdir.'/'.$question->id.'.'.pathinfo($f['name'][0][$question->id], PATHINFO_EXTENSION));
                            $answer->answer = $question->id.'.'.pathinfo($f['name'][0][$question->id], PATHINFO_EXTENSION);
                        } else if ($question->type->mime_type == 'checkbox') {
                            $answer->answer = $getQuestions[0][$question->id] == 0 ? '0' : '1';
                        } else {
                            $answer->answer = $getQuestions[0][$question->id];
                        }
                        $answer->answer2 = $question->type2_id > 0 ? $getQuestions[1][$question->id] : '';
                        $answer->save();
                    }
                }
                return $this->redirect(['/site/add-report', 'result' => 2]);
            }
        }

        if (isset($_GET['result'])){
            $this->layout = 'signinup';

            $result = htmlspecialchars(trim($_GET['result']));
        }

        if ($result == 2){ // upload is done
            return $this->render('addReportDone');
        } else {
            return $this->render('addReport', [
                'result' => $result,
                'question_titles' => $question_titles
            ]);
        }
    }

    public function actionRating($id){
        $whois = Whois::findOne($id);
        $users = User::find()->where(['whois_id' => $id])->all();

        $rating = [];

        foreach ($users as $user){
            if ($user->lastAnswer){
                $r = 0;
                foreach ($user->lastAnswer->answers as $answer){
                    if ($answer->question->type->mime_type != 'file')
                        $r += $answer->answer * $answer->question->ball;
                }
                $rating[$user->id] = $r;
            }
        }

        arsort($rating);

        return $this->render('rating', [
            'whois' => $whois,
            'rating' => $rating,
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $whoises = Whois::find()->limit(3)->all();
        return $this->render('index', [
            'whoises' => $whoises
        ]);
    }


    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'signinup';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        $this->layout  = 'signinup';

        $whois = Whois::find()->all();

        return $this->render('signup', [
            'model' => $model,
            'whois' => $whois,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        $this->layout = 'signinup';

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        $this->layout = 'signinup';

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
