<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\WorkdocSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Workdocs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workdocs-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Workdocs', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'docnum',
            'docdate',

            'typedocName',
            'massive:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {createword}',
                'buttons' => [
                    'createword' => function ($url,$model,$key) {

                        return Html::a('Сформировать', $url);

                    },
            ]      ],
        ],
    ]); ?>
</div>
