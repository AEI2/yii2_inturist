<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\StudentsdocsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Studentsdocs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="studentsdocs-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Studentsdocs', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'studentsname',
            'typepassportname',
            'seryes',
            'number',
            'startdate',
            'enddate',
            'typestatusname',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
