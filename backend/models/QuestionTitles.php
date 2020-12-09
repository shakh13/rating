<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "question_titles".
 *
 * @property int $id
 * @property int $whois_id
 * @property string $caption_en
 * @property string $caption_ru
 * @property string $caption_uz
 * @property int $position
 * @property int $status
 * @property string $created_at
 *
 * @property Whois $whois
 * @property Questions[] $questions
 */
class QuestionTitles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question_titles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['whois_id', 'caption_en', 'caption_ru', 'caption_uz', 'position'], 'required'],
            [['whois_id', 'position', 'status'], 'integer'],
            [['created_at'], 'safe'],
            [['caption_en', 'caption_ru', 'caption_uz'], 'string', 'max' => 255],
            [['whois_id'], 'exist', 'skipOnError' => true, 'targetClass' => Whois::className(), 'targetAttribute' => ['whois_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'whois_id' => 'Whois ID',
            'caption_en' => 'Caption En',
            'caption_ru' => 'Caption Ru',
            'caption_uz' => 'Caption Uz',
            'position' => 'Position',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Whois]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWhois()
    {
        return $this->hasOne(Whois::className(), ['id' => 'whois_id']);
    }

    /**
     * Gets query for [[Questions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Questions::className(), ['title_id' => 'id']);
    }
}
