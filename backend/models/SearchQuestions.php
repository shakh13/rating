<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SearchQuestions represents the model behind the search form of `app\models\Questions`.
 */
class SearchQuestions extends Questions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'title_id', 'type_id', 'type2_id', 'position', 'status'], 'integer'],
            [['caption_en', 'caption_ru', 'caption_uz', 'created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Questions::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'title_id' => $this->title_id,
            'type_id' => $this->type_id,
            'type2_id' => $this->type2_id,
            'position' => $this->position,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'caption_en', $this->caption_en])
            ->andFilterWhere(['like', 'caption_ru', $this->caption_ru])
            ->andFilterWhere(['like', 'caption_uz', $this->caption_uz]);

        return $dataProvider;
    }
}
