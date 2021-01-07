<ul class="listCars service">
    <?php if($data && !empty($data)): ?>
        <?php foreach($data as $key => $value): ?>
             <li>
                 <a href="<?= \yii\helpers\Url::to(['/'.$flag.'/category', 'alias' => $value['alias']]); ?>" class="<?=str_replace('volvo-', '', $value['alias']);?>"><?=$value['menu_title'] ? $value['menu_title'] : $value['title']; ?></a>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>