<?php
use \common\models\User;

$this->title = 'Рейтинг';

$categories = [
    0 => [
        'caption' => 'A',
        'sub_categories' => [
            0 => [
                'caption' => 'AAA',
                'from' => 85,
                'to' => 101,
            ],
            2 => [
                'caption' => 'AA',
                'from' => 75,
                'to' => 85,
            ],
            3 => [
                'caption' => 'A',
                'from' => 65,
                'to' => 75,
            ],
        ]
    ],
    1 => [
        'caption' => 'B',
        'sub_categories' => [
            0 => [
                'caption' => 'BBB',
                'from' => 55,
                'to' => 65,
            ],
            2 => [
                'caption' => 'BB',
                'from' => 40,
                'to' => 55,
            ],
            3 => [
                'caption' => 'B',
                'from' => 35,
                'to' => 40,
            ],
        ]
    ],
    2 => [
        'caption' => 'C',
        'sub_categories' => [
            0 => [
                'caption' => 'CCC',
                'from' => 30,
                'to' => 35,
            ],
            2 => [
                'caption' => 'CC',
                'from' => 25,
                'to' => 30,
            ],
            3 => [
                'caption' => 'C',
                'from' => 20,
                'to' => 25,
            ],
        ]
    ],
    3 => [
        'caption' => 'D',
        'sub_categories' => [
            0 => [
                'caption' => 'DDD',
                'from' => 7,
                'to' => 20,
            ],
            2 => [
                'caption' => 'DD',
                'from' => 5,
                'to' => 7,
            ],
            3 => [
                'caption' => 'D',
                'from' => 0,
                'to' => 5,
            ],
        ]
    ],
];

function toPersent($val, $max){
    return $max != 0 ? $val / $max * 100 : 0;
}

?>
<main role="main">
    <section class="py-5 position-relative">
        <div class="shape-wrap shape-header"><img src="./assets/img/blob-shape-1.svg" alt=""></div>
        <div class="container">
            <div class="row align-items-center text-center text-lg-left mb-5">
                <div class="col-md-9 col-lg-6 col-xl-5 mb-4 mb-md-5 mb-lg-0">
                    <h2 class="h1">We’re a growing team of makers and doers</h2>
                    <p class="lead">Berspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                    <a href="#" class="lead">Check this out</a>
                </div>
                <div class="col-md-9 col-lg-6 col-xl-7 text-center">

                    <img src="./assets/img/liramail_dribbble.jpg" alt="Image" class="img-fluid rounded">

                </div>
            </div>
            <!-- end: -->

        </div>
    </section>
    <div class="container">
        <hr>
    </div>
    <div class="space-md">
        <div class="container">
            <div class="row d-flex justify-content-center mb-sm-3">
                <div class="col-md-9 text-center">
                    <h3 class="h1 mb-4"><?= $whois->title_ru ?></h3> </div>
            </div>
            <hr>

            <?php
                if (!empty($rating)){
                    if ($whois->id == 1 || $whois->id == 3){
                        // Проектный институт, строительная компания
                        $maxval = array_values($rating)[0];
                        ?>
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <?php
                            $i = 0;
                            foreach ($categories as $cat){
                                ?>
                                <a class="nav-link <?= $i > 0 ? '' : 'active' ?>"
                                   id="nav-category-<?= $cat['caption'] ?>-tab"
                                   data-toggle="tab"
                                   href="#category-<?= $cat['caption'] ?>"
                                   role="tab"
                                   aria-controls="category-<?= $cat['caption'] ?>"
                                   aria-selected="<?= $i > 0 ? 'false' : 'true' ?>">Категория <?= $cat['caption'] ?></a>
                                <?php
                                $i++;
                            }
                            ?>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <?php
                                $i = 0;
                                foreach ($categories as $cat){
                                    ?>
                                    <div class="tab-pane fade show <?= $i > 0 ? '' : 'active' ?>" id="category-<?= $cat['caption'] ?>" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <br>
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-sub-tab-<?= $cat['caption'] ?>" role="tablist">
                                                <?php
                                                    $j = 0;
                                                    foreach ($cat['sub_categories'] as $sub){
                                                        ?>
                                                        <a
                                                                class="nav-link <?= $j > 0 ? '' : 'active' ?>"
                                                                id="nav-home-tab"
                                                                data-toggle="tab"
                                                                href="#sub-category-<?= $sub['caption'] ?>"
                                                                role="tab"
                                                                aria-controls="sub-category-<?= $sub['caption'] ?>"
                                                                aria-selected="true">
                                                            Подкатегория <?= $sub['caption'] ?>
                                                        </a>
                                                        <?php
                                                        $j++;
                                                    }
                                                ?>
                                            </div>
                                        </nav>
                                        <div class="tab-content" id="nav-sub-tab-<?= $cat['caption'] ?>Content">
                                            <?php
                                                $j = 0;
                                                foreach ($cat['sub_categories'] as $sub){
                                                    ?>
                                                    <div class="tab-pane fade show <?= $j > 0 ? '' : 'active' ?>" id="sub-category-<?= $sub['caption'] ?>" role="tabpanel" aria-labelledby="nav-home-tab">
                                                        <br>
                                                        <table class="table">
                                                            <thead class="thead-dark">
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Имя организации</th>
                                                                <th scope="col">Бал</th>
                                                            </tr>
                                                            </thead>
                                                            <?php
                                                            $count = 0;
                                                            foreach ($rating as $user_id => $ball){
                                                                $percent = toPersent($ball, $maxval);
                                                                if ($percent >= $sub['from'] && $percent < $sub['to']){
                                                                    $count++;
                                                                    $user = User::findOne($user_id);
                                                                    ?>
                                                                    <tr>
                                                                        <th scope="row"><?= $count ?></th>
                                                                        <td><?= $user->caption ?></td>
                                                                        <td><?= round($percent).'% - '.round($ball) ?></td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }

                                                            if ($count == 0){
                                                                echo "<tr><td colspan='3'>Пусто</td></tr>";
                                                            }
                                                            ?>
                                                        </table>
                                                    </div>
                                                    <?php
                                                    $j++;
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                    $i++;
                                }
                            ?>
                        </div>
                        <?php
                    } else {
                        // Проектно изыскательский институт
                        ?>
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Имя организации</th>
                                <th scope="col">Бал</th>
                            </tr>
                            </thead>
                            <?php
                            $i = 1;
                            foreach ($rating as $user_id => $ball){
                                $user = User::findOne($user_id);
                                ?>
                                <tr>
                                    <th scope="row"><?= $i ?></th>
                                    <td><?= $user->caption ?></td>
                                    <td><?= round($ball) ?></td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </table>
                        <?php
                    }
                } else {
                    ?>
                    <div class="alert alert-warning" role="alert">
                        Нет организаций
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
</main>
