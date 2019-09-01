<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Parts */

$this->title = 'Изменить запчасть';
$this->params['breadcrumbs'][] = ['label' => 'Запчасти', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
?>
<div class="parts-update">

    <?= $this->render('_form', [
        'model' => $model,
        'part_category' => $part_category
    ]) ?>

</div>
