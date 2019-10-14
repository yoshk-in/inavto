<section class="topBanner">
	<!--<div class="slide s1">
		<a href="/news/skidka-10-na-vsjo" target="_blank">
			<strong>Новогодняя акция: ждём Вас на бесплатный осмотр Вашего автомобиля</strong>
			<em>акция действует во всех сервис-центрах до конца года</em>
		</a>
	</div>-->
        <?php if($banners && !empty($banners)): ?>
        <?php foreach($banners as $key => $value): ?>
	<div class="slide s<?=$key+1; ?>">
            <span style="background-image: url('/upload/banners/prev/thumb_<?=$value->img?>');"></span>
		<a href="<?=$value->link; ?>" target="_blank">
			<strong><?=$value->slogan_one?></strong>
                        <?php if($value->slogan_two && !empty($value->slogan_two)): ?>
			<em><?=$value->slogan_two; ?></em>
                        <?php endif; ?>
		</a>
	</div>
        <?php endforeach; ?>
        <?php endif; ?>
</section>