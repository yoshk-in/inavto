<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Messages */

$this->title = 'Изменить';
$this->params['breadcrumbs'][] = ['label' => 'Сообщения', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Сообщение №'.$model->id, 'url' => ['view', 'id' => $model->id]];
?>
<div class="messages-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
