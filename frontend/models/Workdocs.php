<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "workdocs".
 *
 * @property int $id
 * @property int $docnum
 * @property string $docdate
 * @property int $doctype
 * @property string $massive
 *
 * @property Typedoc $\F0
 * @property Workdoctostudents[] $workdoctostudents
 */
class Workdocs extends \yii\db\ActiveRecord
{
    public $students_id;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workdocs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['docnum', 'typedoc','students_id'], 'integer'],
            [['docdate'], 'safe'],
            [['massive'], 'string'],
            [['typedocName'], 'exist', 'skipOnError' => true, 'targetClass' => Typedoc::className(), 'targetAttribute' => ['typedoc' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'docnum' => 'Номер документа',
            'docdate' => 'Дата документа',
            'typedoc' => 'typedoc',
            'typedocName' => 'Тип документа',
            'massive' => 'Список студентов',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypedoc()
    {
        return $this->hasOne(Typedoc::className(), ['id' => 'typedoc_id']);
    }

    public function getTypedocName() {

        return $this->typedoc->name;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkdoctostudents()
    {
        return $this->hasMany(Workdoctostudents::className(), ['workdoc_id' => 'id']);
    }
}
