<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "studentshouse".
 *
 * @property int $id
 * @property int $students_id
 * @property string $name
 * @property string $shortname
 * @property string $obl
 * @property string $region
 * @property string $city
 * @property string $street
 * @property string $home
 * @property string $office
 * @property string $tel
 *
 * @property Students $students
 */
class Studentshouse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'studentshouse';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['students_id'], 'integer'],
            [['name', 'shortname', 'obl', 'region', 'city', 'street', 'home', 'office', 'tel'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'shortname' => 'Shortname',
            'obl' => 'Obl',
            'region' => 'Region',
            'city' => 'City',
            'street' => 'Street',
            'home' => 'Home',
            'office' => 'Office',
            'tel' => 'Tel',
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
