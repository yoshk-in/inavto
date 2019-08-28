<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Работы категории ' . $job_category->title;
$this->params['breadcrumbs'][] = ['label' => 'Категории работ', 'url' => ['/jobs_categories']];
?>
<div class="jobs-index">

    <p>
        <?= Html::a('Добавить работу', ['create', 'id' => $job_category->id], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'price',
            [
               'attribute' => 'recomended',
                'format' => 'html',
                'value' => function($data){
                    return $data->recomended ? '<span>Да</span>' : '<span>Нет</span>';
                }
            ],
            //'created',
            //'modified',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
