<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Workdocs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="workdocs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'docnum')->textInput() ?>

    <?= $form->field($model, 'docdate')->textInput() ?>

    <?= $form->field($model, 'doctype')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
