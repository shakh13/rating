<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Types */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="types-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'caption_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'caption_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'caption_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_uz')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
