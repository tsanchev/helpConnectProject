<?php

namespace backend\modules\offer\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\offer\models\Offer;

/**
 * OfferSearch represents the model behind the search form of `backend\modules\offer\models\Offer`.
 */
class OfferSearch extends Offer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            /*[['offer_id', 'giver_id'], 'integer'],*/
            [['offer'], 'safe'],
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
        $query = Offer::find();

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
            'offer_id' => $this->offer_id,
            'giver_id' => $this->giver_id,
        ]);

        $query->andFilterWhere(['like', 'offer', $this->offer]);

        return $dataProvider;
    }
}
