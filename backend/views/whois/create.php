<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Whois */

$this->title = 'Create Whois';
$this->params['breadcrumbs'][] = ['label' => 'Whois', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="whois-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
