<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PartsCategories */

$this->title = 'Изменить категорию';
$this->params['breadcrumbs'][] = ['label' => 'Категории запчастей', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
?>
<div class="parts-categories-update">

    <?= $this->render('_form', [
        'model' => $model,
        'cars' => $cars,
        'parents' => $parents
    ]) ?>

</div>
