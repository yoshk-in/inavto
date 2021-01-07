<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model common\models\PartsCategories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parts-categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'menu_title')->textInput(['maxlength' => true]) ?>
    
    <?=$form->field($model, 'parent')->widget(Select2::classname(), [
        'data' => $parents,
        'hideSearch' => true,
        'options' => ['placeholder' => 'Выбрать родительскую категорию', 'value' => $model->parent],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]);?>

    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?php
        echo $form->field($model, 'body')->widget(CKEditor::className(), [
            'editorOptions' => ElFinder::ckeditorOptions('elfinder', ['height' => '200'])
        ]);
    ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'keywords')->textarea(['rows' => 6]) ?>

    <?=$form->field($model, 'car_id')->widget(Select2::classname(), [
        'data' => $cars,
        'hideSearch' => true,
        'options' => ['placeholder' => 'Привязать авто к категории', 'value' => $model->car_id],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]);?>
    
     <?= $form->field($model, 'in_menu')->checkbox(['0', '1']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
    <script type="text/javascript">
        if(readyjs) readyjs[readyjs.length] = function(){ 
           $(document).ready(function(){
            var item = $('#partscategories-parent');
            showItems(item);
            item.change(function(){
                showItems(item);
             });
             function showItems(item){
                 var val_item = item.val();
                 var class_arr = ('.field-partscategories-alias, .field-partscategories-meta_title, .field-partscategories-body, .field-partscategories-description, .field-partscategories-keywords');
                 if(val_item){
                     $(class_arr).hide();
                 }else{
                     $(class_arr).show();
                 }
             }
           });
        }
    </script>

</div>
