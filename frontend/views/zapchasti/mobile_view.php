<div class="content">
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
                    <?php if($parents): ?>
                        <?php foreach($parents as $key => $value): ?>
                    <option data-url="zapchasti/<?=$value->alias; ?>" value="<?=$value->id; ?>" <?=$value->id == $model->id ? 'selected="selected"' : ''; ?>><?=$value->car->title; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
		</select>
		<select name="generation" id="generationSelect">
			<option>все поколения</option>
                        <?php if(@$model->car->generations): ?>
                            <?php foreach(@$model->car->generations as $key => $value): ?>
                                <option value="<?=$value->id;?>" <?=$value->id == $f_gen ? 'selected="selected"' : '';?>><?=$value->title;?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
		</select>
                <?php if($f_gen): ?>
                <a class="filterReset" id="filterReset" href="<?= yii\helpers\Url::to(['zapchasti/category', 'alias' => $model->alias]); ?>">Сбросить уточнение</a>
                <?php endif; ?>
	</div>
</div>
<div class="row">
	<div class="descParts">
		<?=$model->body; ?>
	</div>
	<div class="orderParts">
		<a class="btn red">
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
            
            <a name="<?=$value['alias']; ?>"></a>
            <?php
                $open = '';
                $active = '';
                $check = '';
                if($slug && $slug == $value['alias'] || !$slug){
                    $open = 'open';
                    $active = 'active';
                    $check = 'checked="checked"';
                }
            ?>
            <div class="row subtopic <?=$active; ?>">
                    <div class="name">
                            <h3><label for="sys_<?=$value['alias']; ?>"><?=$value['title']; ?></label></h3>
                    </div>
                    <div class="toggle">
                            <label class="btn">
                                <input type="checkbox" <?=$check; ?> value="slide_<?=$value['alias']; ?>" name="sys_<?=$value['alias']; ?>" id="sys_<?=$value['alias']; ?>">
                                    <svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#keyboard-down"></use></svg>
                            </label>&nbsp;
                    </div>
            </div>
            <div class="sys_slide_12 slide <?=$open; ?>" id="slide_<?=$value['alias']; ?>">
                    <div class="row flex header">
                            <div class="partName">
                                    Наименование запчасти:
                            </div>
                            <!--<div class="articul">
                                    Артикул:
                            </div>-->
                            <div class="price">
                                    Цена:
                            </div>
                    </div>
                    <?php foreach($value['parts'] as $k => $v): ?>
                        <?php
                            $gen_str = array();
                                foreach($v['generation'] as $a_k => $a_v){
                                     $gen_str[$a_k] = str_replace('Volvo ', '', $car->title) . ' ' . $a_v['alter_title'];
                                }
                          ?>
                            <div class="row flex part">
                                    <div class="partName">
                                            <?=$v['title']; ?>
                                            <div class="vendor">
                                                    <?=$v['brand']['title']; ?>
                                                    <?=$v['original'] ? '<div class="isOriginal">оригинальная запчасть</div>' : ''; ?>
                                            </div>
                                    </div>
                                   <!-- <div class="articul">
                                            <?php // $v['code']; ?>
                                    </div>-->
                                    <div class="price">
                                            <?=Yii::$app->formatter->asInteger($v['price']); ?>  <span class="ruble">p</span>
                                    </div>
                            </div>
                      <?php $flag++; ?>
                    <?php endforeach; ?>
            </div>
            
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
