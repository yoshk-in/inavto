<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchJobsCategories */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории работ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jobs-categories-index">

    <p>
        <?= Html::a('Добавить категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'alias',
            'meta_title',
            'body:ntext',
            //'parent',
            //'service',
            //'description:ntext',
            //'keywords:ntext',
            //'created',
            //'modified',
            //'car_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
