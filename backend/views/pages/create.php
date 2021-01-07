<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pages */

$this->title = 'Добавить страницу';
$this->params['breadcrumbs'][] = ['label' => 'Информационные страницы', 'url' => ['index']];
?>
<div class="pages-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
