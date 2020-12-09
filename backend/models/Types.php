<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "types".
 *
 * @property int $id
 * @property string $caption_en
 * @property string $caption_ru
 * @property string $caption_uz
 * @property string $short_en
 * @property string $short_ru
 * @property string $short_uz
 *
 * @property Questions[] $questions
 * @property Questions[] $questions0
 */
class Types extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['caption_en', 'caption_ru', 'caption_uz', 'short_en', 'short_ru', 'short_uz'], 'required'],
            [['caption_en', 'caption_ru', 'caption_uz'], 'string', 'max' => 128],
            [['short_en', 'short_ru', 'short_uz'], 'string', 'max' => 10],
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
            'short_en' => 'Short En',
            'short_ru' => 'Short Ru',
            'short_uz' => 'Short Uz',
        ];
    }

    /**
     * Gets query for [[Questions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Questions::className(), ['type_id' => 'id']);
    }

    /**
     * Gets query for [[Questions0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions2()
    {
        return $this->hasMany(Questions::className(), ['type2_id' => 'id']);
    }
}
