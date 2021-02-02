<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OptionItems;

/**
 * OptionItemsSearch represents the model behind the search form of `app\models\OptionItems`.
 */
class OptionItemsSearch extends OptionItems
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'is_own_answer', 'option_id'], 'integer'],
            [['name_kaz', 'name_rus'], 'safe'],
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
        $query = OptionItems::find();

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
            'is_own_answer' => $this->is_own_answer,
            'option_id' => $this->option_id,
        ]);

        $query->andFilterWhere(['like', 'name_kaz', $this->name_kaz])
            ->andFilterWhere(['like', 'name_rus', $this->name_rus]);

        return $dataProvider;
    }
}
