<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PartsCategories */

$this->title = 'Добавить категорию запчастей';
$this->params['breadcrumbs'][] = ['label' => 'Категории запчастей', 'url' => ['index']];
?>
<div class="parts-categories-create">

    <?= $this->render('_form', [
        'model' => $model,
        'cars' => $cars,
        'parents' => $parents
    ]) ?>

</div>
