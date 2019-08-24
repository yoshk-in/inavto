<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchParts */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Parts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Parts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'pc_id',
            'car_id',
            'engine_id',
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
