<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Messages */

$this->title = 'Добавить сообщение';
$this->params['breadcrumbs'][] = ['label' => 'Сообщения', 'url' => ['index']];
?>
<div class="messages-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
