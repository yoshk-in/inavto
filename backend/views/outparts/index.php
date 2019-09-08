<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Запчасти без категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parts-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'check',
                'format' => 'html',
                'value' => function($data){
                    return $data->check ? '<span>Да</span>' : '<span>Нет</span>';
                }
            ],
            [
                'attribute' => 'original',
                'format' => 'html',
                'value' => function($data){
                    return $data->original ? '<span>Да</span>' : '<span>Нет</span>';
                }
            ],
            //'generation_id',
            //'brand_id',
            //'job_id',
            //'price',
            //'check',
            //'original',
            //'code',
            //'created',
            //'modified',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
