<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<?= \frontend\widgets\CalculatorWidget::widget(['tpl' => 'index', 'car_id' => 2, 'cache_time' => 60])?>
	<section class="content">
		
<div class="row">
    <div class="span9 rpadd">
        <?php if(@$main_page): ?>
            <h1><?=$main_page->title; ?></h1>
            <?=$main_page->body; ?>
        <?php endif; ?>
    </div>
    <div class="span3">
        <?= \frontend\widgets\NewsWidget::widget(['tpl' => 'index', 'cache_time' => 60])?>
    </div>
</div>
	</section>
	<style>
	.map {
		height: 400px;
		width: 100%;
	}
</style>
<?= \frontend\widgets\MapWidget::widget(['tpl' => 'index', 'cache_time' => 60])?>
