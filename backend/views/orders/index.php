<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchOrders */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'model',
          //  'generation_id',
           // 'engine_id',
           // 'year',
            //'email:email',
            //'phone',
            'created',
            'modified',

            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        return yii\helpers\Url::to(['view', 'id' => $model->id]);
                    }elseif($action === 'delete'){
                        return yii\helpers\Url::to(['delete', 'id' => $model->id]);
                    }
                    return false;
                }
            ]
        ],
    ]); ?>


</div>
