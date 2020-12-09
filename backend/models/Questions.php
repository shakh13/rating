<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "questions".
 *
 * @property int $id
 * @property int $title_id
 * @property string $caption_en
 * @property string $caption_ru
 * @property string $caption_uz
 * @property int $type_id
 * @property int|null $type2_id
 * @property int $position
 * @property int $status
 * @property string $created_at
 *
 * @property Answers[] $answers
 * @property Types $type
 * @property Types $type2
 * @property QuestionTitles $title
 */
class Questions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'questions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title_id', 'caption_en', 'caption_ru', 'caption_uz', 'type_id', 'position'], 'required'],
            [['title_id', 'type_id', 'type2_id', 'position', 'status'], 'integer'],
            [['created_at'], 'safe'],
            [['caption_en', 'caption_ru', 'caption_uz'], 'string', 'max' => 255],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Types::className(), 'targetAttribute' => ['type_id' => 'id']],
            //[['type2_id'], 'exist', 'skipOnError' => false, 'targetClass' => Types::className(), 'targetAttribute' => ['type2_id' => 'id']],
            [['title_id'], 'exist', 'skipOnError' => true, 'targetClass' => QuestionTitles::className(), 'targetAttribute' => ['title_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title_id' => 'Title ID',
            'caption_en' => 'Caption En',
            'caption_ru' => 'Caption Ru',
            'caption_uz' => 'Caption Uz',
            'ball' => 'Ball',
            'type_id' => 'Type ID',
            'type2_id' => 'Type2 ID',
            'position' => 'Position',
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
        return $this->hasMany(Answers::className(), ['question_id' => 'id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Types::className(), ['id' => 'type_id']);
    }

    /**
     * Gets query for [[Type2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType2()
    {
        return $this->hasOne(Types::className(), ['id' => 'type2_id']);
    }

    /**
     * Gets query for [[Title]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTitle()
    {
        return $this->hasOne(QuestionTitles::className(), ['id' => 'title_id']);
    }
}
