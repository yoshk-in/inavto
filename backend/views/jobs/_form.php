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

    <?php // $form->field($model, 'jc_id', ['template' => "{input}"])->hiddenInput(['value' => $job_category->id]) ?>
    
    <?=$form->field($model, 'works')->widget(Select2::classname(), [
        'data' => $job_categories,
        'options' => ['placeholder' => 'Выбрать категории', 'multiple' => 'multiple', 'value' => $vaule_cats ? $vaule_cats  : ''],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>
    
    <?= $form->field($model, 'car_id', ['template' => "{input}"])->hiddenInput(['value' => $current_category->car->id]) ?>
    
    <?=$form->field($model, 'generations')->widget(Select2::classname(), [
    //    'data' => yii\helpers\ArrayHelper::map(common\models\Generations::find()->select(['id', 'title'])->all(), 'id', 'title'),
        'options' => ['placeholder' => 'Выбрать поколения авто', 'multiple' => 'multiple', 'value' => $model->generation && !empty($model->generation) ? \yii\helpers\ArrayHelper::map($model->generation, 'id', 'id') : ''],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>
    
    <?=$form->field($model, 'engines')->widget(Select2::classname(), [
    //    'data' => yii\helpers\ArrayHelper::map(common\models\Generations::find()->select(['id', 'title'])->all(), 'id', 'title'),
        'options' => ['placeholder' => 'Выбрать двигатель', 'multiple' => 'multiple', 'value' => $model->motors && !empty($model->motors) ? \yii\helpers\ArrayHelper::map($model->motors, 'id', 'id') : ''],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>
   
    <?=$form->field($model, 'years')->widget(Select2::classname(), [
        'data' => $years,
        'options' => ['placeholder' => 'На каком сроке эксплуатации необходима данная работа', 'multiple' => 'multiple', 'value' => $model->periods && !empty($model->periods) ? \common\helpers\HelpersFunctions::arrForObjectList($model->periods) : ''],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>
    
     <?=$form->field($model, 'items')->widget(Select2::classname(), [
     //   'data' => yii\helpers\ArrayHelper::map(common\models\Jobs::find()->select(['id', 'title'])->all(), 'id', 'title'),
        'options' => ['placeholder' => 'Выбрать запчасти', 'multiple' => 'multiple', 'value' => $model->parts && !empty($model->parts) ? \yii\helpers\ArrayHelper::map($model->parts, 'id', 'id') : ''],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>
    
    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'recomended')->dropDownList([null => 'Нет', '1' => 'Да']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
    <script type="text/javascript">
        if(readyjs) readyjs[readyjs.length] = function(){ 
           $(document).ready(function(){
            var car_id = $('#jobs-car_id');
            var generation_wrap = $('.field-jobs-generations');
            var generations = $('#jobs-generations');
          //var generations = $("input[name='Parts[generations]']");
            var engine_wrap = $('.field-jobs-engines');
            var engine_id = $('#jobs-engines');
            var parts = $('#jobs-items');
            
            showItems(car_id, generation_wrap);
            getGenerations(car_id.val(), generations);
            showItems(generations, engine_wrap);
            getEngines(String(generations.val()), engine_id);
            getParts(String(car_id.val()), parts);
            
            car_id.change(function(){
                showItems(car_id, generation_wrap);
                getGenerations(car_id.val(), generations);
                getParts(String(car_id.val()), parts);
             });
             
             generations.change(function(){
                var generations = $('#jobs-generations');
                showItems(generations, engine_wrap);
                getEngines(String(generations.val()), engine_id);
             });
             
             function showItems(item, selector){
                 var val_item = String(item.val());
              //   console.log(String($("#parts-generations").select2("val")));
                 if(!val_item){
                     selector.hide();
                 }else{
                     selector.show();
                 }
             }
             
             function getGenerations(val_item, selector){
             //    alert(selector.val)
                     $.ajax({
                        type: "GET",
                        url: '<?= yii\helpers\Url::to(['jobs/generations']); ?>', 
                        data: "id="+val_item+"&current_id="+selector.val(),
                        success: function(res){
                            selector.empty().append(res);
                        }, 
                        error: function(){
                          alert('error');
                        }
                    });
                 }
                 
                 function getEngines(val_item, selector){
                     $.ajax({
                        type: "GET",
                        url: '<?= yii\helpers\Url::to(['jobs/engines']); ?>', 
                        data: "id="+val_item+"&current_id="+selector.val(),
                        success: function(res){
                            selector.empty().append(res);
                        }, 
                        error: function(){
                          alert('error');
                        }
                    });
                 }
                 
                 function getParts(val_item, selector){
                     $.ajax({
                        type: "GET",
                        url: '<?= yii\helpers\Url::to(['jobs/parts']); ?>', 
                        data: "id="+val_item+"&current_id="+selector.val(),
                        success: function(res){
                            selector.empty().append(res);
                        }, 
                        error: function(){
                          alert('error');
                        }
                    });
                 }
           });
        }
    </script>

</div>
