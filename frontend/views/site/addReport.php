<?php

use yii\helpers\Html;

$this->title = "Отправить новый отчет";

?>
<main role="main">
    <div class="contact_header jumbotron text-center">
        <h1 class="display-4"><?= $this->title ?></h1>
        <p>Please Feel to contact us if you have anu question or query.</p>
    </div>
    <div class="contact_form_wrapper container mb-5">
        <br>
        <?= Html::beginForm(['/site/add-report'], 'post', ['id' => 'sendForm', 'class' => 'contact_form', 'enctype' => 'multipart/form-data']) ?>
        <?php
            $i = 0;
            foreach ($question_titles as $qt){
                ?>
                <div id='step<?= $i ?>' <?= $i > 0 ? "class='none'" : ''?>>
                    <div class="text-center">
                        <div class="mb-5">
                            <h3 class="h3"><?= $qt->caption_ru ?></h3>
                        </div>
                    </div>
                    <?php
                        foreach ($qt->questions as $question){
                            ?>
                            <div class="row">
                                <div class="col-12 col-md-6 <?= $question->type2_id > 0 ? " col-lg-6 col-xl-6" : ""?>">
                                    <label for="Question<?= $question->id ?>"><?= $question->caption_ru ?></label>
                                </div>
                                <div class="<?= $question->type2_id > 0 ? "col-6 col-md-3 col-lg-3 col-xl-3" : "col-12 col-md-6"?>">
                                    <div class="input-group mb-3">
                                        <?php
                                            if ($question->type_id != 6){
                                                ?>
                                                <input type="<?= $question->type->mime_type ?>" class="form-control text-center" placeholder="<?= $question->type->caption_ru ?>" required min="0" autofocus id="Question<?= $question->id ?>" name="Question[0][<?= $question->id ?>]">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><?= $question->type->short_ru ?></span>
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <input type="hidden" name="Question[0][<?= $question->id ?>]" value="0">
                                                <input type="<?= $question->type->mime_type ?>" class="form-control text-center" placeholder="<?= $question->type->caption_ru ?>" required min="0" autofocus id="Question<?= $question->id ?>" name="Question[0][<?= $question->id ?>]">
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                                <?php
                                    if ($question->type2_id > 0){
                                        ?>
                                        <div class="col-6 col-md-3 col-lg-3 col-xl-3">
                                            <div class="input-group mb-3">
                                                <input type="<?= $question->type->mime_type ?>" class="form-control text-center" placeholder="<?= $question->type2->caption_ru ?>" id="Question2_<?= $question->id ?>" name="Question[1][<?= $question->id ?>]" required min="0">
                                                <?php
                                                if ($question->type2_id != 6){
                                                    ?>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><?= $question->type2->short_ru ?></span>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    ?>
                </div>
                <?php
                $i++;
            }
        ?>
            <div class="alert alert-danger none" role="alert" id="alertDanger">Заполните все поля</div>
            <div class="progress">
                <div aria-valuemax="<?= count($question_titles) ?>" aria-valuemin="0" class="progress-bar progress-bar-striped progress-bar-animated"
                     id="counter" role="progressbar" style="width: <?= 100/count($question_titles) ?>%;">1/<?= count($question_titles) ?></div>
            </div>
            <br>
            <div class="float-right">
                <!--Шаг <label id="counter">1</label>/6 &nbsp;&nbsp;&nbsp;-->
                <button class="btn btn-primary none" id="prevBtn" type="button">Назад</button>
                <button class="btn btn-primary" id="nextBtn" type="button">Далее</button>
            </div>
            <div class="mb-4"></div>
        <?= Html::endForm() ?>
    </div>
</main>
<script>
    let step = 0;
    $(document).ready(function (){
        $('input').on('blur', function (){
            $(this).css('border-color', $(this).is(':valid') ? 'green' : 'red');
        });

        $('#nextBtn').click(function () {
                let sum = 0;

                elms = $('#step'+step).find('input');

                for (let i = 0; i < elms.length; i++){
                    if ($(elms[i]).val().length === 0)
                        sum++;

                    $(elms[i]).css('border-color', $(elms[i]).is(':valid') ? 'green' : 'red');
                }

                if (sum > 0){
                    $('#alertDanger').removeClass('none');
                } else {
                    $('#alertDanger').addClass('none');
                    if (step === <?= count($question_titles)-1 ?>){
                        $('#sendForm').submit();
                    }
                    else {
                        step += 1;

                        for (let i = 0; i<<?= count($question_titles)+1 ?>; i++) {
                            $('#step' + i).addClass('none');
                        }

                        $('#step' + step).removeClass('none');
                        $('#step' + step + ' input:first').focus();

                        $('#counter').attr('style', 'width: ' + (<?= 100/count($question_titles) ?>*(step+1)) + '%');
                        $('#counter').html((step+1) + '/<?= count($question_titles) ?>');
                    }
                }
            if (step === <?= count($question_titles)-1 ?>){
                $('#nextBtn').html('Отправить');
            }
            if (step > 0){
                $('#prevBtn').removeClass('none');
            }
        });

        $('#prevBtn').click(function(){
            $('#nextBtn').html('Далее');
            if (step === 1){
                $('#prevBtn').addClass('none');
            }
            for (var i = 0; i<<?= count($question_titles)+1 ?>; i++){
                $('#step' + i).addClass('none');
            }
            $('#alertDanger').addClass('none');
            step -= 1;

            $('#step' + step).removeClass('none');
            $('#step' + step + ' input:first').focus();
            $('#counter').attr('style', 'width: ' + (<?= 100/count($question_titles) ?>*(step+1)) + '%');
            $('#counter').html((step+1) + '/<?= count($question_titles) ?>');
        });
    });
</script>