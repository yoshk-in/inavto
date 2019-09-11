<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchParts */
/* @var $dataProvider yii\data\ActiveDataProvider */

$cat = $part_category->id;
$this->title = 'Запчасти - ' . $part_category->title;;
$this->params['breadcrumbs'][] = ['label' => 'Категории запчастей', 'url' => ['/parts_categories']];
?>
<div class="parts-index">

    <p>
        <?= Html::a('Добавить', ['create', 'id' => $part_category->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
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
             [
                'attribute' => 'brand_id',
                'format' => 'html',
                'value' => function($data){
                    return $data->brand_id ? $data->brand->title : '';
                }
            ],
            //'job_id',
            //'price',
            //'check',
            //'original',
            //'code',
            //'created',
            //'modified',

            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, $model, $key, $index) use ($cat) {
                    if ($action === 'update') {
                        return yii\helpers\Url::to(['update', 'cat_id' => $cat, 'id' => $model->id]);
                    }elseif($action === 'view'){
                        return yii\helpers\Url::to(['view', 'cat_id' => $cat, 'id' => $model->id]);
                    }
                    return yii\helpers\Url::to(['delete', 'cat_id' => $cat, 'id' => $model->id]);
                }
            ]
        ],
    ]); ?>


</div>
