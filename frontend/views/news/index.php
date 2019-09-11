<?= \frontend\widgets\BannerWidget::widget(['tpl' => 'index', 'cache_time' => 60]); ?>
<section class="content">
		<h1>Архив новостей и акций</h1>
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
        <h3><a href="<?= \yii\helpers\Url::to(['news', 'alias' => $value->alias]); ?>"><?=$value->title;?>!</a></h3>
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