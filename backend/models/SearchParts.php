<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Parts;

/**
 * SearchParts represents the model behind the search form of `common\models\Parts`.
 */
class SearchParts extends Parts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pc_id', 'car_id', 'engine_id', 'generation_id', 'brand_id', 'job_id', 'check', 'original'], 'integer'],
            [['title', 'code', 'created', 'modified'], 'safe'],
            [['price'], 'number'],
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
    public function search($params, $id)
    {
        $query = Parts::find();

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
          //  'pc_id' => $this->pc_id,
            'pc_id' => $id,
            'car_id' => $this->car_id,
            'engine_id' => $this->engine_id,
            'generation_id' => $this->generation_id,
            'brand_id' => $this->brand_id,
            'job_id' => $this->job_id,
            'price' => $this->price,
            'check' => $this->check,
            'original' => $this->original,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}
