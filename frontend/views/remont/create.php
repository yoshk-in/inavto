<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\JobsCategories */

$this->title = 'Create Jobs Categories';
$this->params['breadcrumbs'][] = ['label' => 'Jobs Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jobs-categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
