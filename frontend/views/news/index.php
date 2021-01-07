<?php if($page->banners && !empty($page->banners)): ?>
<?= \frontend\widgets\BannerWidget::widget(['tpl' => 'index', 'banners' => $page->banners, 'cache_time' => 60]); ?>
<?php endif; ?>
<section class="content">
		<h1><?=$page->title; ?></h1>
<nav class="pagination nav">
    <?php
        echo \yii\widgets\LinkPager::widget([
           'pagination' => $pages,
        ]);
    ?>
</nav>

<ul class="listNews">
    <?php if(@$news): ?>
    <?php foreach($news as $key => $value): ?>
    <article>
        <time pubdate="" datetime="<?=Yii::$app->formatter->asDate($value->created, 'yyyy-MM-dd'); ?>"><?=Yii::$app->formatter->asDate($value->created, 'dd.MM.yyyy'); ?></time>
        <h3><a href="<?= \yii\helpers\Url::to(['news/page', 'alias' => $value->alias]); ?>"><?=$value->title;?>!</a></h3>
        <p><?=$value->introtext;?></p>
    </article>
    <?php endforeach; ?>
    <?php endif; ?>
</ul>
<nav class="pagination nav">
    <?php
        echo \yii\widgets\LinkPager::widget([
           'pagination' => $pages,
        ]);
    ?>
</nav>
			
	</section>