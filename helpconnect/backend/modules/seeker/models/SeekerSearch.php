<?php

namespace backend\modules\seeker\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\seeker\models\Seeker;

/**
 * SeekerSearch represents the model behind the search form of `backend\modules\seeker\models\Seeker`.
 */
class SeekerSearch extends Seeker
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['seeker_id', 'user_id'], 'integer'],
            [['name', 'phone', 'workplace'], 'safe'],
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
        $query = Seeker::find();

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
            'seeker_id' => $this->seeker_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'workplace', $this->workplace]);

        return $dataProvider;
    }
}
