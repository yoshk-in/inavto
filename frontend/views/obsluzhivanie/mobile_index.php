<!-- // @changed 8.02.2021 -->
<div class="content">
        <div class="dirs">
	<noindex><a href="<?= yii\helpers\Url::home();?>">Главная</a></noindex>
        <svg class="i arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#keyboard-down"></use></svg> <a href="<?= yii\helpers\Url::to(['obsluzhivanie/index']);?>">Ремонт Volvo</a>
</div>
<?php include Yii::getAlias('@frontend/views/helpers/car_select.php'); ?>



<?php if(isset($page) && $page->banners && !empty($page->banners)): ?>
<?= \frontend\widgets\BannerWidget::widget(['tpl' => 'index', 'banners' => $page->banners, 'cache_time' => 60]); ?>
<?php endif; ?>

<div>
        <h1><?=$page->title?></h1>
        <?=$page->body; ?>
</div>
