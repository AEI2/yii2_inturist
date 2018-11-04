<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Students;

/**
 * StudentsSearch represents the model behind the search form of `frontend\models\Students`.
 */
class StudentsSearch extends Students
{
    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['uniqum', 'lastname', 'firstname', 'middlename', 'birthday', 'born', 'cityborn'], 'safe'],
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
        $query = Students::find();

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
            'birthday' => $this->birthday,
        ]);

        $query->andFilterWhere(['like', 'uniqum', $this->uniqum])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'middlename', $this->middlename])
            ->andFilterWhere(['like', 'born', $this->born])
            ->andFilterWhere(['like', 'cityborn', $this->cityborn]);

        return $dataProvider;
    }
}
