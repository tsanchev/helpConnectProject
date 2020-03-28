<?php

namespace backend\modules\request\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\request\models\Request;

/**
 * RequestSearch represents the model behind the search form of `backend\modules\request\models\Request`.
 */
class RequestSearch extends Request
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           /* [['request_id', 'seeker_id'], 'integer'],*/
            [['request'], 'safe'],
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
        $query = Request::find();

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
            'request_id' => $this->request_id,
            'seeker_id' => $this->seeker_id,
        ]);

        $query->andFilterWhere(['like', 'request', $this->request]);

        return $dataProvider;
    }
}
