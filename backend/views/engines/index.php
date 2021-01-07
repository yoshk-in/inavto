<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Двигатели ' . $generation->car->title . ' ' . $generation->title;
$this->params['breadcrumbs'][] = ['label' => $generation->car->title . ' ' . $generation->title, 'url' => ['/generations/view', 'id' => $generation->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="engines-index">

    <p>
        <?= Html::a('Добавить двигатель', ['create', 'id' => $generation->id], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'generation_id',
                'format' => 'html',
                'value' => function($data){
                    return Html::a(
                        $data->generation->title,
                        \yii\helpers\Url::to(['/generations/view', 'id' => $data->generation_id]),
                        [
                            'title' => 'Перейти к поколению',
                        ]
                    );
                } 
            ],
            'created',
            //'modified',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
