<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchParts */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Запчасти - ' . $category->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parts-index">

    <p>
        <?= Html::a('Добавить', ['create', 'id' => $category->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
           // 'car_id',
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
