<?php

namespace backend\models;


/**
 * This is the model class for table "answers".
 *
 * @property int $id
 * @property int $created_answer_id
 * @property int $question_id
 * @property string $answer
 * @property string $answer2
 *
 * @property Questions $question
 * @property CreatedAnswers $createdAnswer
 */
class Answers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'answers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_answer_id', 'question_id', 'answer'], 'required'],
            [['created_answer_id', 'question_id'], 'integer'],
            [['answer', 'answer2'], 'string', 'max' => 255],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::className(), 'targetAttribute' => ['question_id' => 'id']],
            [['created_answer_id'], 'exist', 'skipOnError' => true, 'targetClass' => CreatedAnswers::className(), 'targetAttribute' => ['created_answer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_answer_id' => 'Created Answer ID',
            'question_id' => 'Question ID',
            'answer' => 'Answer',
            'answer2' => 'Answer2',
        ];
    }

    /**
     * Gets query for [[Question]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Questions::className(), ['id' => 'question_id']);
    }

    /**
     * Gets query for [[CreatedAnswer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedAnswer()
    {
        return $this->hasOne(CreatedAnswers::className(), ['id' => 'created_answer_id']);
    }
}
