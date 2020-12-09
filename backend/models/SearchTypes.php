<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SearchTypes represents the model behind the search form of `app\models\Types`.
 */
class SearchTypes extends Types
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['caption_en', 'caption_ru', 'caption_uz', 'short_en', 'short_ru', 'short_uz'], 'safe'],
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
        $query = Types::find();

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
        ]);

        $query->andFilterWhere(['like', 'caption_en', $this->caption_en])
            ->andFilterWhere(['like', 'caption_ru', $this->caption_ru])
            ->andFilterWhere(['like', 'caption_uz', $this->caption_uz])
            ->andFilterWhere(['like', 'short_en', $this->short_en])
            ->andFilterWhere(['like', 'short_ru', $this->short_ru])
            ->andFilterWhere(['like', 'short_uz', $this->short_uz]);

        return $dataProvider;
    }
}
