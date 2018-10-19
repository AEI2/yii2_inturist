<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model frontend\models\Workdocs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="workdocs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'docnum')->textInput() ?>

    <?= $form->field($model, 'docdate')->textInput() ?>

    <?= $form->field($model, 'typedoc')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php
    ActiveForm::end(); ?>

    <?php
    Pjax::begin(['enablePushState' => false]); ?>
    <?= $this->render('_formone', ['model' => $model,'students' => $students]) ?>
    <?php Pjax::end(); ?>







</div>
