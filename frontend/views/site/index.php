<?php 
    if ($this->beginCache('CalculatorWidget', ['duration' => 60])) { 
    echo \frontend\widgets\CalculatorWidget::widget(['tpl' => 'index', 'car_id' => 2, 'cache_time' => 60]);     
    $this->endCache(); } 
?>
	<section class="content">
		
<div class="row">
    <div class="span9 rpadd">
        <?php if(@$main_page): ?>
            <h1><?=$main_page->title; ?></h1>
            <?=$main_page->body; ?>
        <?php endif; ?>
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
	<style>
	.map {
		height: 400px;
		width: 100%;
	}
</style>
<?= \frontend\widgets\MapWidget::widget(['tpl' => 'index', 'cache_time' => 60])?>
