<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchPartsCategories */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории запчастей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parts-categories-index">

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
              'attribute' => 'title',
                'format' => 'html',
                'value' => function($data){
                    return $data->parent ? Html::a($data->title, \yii\helpers\Url::to(['/parts', 'id' => $data->id]), ['title' => 'Перейти к списку запчастей']) : '<span>' . $data->title . '</span>';
                }
            ],
            'parent',
            [
                'attribute' => 'in_menu',
                'format' => 'html',
                'value' => function($data){
                    return $data->in_menu == 1 ? '<span>Да</span>' : '<span>Нет</span>';
                } 
            ],
            //'description:ntext',
            //'keywords:ntext',
            //'created',
            //'modified',
            //'car_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
