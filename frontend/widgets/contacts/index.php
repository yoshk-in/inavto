<div class="service s1 span3" itemscope itemtype="http://schema.org/AutoRepair">
			<meta itemprop="name" content="Ремонт Volvo (вольво). Инавто+ это качественный ремонт Volvo на Салова 68">
			<meta itemprop="image" content="https://inavtospb.ru/img/inavto-144.png" />
	                <meta itemprop="priceRange" content="300-5000RUB" />
			<a href="/contacts#salova" class="showContacts" itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
				<meta itemprop="addressLocality" content="Санкт-Петербург, Россия" />
				<svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#placeholder"></use></svg>
				<?=str_replace(['<p>', '</p>'], '', $services[0]->alter_title);?>
			</a>
			<div itemprop="geo" itemscope="" itemtype="http://schema.org/GeoCoordinates">
				<meta itemprop="longitude" content="30.376824">
				<meta itemprop="latitude" content="59.886120">
			</div>
			<time itemprop="openingHours" datetime="Mo-Su 09:00−21:00" class="openinghours">
				<svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#timer"></use></svg>
				<?=$services[0]->start; ?> - <?=$services[0]->end; ?>, без выходных
			</time>
                        <?php if($services[0]->contacts && !empty($services[0]->contacts)): ?>
                        <?php foreach($services[0]->contacts as $key => $value): ?>
                        <?php if($value->type == 3): ?>
                        <div class="phone"><?=$arr[$value->type]; ?>: <span itemprop="faxNumber" class="number"><?=$value->title?></span></div>
                        <?php else: ?>
                        <div class="phone"><?=$arr[$value->type]; ?>: <a href="tel:+7<?=str_replace(['(', ')', ' ', '-'], '', $value->title);?>" class="number"><span itemprop="telephone"><?=$value->title?></span></a></div>
                        <?php endif; ?>
			<?php endforeach;?>
                        <?php endif; ?>
		</div>
		<div class="service s2 span4" itemscope itemtype="http://schema.org/AutoRepair">
			<meta itemprop="name" content="Ремонт Volvo (вольво). Инавто+ это качественный ремонт Volvo на Екатерининском 5А">
			<meta itemprop="image" content="https://inavtospb.ru/img/inavto-144.png" />
	                <meta itemprop="priceRange" content="300-5000RUB" />
			<a href="/contacts#ekat" class="showContacts" itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
				<meta itemprop="addressLocality" content="Санкт-Петербург, Россия" />
				<svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#placeholder"></use></svg>
				<?=str_replace(['<p>', '</p>'], '', $services[1]->alter_title);?>
			</a>
			<div itemprop="geo" itemscope="" itemtype="http://schema.org/GeoCoordinates">
				<meta itemprop="longitude" content="30.441819">
				<meta itemprop="latitude" content="59.978891">
			</div>
			<time itemprop="openingHours" datetime="Mo-Su 09:00−21:00" class="openinghours">
				<svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#timer"></use></svg>
				<?=$services[1]->start; ?> - <?=$services[1]->end; ?>, без выходных
			</time>
                        <?php if($services[1]->contacts && !empty($services[1]->contacts)): ?>
                        <?php foreach($services[1]->contacts as $key => $value): ?>
                        <?php if($value->type == 3): ?>
                        <div class="phone"><?=$arr[$value->type]; ?>: <span itemprop="faxNumber" class="number"><?=$value->title?></span></div>
                        <?php else: ?>
                        <div class="phone"><?=$arr[$value->type]; ?>: <a href="tel:+7<?=str_replace(['(', ')', ' ', '-'], '', $value->title);?>" class="number"><span itemprop="telephone"><?=$value->title?></span></a></div>
                        <?php endif; ?>
			<?php endforeach;?>
                        <?php endif; ?>
		</div>
