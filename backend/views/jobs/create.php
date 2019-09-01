<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Jobs */

$this->title = 'Добавить работу';
$this->params['breadcrumbs'][] = ['label' => $current_category->title, 'url' => ['/jobs_categories/view', 'id' => $current_category->id]];
$this->params['breadcrumbs'][] = ['label' => 'Список работ', 'url' => ['index', 'id' => $current_category->id]];

?>
<div class="jobs-create">

    <?= $this->render('_form', [
        'model' => $model,
        'job_categories' => $job_categories,
        'current_category' => $current_category,
        'vaule_cats' => $vaule_cats,
        'engines' => $engines,
        'years' => $years
    ]) ?>

</div>
