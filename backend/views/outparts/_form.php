<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model common\models\Parts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'pc_id', ['template' => "{input}"])->hiddenInput(['value' => $part_category->id]) ?>
    
    <?=$form->field($model, 'categories')->widget(Select2::classname(), [
        'data' => $part_categories,
        'options' => ['placeholder' => 'Выбрать категории', 'multiple' => 'multiple', 'value' => $value_cats ? $value_cats  : ''],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>
    
    <?=$form->field($model, 'cars')->widget(Select2::classname(), [
        'data' => $cars,
        'options' => ['placeholder' => 'Выбрать авто', 'multiple' => 'multiple', 'value' => $model->avtos && !empty($model->avtos) ? \yii\helpers\ArrayHelper::map($model->avtos, 'id', 'id')  : ''],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>
    
    <?=$form->field($model, 'generations')->widget(Select2::classname(), [
    //    'data' => yii\helpers\ArrayHelper::map(common\models\Generations::find()->select(['id', 'title'])->all(), 'id', 'title'),
        'options' => ['placeholder' => 'Выбрать поколения авто', 'multiple' => 'multiple', 'value' => $model->generation && !empty($model->generation) ? \yii\helpers\ArrayHelper::map($model->generation, 'id', 'id') : ''],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>
    
    <?=$form->field($model, 'engines')->widget(Select2::classname(), [
    //    'data' => yii\helpers\ArrayHelper::map(common\models\Generations::find()->select(['id', 'title'])->all(), 'id', 'title'),
        'options' => ['placeholder' => 'Выбрать двигатель', 'multiple' => 'multiple', 'value' => $model->engine && !empty($model->engine) ? \yii\helpers\ArrayHelper::map($model->engine, 'id', 'id') : ''],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>
    
    <?=$form->field($model, 'brand_id')->widget(Select2::classname(), [
        'data' => yii\helpers\ArrayHelper::map(common\models\Brands::find()->select(['id', 'title'])->all(), 'id', 'title'),
        'options' => ['placeholder' => 'Производитель', 'value' => $model->brand_id],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]);?>
    
    <?=$form->field($model, 'works')->widget(Select2::classname(), [
     //   'data' => yii\helpers\ArrayHelper::map(common\models\Jobs::find()->select(['id', 'title'])->all(), 'id', 'title'),
        'options' => ['placeholder' => 'Выбрать работы под данную запчасть', 'multiple' => 'multiple', 'value' => $model->jobs && !empty($model->jobs) ? \yii\helpers\ArrayHelper::map($model->jobs, 'id', 'id') : ''],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'check')->dropDownList(['0' => 'Нет', '1' => 'Да', '2' => 'Много']) ?>

    <?= $form->field($model, 'original')->dropDownList(['0' => 'Нет', '1' => 'Да']) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
    
    <script type="text/javascript">
        if(readyjs) readyjs[readyjs.length] = function(){ 
           $(document).ready(function(){
            var car_id = $('#parts-cars');
            var generation_wrap = $('.field-parts-generations');
            var generations = $('#parts-generations');
          //var generations = $("input[name='Parts[generations]']");
            var engine_wrap = $('.field-parts-engines');
            var engine_id = $('#parts-engines');
            var jobs = $('#parts-works');
            
            showItems(car_id, generation_wrap);
            getGenerations(String(car_id.val()), generations);
            showItems(generations, engine_wrap);
            getEngines(String(generations.val()), engine_id);
            getJobs(String(car_id.val()), jobs);
            
            car_id.change(function(){
                if(car_id.val() == ''){
                    generations.val('');
                }
                showItems(car_id, generation_wrap);
                getGenerations(String(car_id.val()), generations);
                showItems(generations, engine_wrap);
                getEngines(String(generations.val()), engine_id);
                getJobs(String(car_id.val()), jobs);
             });
             
             generations.change(function(){
                 if(generations.val() == ''){
                    engine_id.val('');
                }
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
                        url: '<?= yii\helpers\Url::to(['parts/generations']); ?>', 
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
                        url: '<?= yii\helpers\Url::to(['parts/engines']); ?>', 
                        data: "id="+val_item+"&current_id="+selector.val(),
                        success: function(res){
                            selector.empty().append(res);
                        }, 
                        error: function(){
                          alert('error');
                        }
                    });
                  }
                    
                    function getJobs(val_item, selector){
                     $.ajax({
                        type: "GET",
                        url: '<?= yii\helpers\Url::to(['parts/jobs']); ?>', 
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