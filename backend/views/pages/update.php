<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pages */

$this->title = 'Изменить страницу';
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
?>
<div class="pages-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
