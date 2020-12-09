<?php

$this->title = "Отчет отправлен";

?>
<main role="main" style="margin: auto;">
    <div class="alert alert-success" role="alert" >
        <h4 class="alert-heading">Отлично сработано!</h4>
        <p>Вы успешно отправили отчет. Ваш запрос будет рассмотрен в течение 24 часов.</p>
        <hr>
        <p class="mb-0"><?= \yii\helpers\Html::a('Главная страница', ['/site/index']) ?></p>
    </div>
</main>