<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-index">

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'service_id',
                'format' => 'html',
                'value' => function($data){
                   return $data->service->title;
                } 
            ],
            [
                'attribute' => 'type',
                'format' => 'html',
                'value' => function($data){
                    $arr = array(0 => 'Нет', 1 => 'Мастер', 2 => 'Запчасти', 3 => 'Факс');
                    foreach($arr as $key => $value){
                        return $data->type == $key ? $value : '';
                    }
                } 
            ],
            'created',
            //'modified',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
