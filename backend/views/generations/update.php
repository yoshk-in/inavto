<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Generations */

$this->title = 'Изменить поколение : ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Поколения ' . $model->car->title, 'url' => ['index', 'id' => $model->car_id]];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="generations-update">

    <?= $this->render('_form', [
        'model' => $model,
        'car' => $car
    ]) ?>

</div>
