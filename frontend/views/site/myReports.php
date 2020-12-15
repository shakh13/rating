<?php

use backend\models\CreatedAnswers;

$this->title = "Мои отчеты";

$table_class = [
    0 => [
        0 => 'table-dark',
        1 => 'table-danger',
        9 => 'table-secondary',
        10 => '',
    ],
    1 => [
        0 => 'Удален',
        1 => 'Игнорирован',
        9 => 'В ожидании',
        10 => 'Принято',
    ]
];
?>
<main role="main">
    <section class="py-5 position-relative">
        <div class="shape-wrap shape-header"><img src="./assets/img/blob-shape-1.svg" alt=""></div>
        <div class="container">
            <div class="row align-items-center text-center text-lg-left mb-5">
                <div class="col-md-9 col-lg-6 col-xl-5 mb-4 mb-md-5 mb-lg-0">
                    <h2 class="h1">We’re a growing team of makers and doers</h2>
                    <p class="lead">Berspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                </div>
                <div class="col-md-9 col-lg-6 col-xl-7 text-center">
                    <img src="./assets/img/liramail_dribbble.jpg" alt="Image" class="img-fluid rounded">
                </div>
            </div>
            <!-- end: -->

        </div>
    </section>
    <div class="">
        <div class="container">
            <div class="float-right">
                <?= \yii\helpers\Html::a('+', ['/site/add-report'], ['class' => 'btn btn-success rounded-circle', 'title'=> 'Отправить новый отчет']) ?>
            </div>
            <?php
                if (!empty($reports)){
                    $i = 1;
                    ?>
                    <div class="row d-flex justify-content-center mb-sm-3">
                        <div class="col-md-9 text-center">
                            <h3 class="h1 mb-4">Мои отчеты</h3> </div>
                    </div>
                    <hr>
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Бал</th>
                            <th scope="col">Комментарий</th>
                            <th scope="col">Дата</th>
                            <th>Статус</th>
                        </tr>
                        </thead>
                        <?php
                        foreach ($reports as $report){
                            if ($report->status != 0){
                                $r = CreatedAnswers::getReport($report);
                                ?>
                                <tr class="<?= $table_class[0][$r['status']] ?>">
                                    <th scope="row"><?= $i ?></th>
                                    <td><?= round($r['ball']) ?></td>
                                    <td><?= $report['comment'] ?></td>
                                    <td><?= date_format(new DateTime($report['created_at']), 'H:i d.m.Y') ?></td>
                                    <td><?= $table_class[1][$r['status']] ?></td>
                                </tr>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                    </table>
                    <?php
                } else {
                    ?>
                    <div class="alert alert-warning" role="alert">
                        Нет отчетов
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
</main>
