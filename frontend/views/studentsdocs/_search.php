<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\StudentsdocsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="studentsdocs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'students_id') ?>

    <?= $form->field($model, 'typepassport_id') ?>

    <?= $form->field($model, 'seryes') ?>

    <?= $form->field($model, 'number') ?>

    <?php // echo $form->field($model, 'startdate') ?>

    <?php // echo $form->field($model, 'enddate') ?>

    <?php // echo $form->field($model, 'typestatus_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
