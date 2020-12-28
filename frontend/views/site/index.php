<?php

/* @var $this yii\web\View */

$this->title = 'LiveRating';

$whois_captions = [
    1 => "Проектные институты",
    2 => "Проектно-изыскательские институты",
    3 => "Строительные организации"
]
?>
<header class="header">
    <div class="shape-wrap shape-header"><img src="./assets/img/blob-shape-1.svg" alt=""></div>
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-md-5">
                <div class="headline">
                    <div class="headline-content">
                        <h1 class="headline-title">Рейтинг проектно-изыскательских и строительных организаций</h1>
                        <p class="lead">Это публичный рейтинг, который включает в себя самые популярные организации Республики Узбекистан</p>
                    </div>
                </div>
            </div>
            <div class="col-md-7"> <img src="./assets/img/header-img1.png" alt="" class="img-fluid pt-5"> <img src="./assets/img/person.png" class="img-fluid person-img" class="img-fluid"> </div>
        </div>
    </div>
</header>

<main role="main">

    <div class="container" data-spy="scroll" data-target="#mainNav" data-offset="150">
        <div id="rating">
            <br>
            <br><br>
            <br>
            <div class="row d-flex justify-content-start">
                <div class="col-lg-12">
                    <div class="w-85 mb-5">
                        <h3 class="h1">Определение  рейтинговых показателей проектно-изыскательских и строительных организаций</h3>
                        <div class="row space-sm">
                            <?php
                            foreach ($whoises as $whois){
                                ?>
                                <div class="col-md-4">
                                    <a href="<?= Yii::$app->urlManager->createUrl(['/site/rating', 'id' => $whois->id]) ?>" class="card shadow">
                                        <img src="./assets/img/index/<?= $whois->photo ?>" class="img-fluid card-img-top" alt="">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $whois_captions[$whois->id] ?></h5>
                                            <p class="card-text">
                                            <p><?= $whois->description_ru ?></p>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <p class="lead">
                            Переход с централизованной экономики в рыночную экономику требует иной подход к реализации товаров и услуг, в том числе для проектных, изыскательских и строительных организаций. Кроме государственных предприятий, на рынок вышли и частные предприятия, оказывающие аналогичные услуги. Продержаться на рынке возможно, при соблюдении пропорции спроса и предложения.
                        </p>
                        <p class="lead">
                            Но здесь еще возникает другая сторона вопроса, на сколько качественно производятся их услуги, применение последних технологий и оборудования, введений своих новшеств и изобретений, или вообще иной подход. Каждое предприятие должно иметь свою уникальность, при помощи которой оно выходит на первые ряды и остаётся востребованным на рынке товаров и услуг.
                        </p>
                        <p class="lead">
                            На начальном этапе предприятия производящие такого рода услуг, набирали популярность, благодаря рекомендации из уст в усты, и как основной вид продвижение бизнеса, пользовались рекламой.  Однако не всегда их предоставляемые услуги отвечали требованиям или удовлетворяли потребителей или приходилось пользоваться их услугами от безвыходности.
                        </p>
                        <p class="lead">
                            Сейчас возникает другая тенденция роста и развития проектных, изыскательских и строительных организаций – это рейтинг. Рейтинг — это оценка, основанная на отзывы потребителей и клиентов, которые воспользовались их товарами и услугами.  Это необходимость возникает из-за роста огромного числа проектных, изыскательских и строительных предприятий, институтов и организаций, и в этом океане, появляется проблема с выбором той или иной организации, предприятия или института. В этом случае, рейтинг поможет потребителям и клиентам выбрать именно им подходящий вариант.
                        </p>
                        <p class="lead">
                            Для реализации этой идеи, необходимо все предприятия, организации, учреждения и институты собрать в один единый сайт, где они будут перечислены в каталоге с их услугами. Потенциальный потребитель или клиент зайдя на этот сайт сможет сделать выбрать через поиск как субъекта деятельности, так и по наименованию оказываемых услуг согласно рейтингу и ценовой политике. И рейтинг будет формироваться, согласно отзывам и оценкам прежних клиентов и потребителей и добавляться новыми методом опроса и анкетирования. Таким образом будет формироваться ТОП-10 или ТОП-20 которая в то же время будет являться их рекламой, так же каждая в этих списках организация, предприятие, учреждение или институт будут иметь прямую ссылку перехода на их сайт.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--<section class="space-md bg-image-2 position-relative">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-4">A digital agency for brands that want more.</h1>
                    <div class="row d-flex align-self-baseline">
                        <div class="mr-auto col-md-9">
                            <p class="lead">Building your online presence helps attract more potential clients. Our integrated marketing team will work directly with you to understand what makes your business unique</p>
                        </div>
                        <div class=" col-md-2 offset-md-1"> <a href="#" class="btn btn-secondary btn-lg">Signup here</a> </div>
                    </div>
                </div>
                <div class="row align-items-center mt-3">
                    <div class="col-md-8 text-center">
                        <div class="position-relative">
                            <img src="./assets/img/header-img1.png" alt="" class="img-fluid" style="max-height: 700px;">
                            <img src="assets/img/person-2.png" alt="" class="img-fluid person-2 d-none d-md-block d-lg-block">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex mb-3">
                            <div class="p-2 h2 text-primary"> <i class="fa fa-beer"></i> </div>
                            <div class="ml-auto p-2">
                                <h5>A digital agency for brands that want more.</h5>
                                <p>Building your online presence helps attract more potential clients.</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="p-2 h2 text-primary"> <i class="fa fa-cart-arrow-down"></i></div>
                            <div class="ml-auto p-2">
                                <h5>A digital agency for brands that want more.</h5>
                                <p>Building your online presence helps attract more potential clients.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>-->

</main>