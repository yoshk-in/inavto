<?= \frontend\widgets\BannerWidget::widget(['tpl' => 'index', 'cache_time' => 60]); ?>
<section class="content">
		<div class="row">
    <div class="span12 text">
        <div class="dirs">
            <noindex><a href="<?= \yii\helpers\Url::home(); ?>">Главная</a></noindex>
            <svg class="i arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#keyboard-down"></use></svg><a href="<?= \yii\helpers\Url::to(['page', 'alias' => $model->title]); ?>"><?=$model->title; ?></a>
    
</div>
        <h1><?=$model->meta_title?></h1>
        <p>Компания ИНАВТО+, созданная в 1992 году как техническая площадка совместного советско-шведского предприятия по обслуживанию автомобилей Volvo, уже много лет оказывает качественные услуги по ремонту и техническому обслуживанию автомобилей частных и многочисленных корпоративных клиентов. В настоящее время это многопрофильный мультибрендовый сервис на двух площадках нашего города: на севере — Екатерининском проспекте д. 5 и на юге — ул Салова д. 68.
</p>
<h2>Фотографии сервиса на Екатерининском 5А</h2>
<?=$model->body; ?>
    </div>
</div>
	</section>