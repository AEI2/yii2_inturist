<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Studentshouse */

$this->title = 'Create Studentshouse';
$this->params['breadcrumbs'][] = ['label' => 'Studentshouses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="studentshouse-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
