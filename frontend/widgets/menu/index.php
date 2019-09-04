<nav class="menu">
	<ul class="row">
		<li class="l1">
			<a href="/inavto">Наш сервис<svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#keyboard-down"></use></svg></a>
			<div class="popup standart">
				<div class="in">
					<div class="close"><svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#clear"></use></svg></div>
					<div class="row">
						<div class="span4">
							<a class="img" href="/inavto"><img src="/data/img/inavto-salova.jpg" alt="общая информация о сервисе" /></a>
							<span class="txt">
								<a class="topic" href="/inavto">Информация о сервисе</a>
								<p>Общая информация о наших площадках по обслуживанию и ремонту автомобилей Volvo. Фотографии сервисов и наши преимущества.</p>
							</span>
						</div>
						<div class="span4">
							<a class="img" href="/protochka-tormoznih-diskov"><img src="/data/img/protochka-tormoznih-diskov.jpg?v=2" alt="проточка тормозных дисков" /></a>
							<span class="txt">
								<a href="/protochka-tormoznih-diskov">Проточка тормозных дисков</a>
								<p>Услуги по восстановлению, обслуживанию и ремонту блоков цилиндров и головок, работы по проточке тормозных дисков.</p>
							</span>
						</div>
						<div class="span4">
							<a class="img" href="/vtoraya-pedal"><img src="/data/img/dubliruyushie-pedali.jpg?v.2.1" alt="дублирующие педали инструктора" /></a>
							<span class="txt">
								<a href="/vtoraya-pedal">Дублирующие педали</a>
								<p>Установка дублирующих педалей с тросовой передачей с выдачей комплекта документов для последующего оформления в ГАИ.</p>
							</span>
						</div>
					</div>
					<div class="row">
						<div class="span4">
							<a class="img" href="/diesel-bosch"><img src="/data/img/diesel-bosch.jpg?v.2.1" alt="дизельная аппаратура Bosch - диагностика и ремонт" /></a>
							<span class="txt">
								<a href="/diesel-bosch">Дизельная аппаратура Bosch</a>
								<p>Профессиональная диагностика и ремонт дизельной топливной аппаратуры Bosch в Санкт-Петербурге.</p>
							</span>
						</div>
						<div class="span4">
							<a class="img" href="/diesel-delphi"><img src="/data/img/diesel-delphi.jpg?v.2" alt="обслуживание дизельной аппаратуры Delphi" /></a>
							<span class="txt">
								<a href="/diesel-delphi">Дизельная аппаратура Delphi</a>
								<p>Мы первыми в России получили сертификат DIESEL SERVICE компании Delphi по ремонту и обслуживанию аппаратуры Common Rail.</p>
							</span>
						</div>
						<div class="span4">
							<a class="img" href="/diagnostika-volvo"><img src="/data/img/volvo-diagnostic-2.jpg?v.2.1" alt="диагностика вольво спб" /></a>
							<span class="txt">
								<a class="topic" href="/diagnostika-volvo">Диагностика Volvo</a>
								<p>Специализированные диагностические аппараты для проведения диагностики и оперативного обнаружения неисправностей.</p>
							</span>
						</div>
					</div>
				</div>
			</div>
		</li>
		<li class="l2">
			<a href="/zapchasti">Запасные части<svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#keyboard-down"></use></svg></a>
			<div class="popup">
				<div class="in">
					<div class="close"><svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#clear"></use></svg></div>
					<?php if($parts_cats && !empty($parts_cats)): ?>
                                            <?php $flag = 0; ?>
                                            <?php foreach($parts_cats as $key => $value): ?>
                                                <?php if($flag%3 == 0): ?>
                                                    <div class="row grid">
                                                <?php endif; ?>
                                                <div class="span4">
							<strong class="topic"><a href="<?= \yii\helpers\Url::to(['/zapchasti/category', 'alias' => $value['alias']]); ?>"><?=$value['title']; ?></a></strong>
                                                        <a href="<?= \yii\helpers\Url::to(['/zapchasti/category', 'alias' => $value['alias']]); ?>" class="volvocar <?=str_replace('volvo-', '', $value['alias']);?>"></a>
							<ul>
                                                            <?php if($value['childs'] && !empty($value['childs'])): ?>
                                                                <?php foreach($value['childs'] as $k => $v): ?>
                                                            <li><a href="<?= \yii\helpers\Url::to(['/zapchasti/subcategory', 'alias' => $value['alias'], 's' => $v['alias'], '#' => $v['alias']])?>"><?=$v['menu_title']; ?></a></li>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
							</ul>
						</div>
                                               <?php if(($flag+1)%3 == 0 || $flag == 7): ?>
                                                    </div>
                                                <?php endif; ?> 
                                                <?php $flag++ ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
				</div>
			</div>
		</li>
		<li class="l3">
			<a href="/remont">Ремонт Volvo<svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#keyboard-down"></use></svg></a>
			<div class="popup">
				<div class="in">
					<div class="close"><svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#clear"></use></svg></div>
					<?php if($repair_cats && !empty($repair_cats)): ?>
                                            <?php $flag = 0; ?>
                                            <?php foreach($repair_cats as $key => $value): ?>
                                                <?php if($flag%3 == 0): ?>
                                                    <div class="row grid">
                                                <?php endif; ?>
                                                <div class="span4">
							<strong class="topic"><a href="<?= \yii\helpers\Url::to(['/remont/category', 'alias' => $value['alias']]); ?>"><?=$value['title']; ?></a></strong>
                                                        <a href="<?= \yii\helpers\Url::to(['/remont/category', 'alias' => $value['alias']]); ?>" class="volvocar <?=str_replace('volvo-', '', $value['alias']);?>"></a>
							<ul>
                                                            <?php if($value['childs'] && !empty($value['childs'])): ?>
                                                                <?php foreach($value['childs'] as $k => $v): ?>
                                                            <li><a href="<?= \yii\helpers\Url::to(['/remont/subcategory', 'alias' => $value['alias'], 's' => $v['alias'], '#' => $v['alias']])?>"><?=$v['menu_title']; ?></a></li>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
							</ul>
						</div>
                                               <?php if(($flag+1)%3 == 0 || $flag == 7): ?>
                                                    </div>
                                                <?php endif; ?> 
                                                <?php $flag++ ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
				</div>
			</div>
		</li>
		<li class="l4">
			<a href="/to">Обслуживание Volvo<svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#keyboard-down"></use></svg></a>
			<div class="popup">
				<div class="in">
					<div class="close"><svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#clear"></use></svg></div>
					<?php if($service_cats && !empty($service_cats)): ?>
                                            <?php $flag = 0; ?>
                                            <?php foreach($service_cats as $key => $value): ?>
                                                <?php if($flag%3 == 0): ?>
                                                    <div class="row grid">
                                                <?php endif; ?>
                                                <div class="span4">
							<strong class="topic"><a href="<?= \yii\helpers\Url::to(['/obsluzhivanie/category', 'alias' => $value['alias']]); ?>"><?=$value['menu_title']; ?></a></strong>
                                                        <a href="<?= \yii\helpers\Url::to(['/obsluzhivanie/category', 'alias' => $value['alias']]); ?>" class="volvocar <?=str_replace('volvo-', '', $value['alias']);?>"></a>
							<ul>
                                                            <?php if($value['childs'] && !empty($value['childs'])): ?>
                                                                <?php foreach($value['childs'] as $k => $v): ?>
                                                            <li><a href="<?= \yii\helpers\Url::to(['/obsluzhivanie/subcategory', 'alias' => $value['alias'], 's' => $v['alias'], '#' => $v['alias']])?>"><?=$v['menu_title']; ?></a></li>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
							</ul>
						</div>
                                               <?php if(($flag+1)%3 == 0 || $flag == 7): ?>
                                                    </div>
                                                <?php endif; ?> 
                                                <?php $flag++ ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
				</div>
			</div>
		</li>
		<li class="l5"><a href="/contacts">Контакты</a></li>
	</ul>
</nav>
<script>
    $(document).ready(function(){
       $('nav.menu>ul>li>a').click(function(){

			var mode='opening';
			var li=$(this).parent();

			if(li.hasClass('active')) {
				mode='closing';
			}

			// reset all active buttons
			$('nav.menu>ul>li').toggleClass('active',false);
			// hide all popups
			$('nav.menu>ul>li .popup').toggleClass('show',false);

			// get popup
			var popup=li.find('.popup');

			if(mode=='opening') {
				li.toggleClass('active',true);
				if(popup.length) {
					popup.toggleClass('show',true);
					return false;
				} else {
					return true;
				}
			} else if(mode=='closing') {
				if(popup.length) {
					popup.toggleClass('show',false);
					return false;
				} else {
					return true;
				}
			}


		});
		$('nav.menu>ul>li>.popup .close').click(function(){

			var popup=$(this).parent().parent();
			var li=popup.parent();

			$('nav.menu>ul>li').toggleClass('active',false);
			popup.toggleClass('show',false);
		}); 
    });
</script>