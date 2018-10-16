<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "workdocs".
 *
 * @property int $id
 * @property int $docnum
 * @property string $docdate
 * @property string $doctype
 * @property string $massive
 */
class Workdocs extends \yii\db\ActiveRecord
{
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
            [['docnum'], 'integer'],
            [['docdate'], 'safe'],
            [['massive'], 'string'],
            [['doctype'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'docnum' => 'Docnum',
            'docdate' => 'Docdate',
            'doctype' => 'Doctype',
            'massive' => 'Massive',
        ];
    }
}
