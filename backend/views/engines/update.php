<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Engines */

$this->title = 'Изменить двигатель: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Двигатели', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="engines-update">

    <?= $this->render('_form', [
        'model' => $model,
        'generation' => $generation
    ]) ?>

</div>
