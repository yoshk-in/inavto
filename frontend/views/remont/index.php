<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jobs Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jobs-categories-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Jobs Categories', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
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
            //'menu_title',
            //'in_menu',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
