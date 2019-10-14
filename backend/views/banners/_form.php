<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use bupy7\cropbox\CropboxWidget;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Banners */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banners-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slogan_one')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slogan_two')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
    
    <?php if($model->img && !empty($model->img)): ?>
    <div class="form-group">
        <img src="<?=Yii::getAlias('@front_path/upload/banners/prev').'/thumb_'.$model->img; ?>" alt="" style="max-width:300px">
    </div>
    <?php endif; ?>
    
    <?php
        echo $form->field($model, 'image')->widget(CropboxWidget::className(), [
            'croppedDataAttribute' => 'crop_info',
            'pluginOptions' => [
                'variants' => [
                    [
                        'width' => 1866,
                        'height' => 160,
                        'minWidth' => 30,
                        'minHeight' => 30,
                        'maxWidth' => 1866,
                        'maxHeight' => 350
                     ]
                ]
            ]
        ]);
    ?>
    
    <?=$form->field($model, 'articles')->widget(Select2::classname(), [
        'data' => yii\helpers\ArrayHelper::map(common\models\Pages::find()->select(['id', 'title'])->all(), 'id', 'title'),
        'options' => ['placeholder' => 'Выбрать информационные страницы', 'multiple' => 'multiple', 'value' => $model->pages && !empty($model->pages) ? \yii\helpers\ArrayHelper::map($model->pages, 'id', 'id') : ''],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<style>
    .workarea-cropbox, .bg-cropbox{
        width:100%;
    }
</style>
