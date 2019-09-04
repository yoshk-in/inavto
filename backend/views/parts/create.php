<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model common\models\Parts */
$this->title = 'Добавить запчасть';
$this->params['breadcrumbs'][] = ['label' => $current_category->title, 'url' => ['/parts_categories/view', 'id' => $current_category->id]];
$this->params['breadcrumbs'][] = ['label' => 'Список запчастей', 'url' => ['index', 'id' => $current_category->id]];
?>
<div class="parts-create">

    <?= $this->render('_form', [
        'model' => $model,
            'part_categories' => $part_categories,
            'current_category' => $current_category,
            'value_cats' => $value_cats,
            'engines' => $engines,
            'cars' => $cars,
            'value_cars' => $value_cars,
    ]) ?>

</div>