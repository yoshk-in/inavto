<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PartsCategories */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Parts Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= \frontend\widgets\BannerWidget::widget(['tpl' => 'index', 'cache_time' => 60]); ?>
<section class="content">
		<div class="row">
    <div class="span12 text">
        <div class="dirs">
            <noindex><a href="<?= yii\helpers\Url::home(); ?>">Главная</a></noindex>
            <svg class="i arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#keyboard-down"></use></svg><a href="<?= yii\helpers\Url::to(['/zapchasti/index']); ?>">Запчасти Volvo</a>
            <svg class="i arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#keyboard-down"></use></svg><a href="<?= yii\helpers\Url::to(['/zapchasti/category', 'alias' => $model->alias]); ?>"><?=$model->title; ?></a>
        </div>
        <h1><?=$model->title; ?></h1>
        <div class="row">
	<div class="userCarSelect">
		<span><svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#filter-list"></use></svg> Уточните поколение и двигатель:</span>
		<select name="car" id="modelSelect">
			<option data-url="zapchasti/volvo-xc90" value="12" selected="selected">Volvo XC90</option><option data-url="zapchasti/volvo-xc70" value="27">Volvo XC70</option><option data-url="zapchasti/volvo-xc60" value="1">Volvo XC60</option><option data-url="zapchasti/volvo-v50" value="24">Volvo V50</option><option data-url="zapchasti/volvo-s80" value="29">Volvo S80</option><option data-url="zapchasti/volvo-s60" value="28">Volvo S60</option><option data-url="zapchasti/volvo-s40/v40" value="30">Volvo S40 и V40</option><option data-url="zapchasti/volvo-c30" value="31">Volvo C30</option>
		</select>
		<select name="generation" id="generationSelect">
			<option>все поколения</option>
			<option value="20">II ( 2007 - 2015 )</option><option value="48">I ( 2002 - 2006 )</option>
		</select>
		
	</div>
</div>
<div class="row">
	<div class="descParts">
		<?=$model->body; ?>
	</div>
	<div class="orderParts">
		<a class="btn parts">
			<svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#settings"></use></svg><?=$model->title; ?>
		</a><br>
		<a href="<?= yii\helpers\Url::to(['/remont/category', 'alias' => $model->alias]); ?>" class="btn green">
			<svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#wrench"></use></svg>Ремонт <?=$model->car->title; ?>
		</a><br>
                <a href="<?= yii\helpers\Url::to(['/obsluzhivanie/category', 'alias' => $model->alias]); ?>" class="btn calc">
			<svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#car"></use></svg>Обслуживание <?=$model->car->title; ?>
		</a>
	</div>
</div>



<div class="carParts table bordered">
    <?php if($cats && !empty($cats)): ?>
        <?php $flag = 1; ?>
        <?php foreach($cats as $key => $value): ?>
            <?php if(!empty($value->parts)): ?>
            <a name="<?=$value->alias; ?>"></a>
            <div class="row subtopic active">
                    <div class="name">
                            <h3><label for="sys_<?=$value->alias; ?>"><?=$value->title; ?></label></h3>
                    </div>
                    <div class="toggle">
                            <label class="btn">
                                    <input type="checkbox" checked="checked" value="slide_<?=$value->alias; ?>" name="sys_<?=$value->alias; ?>" id="sys_<?=$value->alias; ?>">
                                    <svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#keyboard-down"></use></svg>
                            </label>&nbsp;
                    </div>
            </div>
            <div class="sys_slide_12 slide open" id="slide_<?=$value->alias; ?>">
                    <div class="row flex header">
                            <div class="num">
                                    №:
                            </div>
                            <div class="partName">
                                    Наименование запчасти:
                            </div>
                            <div class="original">
                                    Производитель:
                            </div>
                            <div class="articul">
                                    Артикул:
                            </div>
                            <div class="amount">
                                    Наличие:
                            </div>
                            <div class="price">
                                    Цена:
                            </div>
                    </div>
                    <?php foreach($value->parts as $k => $v): ?>
                        <div class="row flex part">
                                <div class="num">
                                        <?=$flag; ?>.
                                </div>
                                <div class="partName">
                                        <?=$v->title; ?>
                                        <div class="compatibleGenerations">XC90 II, XC90 I</div>

                                </div>
                                <div class="original ">
                                        <?=$v->brand->title; ?>
                                        <?=$v->original ? '<div class="isOriginal">оригинальная запчасть</div>' : ''; ?>
                                </div>
                                <div class="articul">
                                        <?=$v->code; ?>
                                </div>
                                <div class="amount">
                                    <?php 
                                        $check = '<span class="medium">отсутствует</span>';
                                        if($v->check == 1){
                                            $check = '<span class="medium">в наличии</span>';
                                        }elseif($v->check == 2){
                                            $check = '<span class="lot">много</span>';
                                        }
                                     
                                    ?>
                                        <?=$check; ?>
                                </div>
                                <div class="price">
                                        <?=Yii::$app->formatter->asInteger($v->price); ?>  <span class="ruble">p</span>
                                </div>
                        </div>
                      <?php $flag++; ?>
                    <?php endforeach; ?>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
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
		$.cookie('fModel', modelId, { path:'/'});
		$.cookie('fGen', null, { path:'/'});
		window.location = PATH+url;
	});

	$('#generationSelect').change(function() {
		var genId = $(this).find('option:selected').val();
		console.log(genId);
		var modelId = parseInt($('#modelSelect').find('option:selected').val());
		$.cookie('fModel', modelId, { path:'/'} );
		$.cookie('fGen', genId, { path:'/'});
		$.cookie('fMotor', null, { path:'/' });
		window.location.reload(true);
	});

	$('#filterReset').click(function(){
		console.log('reset car filter');
		$.cookie('fModel', null, { path:'/'});
		$.cookie('fGen', null, { path:'/'});
		window.location.reload(true);
	});
</script>
    </div>
</div>
	</section>
