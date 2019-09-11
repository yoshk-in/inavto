<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Contacts */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Котакты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
