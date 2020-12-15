<?php

/* @var $this yii\web\View */

$this->title = 'Rating';
?>
<header class="header">
    <div class="shape-wrap shape-header"><img src="./assets/img/blob-shape-1.svg" alt=""></div>
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-md-5">
                <div class="headline">
                    <div class="headline-content">
                        <h1 class="headline-title">Рейтинг проектно-изыскательских и строительных организаций</h1>
                        <p class="lead">We collaborate with ambitious people.Let’s build something great.</p>
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
                        <p class="heading -h4">Building strong &amp; impressive portfolios using our free bootstrap templates.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    foreach ($whoises as $whois){
                        ?>
                        <div class="col-md-4">
                            <a href="<?= Yii::$app->urlManager->createUrl(['/site/rating', 'id' => $whois->id]) ?>" class="card shadow">
                                <div class="card-body">
                                    <div class="py-3">
                                        <h5 class="my-3"><?= $whois->caption_ru ?></h5>
                                        <p><?= $whois->description_ru ?></p>
                                    </div><img src="./assets/img/index/<?= $whois->photo ?>" class="img-fluid" alt="">
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>

    <section class="space-md bg-image-2 position-relative">
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
                        <div class="position-relative"> <img src="./assets/img/header-img1.png" alt="" class="img-fluid" style="max-height: 700px;"> <img src="assets/img/person-2.png" alt="" class="img-fluid person-2 d-none d-md-block d-lg-block"> </div>
                    </div>
                    <div class="col-md-4">
                        <!-- icon box -->
                        <div class="d-flex mb-3">
                            <div class="p-2 h2 text-primary"> <i class="fa fa-beer"></i> </div>
                            <div class="ml-auto p-2">
                                <h5>A digital agency for brands that want more.</h5>
                                <p>Building your online presence helps attract more potential clients.</p>
                            </div>
                        </div>
                        <!-- end://icon box -->
                        <!-- icon box -->
                        <div class="d-flex mb-3">
                            <div class="p-2 h2 text-primary"> <i class="fa fa-cart-arrow-down"></i></div>
                            <div class="ml-auto p-2">
                                <h5>A digital agency for brands that want more.</h5>
                                <p>Building your online presence helps attract more potential clients.</p>
                            </div>
                        </div>
                        <!-- end://icon box -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>