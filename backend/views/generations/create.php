<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Generations */

$this->title = 'Добавить поколение ' . $car->title;
$this->params['breadcrumbs'][] = ['label' => 'Поколения' . $car->title, 'url' => ['index', 'id' => $car->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="generations-create">

    <?= $this->render('_form', [
        'model' => $model,
        'car' => $car
    ]) ?>

</div>
