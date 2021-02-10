<!-- // @changed 8.02.2021 -->
<section class="lastNews">
    <div class="archive">
        <a href="<?= \yii\helpers\Url::to(['/news/index'])?>">Новости и акции</a>
    </div>
    <?php if(@$data): ?>
        <?php foreach($data as $key => $value): ?>
        <article>
            <time pubdate datetime="<?= Yii::$app->formatter->asDate($value['modified'], 'yyyy-MM-dd'); ?>"><?= Yii::$app->formatter->asDate($value['modified'], 'dd.MM.yyyy'); ?></time>
            <h3><a href="<?=yii\helpers\Url::to(['news/page', 'alias' => $value['alias']]); ?>"><?= $value['title']; ?>!</a></h3>
            <p><?=$value['introtext']; ?></p>
        </article>
        <?php endforeach; ?>
    <?php endif; ?>
</section>