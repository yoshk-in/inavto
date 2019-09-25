<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use yii\widgets\ActiveForm;

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
    <p>
        <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data'],
        ]); ?>
                 <?= $form->field($model, 'file', ['inputOptions'=>['required'=>'required']])->fileInput() ?>
            <div class="form-group">
                <?= Html::submitButton('Импорт', ['class' => 'btn btn-success']) ?>
            </div>
        <?php ActiveForm::end(); ?>
    </p>
    <?php
        $gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title',
            'price',
            [
               'attribute' => 'works',
                'format' => 'text',
                'value' => function($data){
                    $html = array();
                    foreach($data->cats as $key => $value){
                        $html[] = $value->id;
                    }
                    return implode(', ', $html);
                }
            ],
            [
               'attribute' => 'comment',
                'format' => 'text',
                'value' => function($data){
                    $html = array();
                    foreach($data->cats as $key => $value){
                        $html[] = $value->title;
                    }
                    return implode(', ', $html);
                }
            ],
            [
                'attribute' => 'generations',
                'format' => 'text',
                'value' => function($data){
                    $html = array();
                    foreach($data->generation as $key => $value){
                        $html[] = $value->id;
                    }
                    return implode(', ', $html);
                }
            ],
            [
                'attribute' => 'engines',
                'format' => 'text',
                'value' => function($data){
                    $html = array();
                    foreach($data->motors as $key => $value){
                        $html[] = $value->id;
                    }
                    return implode(', ', $html);
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ];

        // Renders a export dropdown menu
        echo ExportMenu::widget([
            'dataProvider' => $dataJobs,
            'columns' => $gridColumns
        ]);
        ?>
    
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
                    return $data->parent ? Html::a($data->title, \yii\helpers\Url::to(['/jobs', 'id' => $data->id]), ['title' => 'Перейти к списку работ']) : '<span>' . $data->title . '</span>';
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
