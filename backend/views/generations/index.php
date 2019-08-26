<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Поколения ' . $car->title;
$this->params['breadcrumbs'][] = ['label' => $car->title, 'url' => ['/cars/view', 'id' => $car->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="generations-index">

    <p>
        <?= Html::a('Добавить поколение', ['create', 'id' => $car->id], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'title',
                'format' => 'html',
                'value' => function($data){
                    return Html::a(
                        $data->title,
                        \yii\helpers\Url::to(['/engines', 'id' => $data->id]),
                        [
                            'title' => 'Перейти к двигателям',
                        ]
                    );
                } 
            ],
            [
                'attribute' => 'car_id',
                'format' => 'html',
                'value' => function($data){
                    return Html::a(
                        $data->car->title,
                        \yii\helpers\Url::to(['/cars/view', 'id' => $data->car_id]),
                        [
                            'title' => 'Перейти к автомобилю',
                        ]
                    );
                } 
            ],
            'created',
            'modified',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
