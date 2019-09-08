<?= \frontend\widgets\BannerWidget::widget(['tpl' => 'index', 'cache_time' => 60]); ?>
<section class="content">
		<div class="row">
    <div class="span8 rpadd">
        <div class="dirs">
	<noindex><a href="<?= yii\helpers\Url::home();?>">Главная</a></noindex>
        <svg class="i arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#keyboard-down"></use></svg> <a href="<?= yii\helpers\Url::to(['obsluzhivanie/index']);?>">Техническое и сервисное обслуживание Volvo</a>
</div>
        <h1>Обслуживание Volvo</h1>
        <p>Мы предлагаем Вам доступные цены на <em>профессиональный ремонт</em> Вашего автомобиля Volvo в сочетании с <em>честностью</em> и <em>прозрачностью</em> в работе. Наши мастера отлично знают устройство всех моделей Volvo, их проблемные узлы и часто встречающиеся неполадки. Уже больше 25 лет мы работаем на рынке ремонта и сервисного обслуживания автомобилей. Благодаря полученному опыту мы можем предложить своим клиентам отличное качество и дать гарантии на все свои работы.
</p><p>В наличии всегда есть большой выбор <a href="/zapchasti" target="_blank">всех запчастей для ремонта Volvo</a>, а наши менеджеры помогут подобрать оптимальные запчасти именно для Вашей модели авто.
</p><p>На сервисах ИНАВТО+ установлено современное ремонтное и диагностическое оборудование, есть охраняемая стоянка и видеонаблюдение. Для клиентов сервиса доступна комната отдыха с телевизором и бесплатным Wi-Fi.
</p><p>На нашем сайте Вы можете найти все цены на ремонт конкретной модели Volvo, а в <a href="/zapchasti">разделе запчастей</a> - уточнить наличие и стоимость деталей и расходных материалов.</p><p>Ознакомиться с основным перечнем работ по ремонту вольво и ценами Вы можете в таблице ниже, обратите внимание, что присутствует возможность уточнить свою модель авто, поколение и двигатель.</p>
        <div class="fastOrder">
            <form method="POST" action="">
                <div class="btnGroup">
                    <input class="" type="text" name="phone" value="" placeholder="+7 ( ___ ) ___ - __ - __">
                    <select name="service">
                        <option>Выберите сервисную станцию</option>
                        <option value="ЮГ - Салова 68">ЮГ - Салова 68</option>
                        <option value="СЕВЕР - Екатериненский 5А">СЕВЕР - Екатериненский 5А</option>
                    </select>
                    <button type="submit" name="sendRepairOrder" value="1" class="btn success">Записаться на ремонт</button>
                </div>
            </form>
        </div>
    </div>
    <div class="span4 cars">
         <?= \frontend\widgets\ListWidget::widget(['tpl' => 'index', 'flag' => 'zapchasti', 'cache_time' => 60]); ?>
    </div>
</div>

<?php if($jobs && !empty($jobs)): ?>
    <?php foreach($jobs as $key => $value): ?>
<div class="carWorks table bordered">
	<div class="topic">
		<h2><label for="open_group_12">Цены на работы по техническому обслуживанию <?=$value['car']['title']; ?></label></h2>
                <label for="open_group_<?=$value['id']; ?>">развернуть работы для <?=str_replace('Volvo ', '', $value['car']['title']);?></label>
		<input type="checkbox" id="open_group_<?=$value['id']; ?>" value="<?=$value['id']; ?>">
	</div>
    <?php $flag = 1;?>
    <?php if(!empty($value['jobs'])): ?>
    <?php foreach($value['jobs'] as $k => $v): ?>
    <a name="<?=$v['alias']?>_<?=$value['id']; ?>"></a>
	<div class="row subtopic sys_row_<?=$value['id']; ?>">
		<div class="name">
			<h3><label for="sys_<?=$v['alias']?>_<?=$value['id']; ?>"><?=$v['title']; ?> <span></span></label></h3>
		</div>
		<div class="toggle">
			<label class="btn">
				<input type="checkbox" value="slide_<?=$v['alias']?>_<?=$value['id']; ?>" class="sys_check_<?=$value['id']; ?>" name="sys_<?=$v['alias']?>_<?=$value['id']; ?>" id="sys_<?=$v['alias']?>_<?=$value['id']; ?>">
				<svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#keyboard-down"></use></svg>
			</label>
		</div>
	</div>
	<div class="sys_slide_<?=$value['id']; ?> slide" id="slide_<?=$v['alias']?>_<?=$value['id']; ?>">
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
                                                            $engines[$zae_k] = str_replace('Volvo ', '', $value['car']['title']) . ' ' . $zae_v['generation']['alter_title'] . ' ' . $zae_v['title'];
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
    <?php endforeach; ?>
<?php endif; ?>
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
	</section>
