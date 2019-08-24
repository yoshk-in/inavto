<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Cars */

$this->title = 'Изменить авто: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Автомобили', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="cars-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
