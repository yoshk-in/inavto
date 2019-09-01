<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Parts */

$this->title = 'Добавить запчасть';
$this->params['breadcrumbs'][] = ['label' => 'Запчасти', 'url' => ['index', 'id' => $part_category->id]];
?>
<div class="parts-create">

    <?= $this->render('_form', [
        'model' => $model,
        'part_category' => $part_category
    ]) ?>

</div>
