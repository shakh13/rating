<?php
namespace backend\controllers;

use common\models\User;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\CreatedAnswers;

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
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'view-report', 'delete-report', 'ignore-report', 'accept-report', 'waiting-users', 'ignore-user', 'accept-user', 'delete-user', 'users'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'ignore-report' => ['post']
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $created_answers = null;
        $user = null;
        $user_id = Yii::$app->request->get('user_id');
        if ($user_id){
            $user = User::findOne(['id' => $user_id, 'status' => 10]);
            if ($user){
                $created_answers = CreatedAnswers::find()->where(['user_id' => $user_id])->orderBy('created_at')->all();
            }
        }
        $created_answers = $created_answers ? $created_answers : CreatedAnswers::find()->where(['status' => 9])->orderBy('created_at')->all();

        return $this->render('index', [
            'user' => $user,
            'created_answers' => $created_answers,
        ]);
    }

    public function actionViewReport(){
        $id = Yii::$app->request->get('id');
        if ($id){
            $created_answer = CreatedAnswers::findOne($id);
            if ($created_answer){
                return $this->render('viewReport', [
                    'created_answer' => $created_answer,
                ]);
            } else {
                return $this->render('error', [
                    'name' => 'Ошибка',
                    'message' => 'Отчет не найдено'
                ]);
            }
        } else
            return $this->render('error', [
                'name' => 'Ошибка',
                'message' => 'Страница не найдено'
            ]);
    }

    public function actionDeleteReport($id){
        $created_answer = CreatedAnswers::findOne($id);
        if ($created_answer){
            $created_answer->status = 0;
            $created_answer->save();

            return $this->redirect(['/site/index']);
        } else {
            return $this->render('error', [
                'name' => 'Ошибка',
                'message' => 'Страница не найдено'
            ]);
        }
    }

    public function actionIgnoreReport(){
        $id = Yii::$app->request->post('id');
        $comment = Yii::$app->request->post('ignoreComment');

        if (strlen($id) > 0 && strlen($comment) > 0){
            $created_answer = CreatedAnswers::findOne($id);
            if ($created_answer){
                $created_answer->comment = $comment;
                $created_answer->status = 1;
                $created_answer->save();
            }
        }

        return $this->redirect(['/site/index']);
    }

    public function actionAcceptReport($id){
        $created_answer = CreatedAnswers::findOne($id);
        if ($created_answer){
            $created_answer->status = 10;
            $created_answer->save();
        }
        return $this->redirect(['/site/index']);
    }

    public function actionWaitingUsers(){
        $users = User::find()->where(['status' => 9])->all();
        return $this->render('waitingUsers', [
            'users' => $users
        ]);
    }

    public function actionAcceptUser($id, $url){
        if ($id != 1){
            $user= User::findOne($id);
            if ($user){
                $user->status = 10;
                $user->save();
            }
        }

        return $this->redirect(['/site/'.$url]);
    }

    public function actionIgnoreUser($id, $url){
        if ($id != 1){
            $user = User::findOne($id);
            if ($user){
                $user->status = 1;
                $user->save();
            }
        }

        return $this->redirect(['/site/'.$url]);
    }

    public function actionDeleteUser($id, $url){
        if ($id != 1){
            $user = User::findOne($id);
            if ($user){
                $user->status = 0;
                $user->save();
            }
        }

        return $this->redirect(['/site/'.$url]);
    }

    public function actionUsers(){

        $users = User::find()->where(['not in', 'id', 1])->orderBy(['id' => SORT_ASC])->all();

        return $this->render('users', [
            'users' => $users
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

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
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
