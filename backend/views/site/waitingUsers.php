<?php

    $this->title = 'Пользователи в ожидании';



use yii\bootstrap\Html; ?>
<div class="container">
    <h1><?= $this->title ?></h1>
</div>
<?php
    if ($users){
        ?>
        <table class="table">
            <thead>
                <th scope="col">#</th>
                <th scope="col">Имя пользователья</th>
                <th scope="col">E-mail</th>
                <th scope="col">Название организации</th>
                <th scope="col">Тип организации</th>
                <th scope="col">Дата</th>
                <th scope="col">Подверждающий документ</th>
                <th scope="col"></th>
            </thead>
            <?php
                foreach ($users as $user){
                    ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= $user->username ?></td>
                        <td><?= $user->email ?></td>
                        <td><?= $user->caption ?></td>
                        <td><?= $user->whois->caption_ru ?></td>
                        <td><?= gmdate('d-m-Y H:i:s', $user->created_at) ?></td>
                        <td><?= Html::a($user->document, 'http://rating/users/files/'.$user->document, ['target' => 'blank']) ?></td>
                        <td>
                            <?= Html::a('Подтвердить', ['/site/accept-user', 'id' => $user->id, 'url' => 'waiting-users'], ['class' => 'btn btn-success']) ?>
                            <?= Html::a('Игнорировать', ['/site/ignore-user', 'id' => $user->id, 'url' => 'waiting-users'], ['class' => 'btn btn-warning']) ?>
                            <?= Html::a('Удалить', ['/site/delete-user', 'id' => $user->id, 'url' => 'users'], ['class' => 'btn btn-danger']) ?>
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
            No waiting users
        </div>
        <?php
    }
?>
