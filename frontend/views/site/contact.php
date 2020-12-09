<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Контакт';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact_header jumbotron text-center">
    <h1 class="display-4">Свяжитесь с нами</h1>
    <p>Пожалуйста, свяжитесь с нами, если у вас есть какие-либо вопросы или вопросы.</p>
</div>
<div class="site-contact">

    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
    <div class="contact_form_wrapper container mb-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="contact_form">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                        </div>
                        <div class="col-12 col-sm-6">
                            <?= $form->field($model, 'email') ?>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-12">
                            <?= $form->field($model, 'subject') ?>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-12">
                            <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-12">
                            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                            ]) ?>
                        </div>
                    </div>
                    <div class="row text-center mt-2">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
