<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Studentsdocs */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Studentsdocs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="studentsdocs-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'students_id',
            'type_doc',
            'seryes',
            'number',
            'startdate',
            'enddate',
            'status',
        ],
    ]) ?>

</div>