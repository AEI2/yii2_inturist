<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Workdocs;

/**
 * WorkdocSearch represents the model behind the search form of `frontend\models\Workdocs`.
 */
class WorkdocsSearch extends Workdocs
{
    /**
     * {@inheritdoc}
     */
    public $typedocName;

    public function rules()
    {
        return [
            [['id', 'docnum', 'typedoc'], 'integer'],
            [['docdate', 'massive','typedocName'], 'safe'],
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
        $query = Workdocs::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'typedocName' => [
                    'asc' => ['typedoc.name' => SORT_ASC],
                    'desc' => ['typedoc.name' => SORT_DESC],
                    'label' => 'Тип документа'
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['typedoc']);
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'docnum' => $this->docnum,
            'docdate' => $this->docdate,
            'typedoc' => $this->typedoc,
        ]);
        $query->joinWith(['typedoc' => function ($q) {
            $q->where('typedoc.name LIKE "%' . $this->typedocName . '%"');
        }]);

        $query->andFilterWhere(['like', 'massive', $this->massive]);

        return $dataProvider;
    }
}
