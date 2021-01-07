<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Brands */

$this->title = 'Добавить бренд';
$this->params['breadcrumbs'][] = ['label' => 'Бренды', 'url' => ['index']];
?>
<div class="brands-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
