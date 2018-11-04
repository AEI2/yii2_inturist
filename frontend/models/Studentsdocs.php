<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "studentsdocs".
 *
 * @property int $id
 * @property int $students_id
 * @property int $typepassport_id
 * @property int $seryes
 * @property string $number
 * @property string $startdate
 * @property string $enddate
 * @property int $typestatus_id
 *
 * @property Students $students
 * @property Typepassport $typepassport
 * @property Typestatus $typestatus
 */
class Studentsdocs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'studentsdocs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['students_id', 'typepassport_id', 'seryes', 'typestatus_id'], 'integer'],
            [['startdate', 'enddate'], 'safe'],
            [['number'], 'string', 'max' => 255],
            [['students_id'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['students_id' => 'id']],
            [['typepassport_id'], 'exist', 'skipOnError' => true, 'targetClass' => Typepassport::className(), 'targetAttribute' => ['typepassport_id' => 'id']],
            [['typestatus_id'], 'exist', 'skipOnError' => true, 'targetClass' => Typestatus::className(), 'targetAttribute' => ['typestatus_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'students_id' => 'Students ID',
            'studentsName' => 'Уник Студента',
            'typepassport_id' => 'Тип документа',
            'typepassportName' => 'Тип документа',
            'seryes' => 'Серия',
            'number' => 'Номер',
            'startdate' => 'Дата выдачи',
            'enddate' => 'Действителен до',
            'typestatus_id' => 'Статус',
            'typestatusName' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasOne(Students::className(), ['id' => 'students_id']);
    }
    public function getStudentsname()
    {
        return $this->students->uniqum;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypepassport()
    {
        return $this->hasOne(Typepassport::className(), ['id' => 'typepassport_id']);
    }

    public function getTypepassportname() {

        return $this->typepassport->name;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypestatus()
    {
        return $this->hasOne(Typestatus::className(), ['id' => 'typestatus_id']);
    }
    public function getTypestatusName() {

        return $this->typestatus->name;
    }
}
