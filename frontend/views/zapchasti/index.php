<?php
use yii\widgets\ActiveForm;
?>
<?php if($page->banners && !empty($page->banners)): ?>
<?= \frontend\widgets\BannerWidget::widget(['tpl' => 'index', 'banners' => $page->banners, 'cache_time' => 60]); ?>
<?php endif; ?>
<section class="content">
		<div class="row">
    <div class="span8 rpadd">
        <div class="dirs">
            <noindex><a href="<?= yii\helpers\Url::home();?>">Главная</a></noindex>
   
    <svg class="i arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#keyboard-down"></use></svg><a href="/zapchasti/">Запчасти Volvo</a>
   
</div>
        <h1><?=$page->title; ?></h1>
        <?=$page->body; ?>
        <div class="fastOrder">
            <?php
                if(!isset($message)) $message = new \common\models\Messages;
                $form = ActiveForm::begin([
                    'action'=>\yii\helpers\Url::to(['site/message']),
                ]); 
            ?>
                <div class="btnGroup">
                            <?= $form->field($message, 'phone', [
                                   'inputOptions'=>['placeholder' => '+7 ( ___ ) ___ - __ - __'],
                                   'template'=>"{input}",
                                ]); ?>
                            <?=$form->field($message, 'flag', ['template' => "{input}"])->hiddenInput(['value' => 2]) ?>
                             <?= $form->field($message, 'service_id', [
                                    'options'=>['tag' => null],
                                   'template'=>"{input}"
                                ])->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Services::find()->all(), 'id', 'title'), ['prompt' => 'Выберите  сервисную станцию']) ?>

			<button type="submit" name="sendPartsOrder" value="1" class="btn success">Записаться на ТО Volvo</button>
                        </div>
                  <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="span4 cars">
         <?= \frontend\widgets\ListWidget::widget(['tpl' => 'index', 'flag' => 'zapchasti', 'cache_time' => 60]); ?>
    </div>
</div>



<script type="text/javascript">
	$(document).ready(function(){

		$('.table .toggle .btn input[type=checkbox]').click(function(){
			var nRowSystem=$(this).parent().parent().parent();
			var nSystemName=nRowSystem.find('.name');
			nRowSystem.toggleClass('active');
			var system=$(this).val();
			console.log(system);
			var nSlide=$('#'+system);
			nSlide.slideToggle('fast');
		});

		$('.table .topic input[type="checkbox"]').click(function(){
			var carId = $(this).val();
			if($(this).attr('checked')) {
				// checked
				$('.table .sys_check_'+carId).attr('checked','checked');
				// mark active row
				$('.table .sys_row_'+carId).toggleClass('active',true);
				// open slides
				$('.table .sys_slide_'+carId).slideToggle('fast');
			} else {
				$('.table .sys_check_'+carId).attr('checked',false);
				$('.table .sys_row_'+carId).toggleClass('active',false);
				$('.table .sys_slide_'+carId).slideToggle('fast');
			}
		});
	});

	$('#modelSelect').change(function(){
		var url=$(this).find('option:selected').data('url');
		var modelId=$(this).find('option:selected').val();
		console.log(modelId);
		// save selected model in cookie
		$.cookie('', modelId, { path:'/'});
		$.cookie('', null, { path:'/'});
		window.location = PATH+url;
	});

	$('#generationSelect').change(function() {
		var genId = $(this).find('option:selected').val();
		console.log(genId);
		var modelId = parseInt($('#modelSelect').find('option:selected').val());
		$.cookie('', modelId, { path:'/'} );
		$.cookie('', genId, { path:'/'});
		$.cookie('', null, { path:'/' });
		window.location.reload(true);
	});

	$('#filterReset').click(function(){
		console.log('reset car filter');
		$.cookie('', null, { path:'/'});
		$.cookie('', null, { path:'/'});
		window.location.reload(true);
	});
</script>
	</section>
