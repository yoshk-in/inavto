<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Years */

$this->title = 'Добавить год эксплуатации';
$this->params['breadcrumbs'][] = ['label' => 'Года эксплуотации', 'url' => ['index']];
?>
<div class="years-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
