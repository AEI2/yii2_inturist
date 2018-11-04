<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Studentsdocs;

/**
 * StudentsdocsSearch represents the model behind the search form of `frontend\models\Studentsdocs`.
 */
class StudentsdocsSearch extends Studentsdocs
{
    /**
     * {@inheritdoc}
     */
    public $studentsname;
    public $typepassportname;
    public $typestatusname;

    public function rules()
    {
        return [
            [['id', 'students_id', 'seryes'], 'integer'],
            [['type_doc', 'number', 'startdate', 'enddate', 'status','studentsname','typepassportname','typestatusname'], 'safe'],
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
        $query = Studentsdocs::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->setSort([
            'attributes' => [
                'id',
                'studentsname' => [
                    'asc' => ['students.uniqum' => SORT_ASC],
                    'desc' => ['students.uniqum' => SORT_DESC],
                    'label' => 'Студент'
                ],
                'typepassortname' => [
                    'asc' => ['typepassport.name' => SORT_ASC],
                    'desc' => ['typepassport.name' => SORT_DESC],
                    'label' => 'Тип документа'
                ],
                'typestatusname' => [
                    'asc' => ['typestatus.name' => SORT_ASC],
                    'desc' => ['typestatus.name' => SORT_DESC],
                    'label' => 'Студент'
                ]
            ]
        ]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith('students')->joinWith('typepassport')->joinWith('typestatus');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        //    'students_id' => $this->students_id,
            'seryes' => $this->seryes,
            'startdate' => $this->startdate,
            'enddate' => $this->enddate,
        ]);
        $query->joinWith(['students' => function ($q) {
            $q->where('students.uniqum LIKE "%' . $this->studentsname . '%"');
        }]);
        $query->joinWith(['typepassport' => function ($q) {
            $q->where('typepassport.name LIKE "%' . $this->typepassportname . '%"');
        }]);
        $query->joinWith(['typestatus' => function ($q) {
            $q->where('typestatus.name LIKE "%' . $this->typestatusname . '%"');
        }]);


          //  ->andFilterWhere(['like', 'number', $this->number])


        return $dataProvider;
    }
}
