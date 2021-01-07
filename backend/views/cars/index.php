<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Автомобили';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cars-index">

    <p>
        <?= Html::a('Добавить авто', ['create'], ['class' => 'btn btn-success']) ?>
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
                        \yii\helpers\Url::to(['/generations', 'id' => $data->id]),
                        [
                            'title' => 'Перейти к списку поколений',
                        ]
                    );
                }
            ],
           // 'img',
            'created',
          //  'modified',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
