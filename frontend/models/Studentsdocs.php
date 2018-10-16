<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "studentsdocs".
 *
 * @property int $id
 * @property int $students_id
 * @property string $type_doc
 * @property int $seryes
 * @property string $number
 * @property string $startdate
 * @property string $enddate
 * @property string $status
 *
 * @property Students $students
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
            [['students_id', 'seryes'], 'integer'],
            [['startdate', 'enddate'], 'safe'],
            [['type_doc', 'number', 'status'], 'string', 'max' => 255],
            [['students_id'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['students_id' => 'id']],
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
            'type_doc' => 'Type Doc',
            'seryes' => 'Seryes',
            'number' => 'Number',
            'startdate' => 'Startdate',
            'enddate' => 'Enddate',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasOne(Students::className(), ['id' => 'students_id']);
    }
}
