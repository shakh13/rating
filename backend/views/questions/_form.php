<?php

use backend\models\QuestionTitles;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Questions */
/* @var $form yii\widgets\ActiveForm */
$t = QuestionTitles::find()->all();
$titles = \yii\helpers\ArrayHelper::map($t, 'id', 'caption_ru');

$type = \backend\models\Types::find()->all();
$types = \yii\helpers\ArrayHelper::map($type, 'id', 'caption_ru');
array_unshift($types, 'NULL');
?>

<div class="questions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title_id')->dropDownList($titles) ?>

    <?= $form->field($model, 'caption_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'caption_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'caption_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ball')->textInput(['type' => 'number', 'step' => 'any']) ?>

    <?= $form->field($model, 'type_id')->dropDownList($types) ?>

    <?= $form->field($model, 'type2_id')->dropDownList($types) ?>

    <?= $form->field($model, 'position')->textInput(['type' => 'number', 'value' => $model->position]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
