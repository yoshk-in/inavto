<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Banners */

$this->title = 'Изменить баннер';
$this->params['breadcrumbs'][] = ['label' => 'Баннеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
?>
<div class="banners-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
