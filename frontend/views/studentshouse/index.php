<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\StudentshouseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Места проживания';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="studentshouse-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Studentshouse', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [


            [
            'attribute' => 'students_id',
            'value' => 'students.uniqum',
            ],
            'name',
            //'shortname',
           // 'obl',
            //'region',
            //'city',
            //'street',
            //'home',
            'office',
            //'tel',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
