<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['class' => 'form-signup', 'enctype' => 'multipart/form-data']]); ?>
<img class="mb-4" src="./assets/img/bootstrap-solid.svg" alt="" width="72" height="72">
<h1 class="h3 mb-3 font-weight-normal">Регистрация</h1>
<div class="form-group"  style="text-align: left">
    <label for="whois">Мы</label>
    <select class="form-control mb-3" id="whois" name="SignupForm[whois_id]" autofocus="">
        <?php
            foreach ($whois as $w){
                ?>
                    <option value="<?= $w->id ?>"><?= $w->caption_ru ?></option>
                <?php
            }
        ?>
    </select>

    <div class="form-group">
        <label for="inputOrgName">Название организации</label>
        <input type="text" id="inputOrgName" name="SignupForm[caption]" class="form-control" placeholder="Название организации" required="">
    </div>

    <div class="form-group">
        <label for="inputEmail">Email адрес</label>
        <input type="email" id="inputEmail" name="SignupForm[email]" class="form-control" placeholder="Email адрес" required="">
    </div>

    <div class="form-group">
        <label for="inputUsername">Логин</label>
        <input type="text" id="inputUsername" name="SignupForm[username]" class="form-control" placeholder="Логин" required="">
    </div>

    <div class="form-group">
        <label for="inputPassword">Пароль</label>
        <input type="password" id="inputPassword" name="SignupForm[password]" class="form-control" placeholder="Пароль" required="">
    </div>

    <div class="custom-file mb-3">
        <input type="file" class="custom-file-input" name="SignupForm[documentFile]" id="inputDocument" accept="application/pdf, application/msword, image/jpeg, image/x-png" required>
        <label class="custom-file-label" for="inputDocument">Подтверждающий документ</label>
    </div>
    <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-lg btn-primary btn-block', 'name' => 'signup-button']) ?>
</div>

<?php ActiveForm::end(); ?>
