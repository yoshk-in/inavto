<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Jobs */

$this->title = 'Изменить работу';
$this->params['breadcrumbs'][] = ['label' => 'Список работ', 'url' => ['index', 'id' => $current_category->id]];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'cat_id' => $current_category->id, 'id' => $model->id]];
?>
<div class="jobs-update">

    <?= $this->render('_form', [
        'model' => $model,
        'job_categories' => $job_categories,
        'current_category' => $current_category,
        'vaule_cats' => $vaule_cats,
        'engines' => $engines,
        'years' => $years
    ]) ?>

</div>
