<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Вход в систему';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['class' => 'form-signin']]); ?>
    <img class="mb-4" src="./assets/img/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Вход в систему</h1>
    <label for="inputEmail" class="sr-only">Имя пользователья</label>
    <input type="text" id="inputEmail" class="form-control" placeholder="Имя пользователья" required="" autofocus="" name="LoginForm[username]">
    <label for="inputPassword" class="sr-only">Пароль</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Пароль" required="" name="LoginForm[password]">
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me" name="LoginForm[rememberMe]"> Запомнить
        </label>
    </div>
    <?= Html::submitButton('Войти', ['class' => 'btn btn-lg btn-primary btn-block', 'name' => 'signup-button']) ?>
    <br>
    <p>
        <small>Нет аккаунта? <?= Html::a('Создайте его', ['/site/signup']) ?></small>
    </p>
    <p>
        <small>
            Забыли пароль? <?= Html::a('Сброс пароля', ['site/request-password-reset']) ?>.
            <br>
            <?= Html::a('Отправить', ['site/resend-verification-email']) ?> новое письмо с подтверждением
        </small>
    </p>
    <p class="mt-5 mb-3 text-muted">© 2005-2020</p>


<?php ActiveForm::end(); ?>