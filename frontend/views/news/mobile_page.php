<div class="content">
		<div class="dirs">
                    <noindex><a href="<?= yii\helpers\Url::home(); ?>">Главная</a></noindex>
                    <svg class="i arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#keyboard-down"></use></svg><a href="<?= yii\helpers\Url::to(['index']); ?>">Новости автосервиса</a>
</div>
		<h1><?=$model->title; ?></h1>
		<?=$model->body; ?>
	</div>