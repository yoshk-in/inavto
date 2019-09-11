<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Информационные страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index">

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
           // 'meta_title',
           // 'alias',
           // 'introtext',
            //'body:ntext',
            //'image',
            //'description:ntext',
            //'keywords:ntext',
            [
                'attribute' => 'main',
                'format' => 'html',
                'value' => function($data){
                    return $data->main ? '<span>Да</span>' : '<span>Нет</span>';
                }
            ],
            [
                'attribute' => 'menu',
                'format' => 'html',
                'value' => function($data){
                    return $data->menu ? '<span>Да</span>' : '<span>Нет</span>';
                }
            ],
            'created',
            //'modified',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
