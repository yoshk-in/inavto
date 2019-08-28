<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Jobs */

$this->title = 'Изменить работу';
$this->params['breadcrumbs'][] = ['label' => 'Список работ', 'url' => ['index', 'id' => $model->jc_id]];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
?>
<div class="jobs-update">

    <?= $this->render('_form', [
        'model' => $model,
        'job_category' => $job_category,
        'engines' => $engines,
        'years' => $years
    ]) ?>

</div>
