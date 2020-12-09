<?php

use backend\models\CreatedAnswers;
use yii\bootstrap\Html;

    $this->title = "Отчет #".$created_answer->id;
    $table_class = [
        0 => [
            0 => '',
            1 => 'bg-danger',
            9 => 'bg-warning',
            10 => 'bg-success',
        ],
        1 => [
            0 => 'Удален',
            1 => 'Игнорирован',
            9 => 'В ожидании',
            10 => 'Принято',
        ]
    ];

    $r = CreatedAnswers::getRep($created_answer);
?>
<div class="container">
    <h1 class="<?= $table_class[0][$r['status']] ?>"><?= $this->title.' - '.$table_class[1][$r['status']].'. '.round($r['ball']).' бал' ?></h1>
    <table class="table">
        <thead>
            <th scope="col">#</th>
            <th scope="col">Вопрос</th>
            <th scope="col">Бал</th>
            <th scope="col">Ответ</th>
            <th scope="col">Ответ 2</th>
        </thead>
        <?php
            foreach ($created_answer->answers as $answer){
                ?>
                <tr>
                    <td class="bg-warning"><?= $answer->id ?></td>
                    <td class="bg-info"><?= $answer->question->caption_ru ?></td>
                    <td class="bg-warning"><?= $answer->question->ball ?></td>
                    <td class="bg-info">
                        <?= $answer->question->type->mime_type == 'file'
                            ? 'Файл <b>'.Html::a($answer->answer, 'http://rating/files/'.$created_answer->id.'/'.$answer->answer, ['target' => 'blank']).'</b>'
                            : $answer->question->type->caption_ru.': <b>'.$answer->answer.'</b> '.$answer->question->type->short_ru ?>
                    </td>
                    <td class="bg-warning"><?= $answer->question->type2_id > 0 ? ($answer->question->type2->caption_ru.': <b>'.$answer->answer2.'</b> '.$answer->question->type2->short_ru) : '' ?></td>
                </tr>
                <?php
            }
        ?>
    </table>
    <?= Html::a('Принять', ['/site/accept-report', 'id' => $created_answer->id], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Удалить', ['/site/delete-report', 'id' => $created_answer->id], ['class' => 'btn btn-danger']) ?>
    <br><br>
    <?= Html::beginForm(['/site/ignore-report'], 'post', ['class' => 'form-inline']) ?>
        <?= Html::hiddenInput('id', $created_answer->id) ?>
        <div class="form-group">
            <label for="ignoreComment" class="sr-only">Комментарий</label>
            <input type="text" class="form-control" id="ignoreComment" name="ignoreComment" value="Ваш документ не является оригинальным">
        </div>
        <?= Html::submitButton('Игнорировать', ['class' => 'btn btn-warning']) ?>
    <?= Html::endForm() ?>

</div>
