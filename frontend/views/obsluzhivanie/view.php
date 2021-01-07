<?php if($page->banners && !empty($page->banners)): ?>
<?= \frontend\widgets\BannerWidget::widget(['tpl' => 'index', 'banners' => $page->banners, 'cache_time' => 60]); ?>
<?php endif; ?>
<section class="content">
		<div class="row">
    <div class="span12 text">
        <div class="dirs">
            <noindex><a href="<?= yii\helpers\Url::home(); ?>">Главная</a></noindex>
            <svg class="i arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#keyboard-down"></use></svg><a href="<?= yii\helpers\Url::to(['/obsluzhivanie/index']); ?>">Техническое и сервисное обслуживание Volvo</a>
            <svg class="i arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#keyboard-down"></use></svg><a href="<?= yii\helpers\Url::to(['/obsluzhivanie/category', 'alias' => $model->alias]); ?>"><?=$model->title; ?></a>
        </div>
        <h1><?=$model->title; ?></h1>
        <div class="row">
	<div class="userCarSelect">
		<span><svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#filter-list"></use></svg> Уточните поколение и двигатель:</span>
		<select name="car" id="modelSelect">
                    <?php if($parents): ?>
                        <?php foreach($parents as $key => $value): ?>
                    <option data-url="obsluzhivanie/<?=$value->alias; ?>" value="<?=$value->id; ?>" <?=$value->id == $model->id ? 'selected="selected"' : ''; ?>><?=$value->car->title; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
		</select>
		<select name="generation" id="generationSelect">
                    <option value="" <?=!$f_gen ? 'selected="selected"' : ''; ?>>все поколения</option>
                        <?php if(@$model->car->generations): ?>
                            <?php foreach($model->car->generations as $key => $value): ?>
                                <option value="<?=$value->id;?>" <?=$value->id == $f_gen ? 'selected="selected"' : '';?>><?=$value->title;?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
		</select>
                <select name="motor" id="motorSelect">
                        <option value="" <?=!$f_motor ? 'selected="selected"' : ''; ?>>все моторы</option>
                        <?php if(@$current_engines): ?>
                            <?php foreach($current_engines as $key => $value): ?>
                                <option value="<?=$value->id;?>" <?=$value->id == $f_motor ? 'selected="selected"' : '';?>><?=$value->title;?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                </select>
                <?php if($f_gen): ?>
                <a class="filterReset" id="filterReset" href="<?= yii\helpers\Url::to(['obsluzhivanie/category', 'alias' => $model->alias]); ?>">Сбросить уточнение</a>
                <?php endif; ?>
	</div>
</div>
<div class="row">
	<div class="descParts">
		<?=$model->body; ?>
	</div>
	<div class="orderParts">
		<a href="<?= yii\helpers\Url::to(['/zapchasti/category', 'alias' => $model->alias]); ?>" class="btn red">
			<svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#settings"></use></svg>Запчасти <?=$model->car->title; ?>
		</a><br>
		<a href="<?= yii\helpers\Url::to(['/remont/category', 'alias' => $model->alias]); ?>" class="btn green">
			<svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#wrench"></use></svg>Ремонт <?=$model->car->title; ?>
		</a><br>
                <a class="btn calc">
			<svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#car"></use></svg>Обслуживание <?=$model->car->title; ?>
		</a>
	</div>
</div>


<div class="carWorks table bordered">
    <?php $flag = 1;?>
    <?php if(!empty($jobs)): ?>
    <?php foreach($jobs as $k => $v): ?>
    <a name="<?=$v['alias']?>"></a>
            <?php
                $open = '';
                $active = '';
                $check = '';
                if($slug && $slug == $v['alias'] || !$slug){
                    $open = 'open';
                    $active = 'active';
                    $check = 'checked="checked"';
                }
            ?>
	<div class="row subtopic <?=$active; ?>">
		<div class="name">
			<h3><label for="sys_<?=$v['alias']?>"><?=$v['title']; ?> <span></span></label></h3>
		</div>
		<div class="toggle">
			<label class="btn">
				<input type="checkbox" <?=$check; ?> value="slide_<?=$v['alias']?>" name="sys_<?=$v['alias']?>" id="sys_<?=$v['alias']?>">
				<svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#keyboard-down"></use></svg>
			</label>
		</div>
	</div>
	<div class="sys_slide_12 slide <?=$open; ?>" id="slide_<?=$v['alias']?>">
		<div class="row flex header">
			<div class="num">
				№:
			</div>
			<div class="workName">
				Наименование работ:
			</div>
			<div class="params">
				
				<div class="row flex">
					<div class="carModel">
						Модель, поколение и двигатель:
					</div>
					<div class="partsPrice">
						Стоимость запчастей:
					</div>
					<div class="workPrice">
						Стоимость работы:
					</div>
				</div>
			</div>
		</div>
		<?php if($v['jobs'] && !empty($v['jobs'])): ?>
                <?php foreach($v['jobs'] as $j_k => $j_v): ?>
		<div class="row work flex">
			<div class="num">
				<?=$flag; ?>.
			</div>
			<div class="workName">
				<?=$j_v['title']; ?>
			</div>
			<div class="params">
				<div class="priceGroup table bordered">
				<?php if($j_v['info']): ?>
                                    <?php foreach($j_v['info'] as $e_k => $e_v): ?>
					<div class="row flex car">
                                            <div class="carModel">
                                                <?php
                                                    $engines = array();
                                                    if($e_v['engines'] && !empty($e_v['engines'])){
                                                        foreach($e_v['engines'] as $zae_k => $zae_v){
                                                            $engines[$zae_k] = str_replace('Volvo ', '', $car->title) . ' ' . $zae_v['generation']['alter_title'] . ' ' . $zae_v['title'];
                                                        }
                                                    }
                                                ?>
                                                <?php
                                                //    echo '<pre>';
                                                 //   print_r($e_v);
                                                //    echo '<pre>';
                                                ?>
                                                <?=$engines && !empty($engines) ? implode($engines, ', ') : 'Все поколения и моторы' ?>
                                            </div>
						<div class="partsPrice">&nbsp;
                                                    <?php
                                                        $price = array();
                                                        if(!empty($e_v['parts'])){
                                                            foreach($e_v['parts'] as $p_k => $p_v){
                                                                $price[] = $p_v['price'];
                                                            }
                                                        }
                                                        $range = '-';
                                                        if(count($price) == 1){
                                                            $range = $price[0];
                                                        }elseif(count($price) > 1){
                                                            $range = min($price) . ' - ' . max($price); 
                                                        }
                                                    ?>
							<?=$range;?>
						</div>
						<div class="workPrice">
							<span><?=$e_v['price']; ?> <span class="ruble">p</span></span>
						</div>
					</div>
                                    <?php endforeach; ?>
                                   <?php endif; ?>
				</div>
			</div>
		</div>
                <?php $flag++; ?>
                <?php endforeach;?>
            <?php endif; ?>
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

		$('#modelSelect').change(function(){
			var url=$(this).find('option:selected').data('url');
			var modelId=$(this).find('option:selected').val();
			console.log(modelId);
			// save selected model in cookie
			$.cookie('fModel', modelId, { path:'/'});
			$.cookie('fGen', null, { path:'/'});
			$.cookie('fMotor', null, { path:'/'});
			window.location = PATH+url;
		});

		$('#generationSelect').change(function() {
			var genId = $(this).find('option:selected').val();
			console.log(genId);
			var modelId = parseInt($('#modelSelect').find('option:selected').val());
			$.cookie('fModel', modelId, { path:'/'});
			$.cookie('fGen', genId, { path:'/'});
			$.cookie('fMotor', null, { path:'/'});
			window.location.reload(true);
		});

		$('#motorSelect').change(function() {
			var motorId = $(this).find('option:selected').val();
			console.log(motorId);
			var modelId = parseInt($('#modelSelect').find('option:selected').val());
			var genId = parseInt($('#generationSelect').find('option:selected').val());
			$.cookie('fModel', modelId, { path:'/'});
			$.cookie('fGen', genId, { path:'/'});
			$.cookie('fMotor', motorId, { path:'/'});
			window.location.reload(true);
		});

		$('#filterReset').click(function(){
			console.log('reset car filter');
			$.cookie('fModel', null, { path:'/'});
			$.cookie('fGen', null, { path:'/'});
			$.cookie('fMotor', null, { path:'/'});
			window.location.reload(true);
		});

	});
</script>
    </div>
</div>
	</section>
