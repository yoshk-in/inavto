<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Services */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Сервичные центры', 'url' => ['index']];
?>
<div class="services-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
