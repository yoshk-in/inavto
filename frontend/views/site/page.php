<?php if($model->banners && !empty($model->banners)): ?>
<?= \frontend\widgets\BannerWidget::widget(['tpl' => 'index', 'banners' => $model->banners, 'cache_time' => 60]); ?>
<?php endif; ?>
<section class="content">
		<div class="row">
    <div class="span12 text">
        <div class="dirs">
            <noindex><a href="<?= \yii\helpers\Url::home(); ?>">Главная</a></noindex>
            <svg class="i arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#keyboard-down"></use></svg><a href="<?= \yii\helpers\Url::to(['page', 'alias' => $model->title]); ?>"><?=$model->title; ?></a>
    
</div>
        <h1><?=$model->meta_title?></h1>
        <?=$model->body; ?>
    </div>
</div>
	</section>