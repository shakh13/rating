<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="description" content="Рейтинг организации">
    <meta name="author" content="Shaxzod Saidmurodov">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script src="./assets/9479bf0e/jquery.js"></script>
</head>
<body>
<?php $this->beginBody() ?>
    <nav class="navbar navbar-expand-lg fixed-top py-3 navbar-light" id="mainNav">
        <div class="container"> <a class="navbar-brand js-scroll-trigger" href="<?= Yii::$app->urlManager->createUrl(['/']) ?>">ShareBootstrap</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><?= Html::a('Главная страница', ['/'], ['class' => 'nav-link']) ?></li>
                    <li class="nav-item"><?= Html::a('Рейтинг', Yii::$app->urlManager->createUrl(['/']).'#rating', ['class' => 'nav-link js-scroll-trigger']) ?></li>
                    <li class="nav-item"><?= Html::a('Контакт', ['/site/contact'], ['class' => 'nav-link']) ?></li>
                        <?php
                            if (Yii::$app->user->isGuest) {
                                echo Html::a('Вход', ['/site/login'], ['class' => 'nav-link js-scroll-trigger']);
                            } else {
                                ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle rounded" href="#" id="navbarDarkDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
                                            <?= Yii::$app->user->identity->username ?>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                            <div class="dropdown-item">
                                                <?= Html::a('Отправить отчет', ['/site/add-report'], ['class' => 'text-left no-underline']) ?>
                                            </div>
                                            <div class="dropdown-item">
                                                <?= Html::a('Мои отчеты', ['/site/my-reports'], ['class' => 'text-left no-underline']) ?>
                                            </div>
                                            <div class="dropdown-divider"></div>
                                            <div class="dropdown-item">
                                                <?= Html::beginForm(['/site/logout'], 'post') ?>
                                                <?= Html::submitButton(
                                                    'Выход',
                                                    ['class' => 'logout']
                                                ) ?>
                                                <?= Html::endForm() ?>
                                            </div>
                                        </div>
                                    </li>
                                <?php

                            }
                        ?>
                </ul>
            </div>
        </div>
    </nav>

<?= $content ?>

<footer class="pt-4 pb-5 bg-light position-relative">
    <div class="container">
        <div class="row">
            <div class="col-lg-auto mt-4">
                <h5 class="color-3 fw-700 mb-4">ShareBootstrap.com</h5> </div>
            <div class="col-lg-5 mt-4">
                <p class="color-7 mb-0 pr-md-11 pr-lg-0">A super flexible free templates where you can use any element in any layout and they won't break. Seriously.</p>
            </div>
            <div class="col-lg-auto ml-lg-auto mt-4"><a class="color-4 mr-4" href="https://geotechnics.uz" alt="Геофундаментпроект">© 2020 LLC GeoFundamentProject</a></div>
        </div>
        <!--/.row-->
    </div>
    <!--/.container-->
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
