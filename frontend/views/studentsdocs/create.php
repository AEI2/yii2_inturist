<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Studentsdocs */

$this->title = 'Create Studentsdocs';
$this->params['breadcrumbs'][] = ['label' => 'Studentsdocs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="studentsdocs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
