<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\QuestionTitles */
/* @var $form yii\widgets\ActiveForm */
$w = \backend\models\Whois::find()->orderBy('id')->all();
$whois = \yii\helpers\ArrayHelper::map($w, 'id', 'caption_ru');
?>

<div class="question-titles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'whois_id')->dropDownList($whois) ?>

    <?= $form->field($model, 'caption_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'caption_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'caption_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput(['type' => 'number']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
