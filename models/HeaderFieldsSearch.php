<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\HeaderFields;

/**
 * HeaderFieldsSearch represents the model behind the search form of `app\models\HeaderFields`.
 */
class HeaderFieldsSearch extends HeaderFields
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'anketa_id'], 'integer'],
            [['type', 'name_rus', 'name_kaz'], 'safe'],
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
        $query = HeaderFields::find();

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
            'anketa_id' => $this->anketa_id,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'name_rus', $this->name_rus])
            ->andFilterWhere(['like', 'name_kaz', $this->name_kaz]);

        return $dataProvider;
    }
}
