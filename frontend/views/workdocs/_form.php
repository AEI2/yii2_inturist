<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Typedoc;

/* @var $this yii\web\View */
/* @var $model frontend\models\Workdocs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="workdocs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'docnum')->textInput() ?>

    <?= $form->field($model, 'docdate')->textInput() ?>


    <?php



    $typedoc = Typedoc::find()->all();
// формируем массив, с ключем равным полю 'id' и значением равным полю 'name'
    $items = ArrayHelper::map($typedoc,'id','name');
    $params = [
        'prompt' => 'Укажите тип документа'
    ];
    echo $form->field($model, 'typedoc')->dropDownList($items,$params);
    ?>


    <?= $form->field($model, 'massive')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
