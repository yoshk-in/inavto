<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */

$this->title = 'Изменить заказ №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы на ТО', 'url' => ['index']];
?>
<div class="orders-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
