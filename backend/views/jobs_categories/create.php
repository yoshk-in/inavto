<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\JobsCategories */

$this->title = 'Добавить категорию';
$this->params['breadcrumbs'][] = ['label' => 'Категории работ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jobs-categories-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
