<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Typestatus;
use frontend\models\Typepassport;
use frontend\models\Students;
/* @var $this yii\web\View */
/* @var $model frontend\models\Studentsdocs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="studentsdocs-form">

    <?php $form = ActiveForm::begin(); ?>



    <?php
    $students = students::find()->all();
    // формируем массив, с ключем равным полю 'id' и значением равным полю 'name'
    $items = ArrayHelper::map($students,'id','uniqum');
    $params = [
        'prompt' => 'Выберите студента'
    ];
    echo $form->field($model, 'students_id')->dropDownList($items,$params);
    ?>

    <?php



    $typepassport = typepassport::find()->all();
    // формируем массив, с ключем равным полю 'id' и значением равным полю 'name'
    $items = ArrayHelper::map($typepassport,'id','name');
    $params = [
        'prompt' => 'Укажите тип документа'
    ];
    echo $form->field($model, 'typepassport_id')->dropDownList($items,$params);
    ?>

    <?= $form->field($model, 'seryes')->textInput() ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'startdate')->textInput() ?>

    <?= $form->field($model, 'enddate')->textInput() ?>

        <?php



    $typestatus = typestatus::find()->all();
    // формируем массив, с ключем равным полю 'id' и значением равным полю 'name'
    $items = ArrayHelper::map($typestatus,'id','name');
    $params = [
        'prompt' => 'Укажите статус документа'
    ];
    echo $form->field($model, 'typestatus_id')->dropDownList($items,$params);
    ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
