<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Messages */

$this->title = 'Сообщение №'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Сообщения', 'url' => ['index']];
\yii\web\YiiAsset::register($this);
?>
<div class="messages-view">

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'phone',
            [
                'attribute' => 'service_id',
                'format' => 'html',
                'value' => function($data){
                   return $data->service->title;
                } 
            ],
            'email:email',
            'avto',
            'message',
            'created',
            'modified',
        ],
    ]) ?>

</div>
