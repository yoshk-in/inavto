<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Parts */

$this->title = 'Изменить запчасть';
$this->params['breadcrumbs'][] = ['label' => 'Запчасти', 'url' => ['index', 'id' => $current_category->id]];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'cat_id' => $current_category->id, 'id' => $model->id]];
?>
<div class="parts-update">

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
