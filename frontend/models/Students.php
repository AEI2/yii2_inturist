<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "students".
 *
 * @property int $id
 * @property string $uniqum
 * @property string $lastname
 * @property string $firstname
 * @property string $middlename
 * @property string $birthday
 * @property string $born
 * @property string $cityborn
 *
 * @property Studentsdocs[] $studentsdocs
 * @property Studentshouse[] $studentshouses
 */
class Students extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['birthday'], 'safe'],
            [['uniqum'], 'string', 'max' => 5],
            [['lastname', 'firstname', 'middlename', 'born', 'cityborn'], 'string', 'max' => 255],
            [['uniqum'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uniqum' => 'Uniqum',
            'lastname' => 'Lastname',
            'firstname' => 'Firstname',
            'middlename' => 'Middlename',
            'birthday' => 'Birthday',
            'born' => 'Born',
            'cityborn' => 'Cityborn',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentsdocs()
    {
        return $this->hasMany(Studentsdocs::className(), ['students_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentshouses()
    {
        return $this->hasMany(Studentshouse::className(), ['students_id' => 'id']);
    }
}
