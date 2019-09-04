<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PartsCategories */

$this->title = 'Create Parts Categories';
$this->params['breadcrumbs'][] = ['label' => 'Parts Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parts-categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
