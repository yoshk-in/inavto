<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сообщения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messages-index">

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'phone',
            'service_id',
            'email:email',
            [
              'attribute' => 'flag',
               'format' => 'html',
                'value' => function($data){
                    return $data->flag == 1 ? 'Заказ запчастей' : 'Запись на ТО';
                }
            ],
           // 'avto',
            //'message',
            'created',
            //'modified',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
