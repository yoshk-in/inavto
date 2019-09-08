<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Parts */

$this->title = 'Изменить: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Запчасти без категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
?>
<div class="parts-update">

    <?= $this->render('_form', [
        'model' => $model,
        'part_categories' => $part_categories,
        'engines' => $engines,
        'cars' => $cars,
        'value_cars' => $value_cars,
        'value_cats' => $value_cats,
    ]) ?>

</div>
