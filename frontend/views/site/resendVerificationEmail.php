<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Отправить письмо с подтверждением';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(['id' => 'resend-verification-email-form', 'options' => ['class' => 'form-signin']]); ?>
<img class="mb-4" src="./assets/img/bootstrap-solid.svg" alt="" width="72" height="72">
<h1 class="h3 mb-3 font-weight-normal"><h1><?= Html::encode($this->title) ?></h1></h1>
<p>Пожалуйста, заполните вашу электронную почту. Ссылка для сброса пароля будет отправлена туда.</p>
<label for="inputEmail" class="sr-only">Email адрес</label>
<input type="email" id="inputEmail" class="form-control mb-4" placeholder="Email адрес" required="" autofocus="" name="ResendVerificationEmailForm[email]">

<?= Html::submitButton('Отправить', ['class' => 'btn btn-lg btn-primary btn-block', 'name' => 'signup-button']) ?>
<?php ActiveForm::end(); ?>