<?php foreach($data as $key => $value): ?>
<li><a href="<?php echo \yii\helpers\Url::to(['publishes/article', 'link' => $value['alias']]); ?>"><?php echo $value['title']; ?></a></li>
<?php endforeach; ?>


