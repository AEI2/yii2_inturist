<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Studentsdocs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="studentsdocs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'students_id')->textInput() ?>

    <?= $form->field($model, 'type_doc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seryes')->textInput() ?>

    <?= $form->field($model, 'enddate')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'startdate')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
