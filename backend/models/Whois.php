<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "whois".
 *
 * @property int $id
 * @property string $caption_en
 * @property string $caption_ru
 * @property string $caption_uz
 * @property int $status 0->not active; 1->active
 * @property string $created_at
 *
 * @property QuestionTitles[] $questionTitles
 */
class Whois extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'whois';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['caption_en', 'caption_ru', 'caption_uz'], 'required'],
            [['status'], 'integer'],
            [['created_at'], 'safe'],
            [['caption_en', 'caption_ru', 'caption_uz'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'caption_en' => 'Caption En',
            'caption_ru' => 'Caption Ru',
            'caption_uz' => 'Caption Uz',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[QuestionTitles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionTitles()
    {
        return $this->hasMany(QuestionTitles::className(), ['whois_id' => 'id']);
    }
}
