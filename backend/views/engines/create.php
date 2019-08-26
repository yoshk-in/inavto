<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Engines */

$this->title = 'Добавить двигатель ' . $generation->car->title . ' ' .$generation->title;
$this->params['breadcrumbs'][] = ['label' => 'Двигатели', 'url' => ['index', 'id' => $generation->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="engines-create">


    <?= $this->render('_form', [
        'model' => $model,
        'generation' => $generation
    ]) ?>

</div>
