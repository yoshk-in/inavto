<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Jobs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jobs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jc_id', ['template' => "{input}"])->hiddenInput(['value' => $job_category->id]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
    
    <?=$form->field($model, 'engines')->widget(Select2::classname(), [
        'data' => \common\helpers\HelpersFunctions::arrForEnginesList($engines, $job_category->car->title),
        'options' => ['placeholder' => 'Выбрать двигатели', 'multiple' => 'multiple', 'value' => $model->motors && !empty($model->motors) ? \common\helpers\HelpersFunctions::arrForObjectList($model->motors) : ''],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>
   
    <?=$form->field($model, 'years')->widget(Select2::classname(), [
        'data' => $years,
        'options' => ['placeholder' => 'На каком сроке эксплуотации необходима данная работа', 'multiple' => 'multiple', 'value' => $model->periods && !empty($model->periods) ? \common\helpers\HelpersFunctions::arrForObjectList($model->periods) : ''],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

   <?= $form->field($model, 'recomended')->checkbox(['0', '1']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
