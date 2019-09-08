<?= \frontend\widgets\BannerWidget::widget(['tpl' => 'index', 'cache_time' => 60]); ?>
<section class="content">
		<div class="row">
    <div class="span8 rpadd">
        <div class="dirs">
            <noindex><a href="<?= yii\helpers\Url::home();?>">Главная</a></noindex>
   
    <svg class="i arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#keyboard-down"></use></svg><a href="/zapchasti/">Запчасти Volvo</a>
   
</div>
        <h1>Запчасти Volvo</h1>
        <p>Автосервис ИНАВТО+ предлагает приобрести оригинальные и неоригинальные запчасти Volvo для всего модельного ряда. Наличие большинства запчастей и цены доступны в общей таблице. При необходимости Вы можете уточнить свою модель вольво и увидеть доступный список запчастей именно для нее.</p><p>Большинство самых распространенных запчастей вольво есть у нас в наличии, на нашем складе, время поступления других запчастей может составлять от одного до нескольких дней после заказа.
</p><p>Для заказа запчастей Вы можете позвонить по нашим контактным телефонам в заголовке сайта, либо оставить заявку через форму обратной связи
</p>
        <div class="fastOrder">
            <form method="POST" action="">
                <div class="btnGroup">
                    <input class="" type="text" name="phone" value="" placeholder="+7 ( ___ ) ___ - __ - __">
                    <select name="service">
                        <option>Выберите сервисную станцию</option>
                        <option value="ЮГ - Салова 68">ЮГ - Салова 68</option>
                        <option value="СЕВЕР - Екатериненский 5А">СЕВЕР - Екатериненский 5А</option>
                    </select>
                    <button type="submit" name="sendRepairOrder" value="1" class="btn success">Записаться на ТО Volvo</button>
                </div>
            </form>
        </div>
    </div>
    <div class="span4 cars">
         <?= \frontend\widgets\ListWidget::widget(['tpl' => 'index', 'flag' => 'zapchasti', 'cache_time' => 60]); ?>
    </div>
</div>



<p>Не найдена модель автомобиля s40.</p>


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
