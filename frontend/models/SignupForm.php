<?php
namespace frontend\models;

use Throwable;
use Yii;
use yii\base\Model;
use common\models\User;
use backend\models\Whois;
use yii\db\StaleObjectException;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $caption;
    public $whois_id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Это имя пользователя уже занято'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот адрес электронной почты уже занят'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            ['caption', 'trim'],
            ['caption', 'required'],
            ['caption', 'unique', 'targetClass' => '\common\models\User', 'message' => 'С этин названием организации зарегистрирован другой пользователь'],

            [['whois_id'], 'exist', 'skipOnError' => true, 'targetClass' => Whois::className(), 'targetAttribute' => ['whois_id' => 'id']],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function signup()
    {

        if (!$this->validate()) {
        //    return null;
        }


        print_r($this->errors);
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->caption = $this->caption;
        $user->whois_id = $this->whois_id;

        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        if ($user->save()){
            if (isset($_FILES['SignupForm'])){
                $file = $_FILES['SignupForm'];
                $dir = './users/files/';
                move_uploaded_file($file['tmp_name']['documentFile'], $dir.$user->id.'.'.pathinfo($file['name']['documentFile'], PATHINFO_EXTENSION));
                $user->document = $user->id.'.'.pathinfo($file['name']['documentFile'], PATHINFO_EXTENSION);
                $user->save();
                return true;
            } else {
                $user->delete();
                return false;
            }
        } else {
            return false;
        }
    }
}
