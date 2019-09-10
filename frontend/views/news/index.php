<section class="content">
		<h1>Архив новостей и акций</h1>
<nav class="pagination nav">
    <ul>
        <li class="current"><a href="?page=1">1</a></li><li><a href="?page=2">2</a></li>
    </ul>
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
    <ul>
        <li class="current"><a href="?page=1">1</a></li><li><a href="?page=2">2</a></li>
    </ul>
</nav>
			
	</section>