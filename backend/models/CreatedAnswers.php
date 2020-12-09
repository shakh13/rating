<?php

namespace backend\models;

use common\models\User;

/**
 * This is the model class for table "created_answers".
 *
 * @property int $id
 * @property int $user_id
 * @property string $comment
 * @property int $status 0->deleted; 
 1->not allowed; 
 9->waiting accept;
 10->accepted
 * @property string $created_at
 *
 * @property Answers[] $answers
 * @property User $user
 */
class CreatedAnswers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'created_answers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['created_at'], 'safe'],
            [['comment'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'comment' => 'Comment',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Answers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answers::className(), ['created_answer_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function getReport(self $report){
        $ball = 0;
        $err = false;

        if ($report->status == 1){ // 1 -> not allowed
            $err = true;
        } else {
            $question_titles = $report->user->whois->questionTitles;

            if ($question_titles) {
                foreach ($question_titles as $question_title) {
                    foreach ($question_title->questions as $question) {
                        $answer = Answers::findOne(['created_answer_id' => $report->id, 'question_id' => $question->id]);
                        if ($answer) {
                            if ($question->type->mime_type == 'file' && strlen($answer->answer) > 4) {
                                if (!file_exists('./files/' . $report->id . '/' . $answer->answer)){
                                    $err = true;
                                }
                            }

                            if ($question->type->mime_type != 'file') {
                                if (!is_numeric($answer->answer)) {
                                    $err = true;
                                }
                            }

                            if ($question->type2_id > 0) {
                                if (!is_numeric($answer->answer2)) {
                                    $err = true;
                                }
                            }

                            if (!$err && $question->type->mime_type != 'file') {
                                $ball += $answer->answer * $question->ball;
                            }
                        } else {
                            $err = true;
                        }
                    }
                }
            } else {
                $err = true;
            }
        }

        if ($err){
            $report->status = 1;
            $report->status = 'Система проигнорировала отчет';
            $report->save();

            return [
                'status' => 1,
                'ball' => 0,
            ];
        } else {
            return [
                'status' => $report->status,
                'ball' => $ball,
            ];
        }
    }

    public static function getRep(self $report){
        $ball = 0;
        $err = false;

        if ($report->status == 1){ // 1 -> not allowed
            $err = true;
        } else {
            $question_titles = $report->user->whois->questionTitles;

            if ($question_titles) {
                foreach ($question_titles as $question_title) {
                    foreach ($question_title->questions as $question) {
                        $answer = Answers::findOne(['created_answer_id' => $report->id, 'question_id' => $question->id]);
                        if ($answer) {
                            if ($question->type->mime_type == 'file' && strlen($answer->answer) > 4) {
                                if (!file_exists('../../frontend/web/files/' . $report->id . '/' . $answer->answer)){
                                    $err = true;
                                }
                            }

                            if ($question->type->mime_type != 'file') {
                                if (!is_numeric($answer->answer)) {
                                    $err = true;
                                }
                            }

                            if ($question->type2_id > 0) {
                                if (!is_numeric($answer->answer2)) {
                                    $err = true;
                                }
                            }

                            if (!$err && $question->type->mime_type != 'file') {
                                $ball += $answer->answer * $question->ball;
                            }
                        } else {
                            $err = true;
                            echo $report->id." ".$question->id." <br>";
                        }
                    }
                }
            } else {
                $err = true;
            }
        }

        if ($err){
            $report->status = 1;
            $report->status = 'Система проигнорировала отчет';
            $report->save();

            return [
                'status' => 1,
                'ball' => 0,
            ];
        } else {
            return [
                'status' => $report->status,
                'ball' => $ball,
            ];
        }
    }
}
