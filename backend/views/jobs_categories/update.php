<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\JobsCategories */

$this->title = 'Изменить категорию работ';
$this->params['breadcrumbs'][] = ['label' => 'Категории работ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
?>
<div class="jobs-categories-update">

    <?= $this->render('_form', [
        'model' => $model,
        'cars' => $cars,
        'parents' => $parents
    ]) ?>

</div>
