<?php

/* @var $this yii\web\View */

use backend\models\CreatedAnswers;
use yii\helpers\Html;

$this->title = 'Админ';
$table_class = [
    0 => [
        0 => '',
        1 => 'bg-danger',
        9 => 'bg-warning',
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

<div class="container">
    <h1><?= $user ? 'Отчеты '.$user->username : 'Отчеты в ожидании' ?></h1>
</div>

<?php
    if (count($created_answers) > 0){
        ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Организиция</th>
              <th scope="col">Пользователь</th>
              <th scope="col">Бал</th>
              <th scope="col">Статус</th>
              <th scope="col">Дата</th>
              <th scope="col"></th>
            </tr>
          </thead>
            <?php
            foreach ($created_answers as $created_answer){
                $r = CreatedAnswers::getRep($created_answer);
                ?>
                <tr>
                    <th scope="row"><?= $created_answer->id ?></th>
                    <td><?= $created_answer->user->caption ?></td>
                    <td><?= $created_answer->user->username ?></td>
                    <td><b><?= round($r['ball']) ?></b></td>
                    <td><label class="<?= $table_class[0][$r['status']] ?>"> <?= $table_class[1][$r['status']]?> </label></td></td>
                    <td><?= $created_answer->created_at ?></td>
                    <td>
                        <?= Html::a('Смотреть', ['/site/view-report', 'id' => $created_answer->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Принять', ['/site/accept-report', 'id' => $created_answer->id], ['class' => 'btn btn-success']) ?>
                        <?= Html::a('Удалить', ['/site/delete-report', 'id' => $created_answer->id], ['class' => 'btn btn-danger']) ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    } else {
        ?>
        <div class="alert alert-danger" role="alert">
            No reports
        </div>
        <?php
    }
?>