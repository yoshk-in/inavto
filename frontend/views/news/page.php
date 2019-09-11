<?= \frontend\widgets\BannerWidget::widget(['tpl' => 'index', 'cache_time' => 60]); ?>
<section class="content">
		<div class="row">
	<div class="span9 rpadd">
		<div class="dirs">
                    <noindex><a href="<?= yii\helpers\Url::home(); ?>">Главная</a></noindex>
                    <svg class="i arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#keyboard-down"></use></svg><a href="<?= yii\helpers\Url::to(['index']); ?>">Новости автосервиса</a>
</div>
		<h1><?=$model->title; ?></h1>
		<?=$model->body; ?>
	</div>
	<div class="span3">
            <?php
                if ($this->beginCache('NewsWidget', ['duration' => 60])) { 
                      echo  \frontend\widgets\NewsWidget::widget(['tpl' => 'index', 'cache_time' => 60]);
                $this->endCache(); } 
            ?>
	</div>
</div>
	</section>