<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Jobs */

$this->title = 'Добавить работу';
$this->params['breadcrumbs'][] = ['label' => $job_category->title, 'url' => ['/cars/view', 'id' => $job_category->id]];
$this->params['breadcrumbs'][] = ['label' => 'Список работ', 'url' => ['index', 'id' => $job_category->id]];

?>
<div class="jobs-create">

    <?= $this->render('_form', [
        'model' => $model,
        'job_category' => $job_category,
        'engines' => $engines,
        'years' => $years
    ]) ?>

</div>
