<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchPartsCategories */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Parts Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parts-categories-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Parts Categories', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'meta_title',
            'alias',
            'body:ntext',
            //'parent',
            //'description:ntext',
            //'keywords:ntext',
            //'created',
            //'modified',
            //'car_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
