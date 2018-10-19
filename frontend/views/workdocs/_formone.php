<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

$form2 = ActiveForm::begin([
    'action' => Url::toRoute(['students/select', 'workdocId' => $model->id]),
    'options' => [
        'data-pjax' => '1'
    ],
    'id' => 'studentsSelectForm'
]);

?>

<?php foreach ($students as $key => $student): ?>
    <?= $form2->field($model, "[$key]docnum")->textInput() ?>

<?php endforeach ?>

 <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary'])?>
 <?php ActiveForm::end() ?>