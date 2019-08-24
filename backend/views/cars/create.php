<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Cars */

$this->title = 'Добавить авто';
$this->params['breadcrumbs'][] = ['label' => 'автомобили', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cars-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
