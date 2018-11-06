<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Typedoc;
use yii\widgets\Pjax;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Workdocs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="workdocs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'docnum')->textInput() ?>

    <?= $form->field($model, 'docdate')->textInput() ?>

$
    <?php


    $worcdoc=$model->id;
    $typedoc = Typedoc::find()->all();
// формируем массив, с ключем равным полю 'id' и значением равным полю 'name'
    $items = ArrayHelper::map($typedoc,'id','name');
    $params = [
        'prompt' => 'Укажите тип документа'
    ];
    echo $form->field($model, 'typedoc_id')->dropDownList($items,$params);
    ?>

    <?php

    $array=ArrayHelper::getColumn($students, 'id');

    $students_not = \frontend\models\Students::find()->
    where(['not in','id',$array])
        ->all();

    // формируем массив, с ключем равным полю 'id' и значением равным полю 'name'
    $items = ArrayHelper::map($students_not,'id','uniqum');
    $params = [
        'prompt' => 'Выберите уникальный код студента'
    ];
    echo $form->field($model, 'students_id')->dropDownList($items,$params);
    ?>


    <?php Pjax::begin(['id' => 'students']) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'uniqum',
            'lastname',
            'firstname',
            'middlename',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{deletefromworkdoc}',
                'buttons' => [

                    'deletefromworkdoc' => function ($url,$model, $key) use ($worcdoc) {


                        $url.="&workdoc_id=".$worcdoc;
                        return Html::a('Убрать', $url);

                    },
                ],
         //   ['class' => 'yii\grid\ActionColumn'],
        ],
    ]]); ?>
    <?php Pjax::end() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
