<!-- // @changed 8.02.2021 -->
<nav class="menuToggle">
	<span><svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#menu"></use></svg></span>
	<ul>
		<li>
			<a href="<?= \yii\helpers\Url::to(['contacts/index']); ?>">Контакты</a>
		</li>
		<li>
			<a href="<?= \yii\helpers\Url::to(['news/index'])  ?>">Акции и новости</a>
		</li>
		<li>
			<a href="/inavto">Наш сервис</a>
		</li>
		
		<li>
                    <a id="service" href="<?= \yii\helpers\Url::to(['obsluzhivanie/index']); ?>">Обслуживание Volvo</a>
			<ul>
                            <?php if ($service_cats && !empty($service_cats)): ?>
                                <?php foreach ($service_cats as $key => $value): ?>
                                    <li><a href="<?= \yii\helpers\Url::to(['/obsluzhivanie/category', 'alias' => $value['alias']]); ?>"><span><?=$value['menu_title']; ?></span></a></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
			</ul>
		</li>
		<li>
                    <a id="repair" href="<?= \yii\helpers\Url::to(['remont/index']); ?>">Ремонт Volvo</a>
			<ul>
                            <?php if ($repair_cats && !empty($repair_cats)): ?>
                                <?php foreach ($repair_cats as $key => $value): ?>
                                    <li><a href="<?= \yii\helpers\Url::to(['/remont/category', 'alias' => $value['alias']]); ?>"><span><?=$value['title']; ?></span></a></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
			</ul>
		</li>
		<li>
			<a id="parts" href="<?= \yii\helpers\Url::to(['zapchasti/index']); ?>">Запасные части</a>
			<ul>
                            <?php if ($parts_cats && !empty($parts_cats)): ?>
                                <?php foreach ($parts_cats as $key => $value): ?>
                                    <li><a href="<?= \yii\helpers\Url::to(['/zapchasti/category', 'alias' => $value['alias']]); ?>"><span><?=$value['title']; ?></span></a></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
			</ul>
		</li>	
		

	</ul>
</nav>
<div class="backdrop"></div>
<script type="text/javascript">
	$(document).ready(function() {
		const state = {
			'dropdowns':[{'id':'#service', 'state': false},{'id': '#repair', 'state': false},{'id':"#parts", 'state': false}],
		};

		updatePopupHeight();

		$(window).resize(function(){
			updatePopupHeight();
		});
		
		state.dropdowns.forEach(item => {
			$(item.id).siblings('ul').hide();
			$(item.id).click(function (event) {
			event.preventDefault();
			event.stopPropagation();
			if (item.state) { 
				$(this).siblings('ul').hide();
				item.state = !item.state;
			} else {
				$(this).siblings('ul').show();
				item.state = !item.state;
			}
		});
		});
		

		$('.menuToggle').click(function(){
			$('.backdrop').toggleClass('show');
			$(this).toggleClass('show');
		});

		$('.backdrop').click(function(){
			// close popup
			$('.menuToggle').toggleClass('show',false);
			$(this).toggleClass('show',false);
		});

	});
	function updatePopupHeight() {
		var h=$(window).height();
		// update popup menu height
		$('.menuToggle>ul').css('max-height', h+'px');
	}
</script>