<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Workdocs */

$this->title = 'Create Workdocs';
$this->params['breadcrumbs'][] = ['label' => 'Workdocs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workdocs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
