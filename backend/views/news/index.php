<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchNews */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
  //      'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'publish',
                'format' => 'html',
                'value' => function($data){
                    return $data->publish ? '<span>Да</span>' : '<span>Нет</span>';
                }
            ],
            //'body:ntext',
            //'image',
            //'description:ntext',
            //'keywords:ntext',
            'created',
            'modified',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
