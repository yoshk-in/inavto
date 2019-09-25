<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Years */

$this->title = 'Изменить год эксплуатации: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Года эксплуатации', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
?>
<div class="years-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
