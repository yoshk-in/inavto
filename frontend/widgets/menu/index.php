<nav class="menu">
	<ul class="row">
		<li class="l1">
			<a href="/inavto">Наш сервис<svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#keyboard-down"></use></svg></a>
			<div class="popup standart">
				<div class="in">
					<div class="close"><svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#clear"></use></svg></div>
                                        <?php if(@$pages): ?>
                                        <?php $flag = 0; ?>
                                            <?php foreach($pages as $key => $value): ?>
                                            <?php if($flag%3 == 0): ?>
                                                <div class="row">
                                             <?php endif; ?>
						<div class="span4">
                                                    <a class="img" href="<?= \yii\helpers\Url::to(['site/page', 'alias' => $value->alias]); ?>"><img src="<?=$value->image; ?>" alt="<?=$value->title?>" /></a>
							<span class="txt">
								<a class="topic" href="<?= \yii\helpers\Url::to(['site/page', 'alias' => $value->alias]); ?>"><?=$value->title?></a>
								<p><?=$value->introtext?></p>
							</span>
						</div>
                                            <?php if(($flag+1)%3 == 0): ?>
                                                    </div>
                                                <?php endif; ?> 
                                                <?php $flag++ ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
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
                                                            <li><a href="<?= \yii\helpers\Url::to(['/zapchasti/subcategory', 'alias' => $value['alias'], 'slug' => $v['alias'], '#' => $v['alias']])?>"><?=$v['menu_title']; ?></a></li>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
							</ul>
						</div>
                                               <?php if(($flag+1)%3 == 0): ?>
                                                    </div>
                                                <?php endif; ?>
                                                <?php $flag++ ?>
                                            <?php endforeach; ?>
                                        <div class="span4">
                                                <strong class="topic"><a href="/bosch_spares_for_sale">Запчасти Bosch</a></strong>
                                                <a href="/bosch_spares_for_sale" style="background-image:url(/upload/upload/bosch_tr.png)" class="volvocar"></a>
                                                <ul><a href="/bosch_spares_for_sale">
                                                                        </a><li><a href="/bosch_spares_for_sale"></a><a href="/bosch_spares_for_sale">Компоненты для дизельных</a></li>
                                                                        <li><a href="/bosch_spares_for_sale">систем Bosch</a></li>
                                                                </ul>
                                                </div>
                                                </div>
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
                                                            <li><a href="<?= \yii\helpers\Url::to(['/remont/subcategory', 'alias' => $value['alias'], 'slug' => $v['alias'], '#' => $v['alias']])?>"><?=$v['menu_title']; ?></a></li>
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
                                                            <li><a href="<?= \yii\helpers\Url::to(['/obsluzhivanie/subcategory', 'alias' => $value['alias'], 'slug' => $v['alias'], '#' => $v['alias']])?>"><?=$v['menu_title']; ?></a></li>
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