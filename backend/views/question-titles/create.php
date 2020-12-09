<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\QuestionTitles */

$this->title = 'Create Question Titles';
$this->params['breadcrumbs'][] = ['label' => 'Question Titles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-titles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
