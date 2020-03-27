<?php

namespace backend\modules\giver\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\giver\models\Giver;

/**
 * GiverSearch represents the model behind the search form of `backend\modules\giver\models\Giver`.
 */
class GiverSearch extends Giver
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['giver_id', 'user_id'], 'integer'],
            [['name', 'company', 'phone', 'services'], 'safe'],
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
        $query = Giver::find();

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
            'giver_id' => $this->giver_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'company', $this->company])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'services', $this->services]);

        return $dataProvider;
    }
}
