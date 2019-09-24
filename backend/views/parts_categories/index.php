<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchPartsCategories */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории запчастей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parts-categories-index">

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Запчасти без категории', ['outparts/index'], ['class' => 'btn btn-warning']) ?>
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
            'code',
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
            [
                'attribute' => 'brand_id',
                'format' => 'text',
                'value' => function($data){
                    return $data->brand_id ? $data->brand->title : '';
                }
            ],
            [
               'attribute' => 'categories',
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
               'attribute' => 'cars',
                'format' => 'text',
                'value' => function($data){
                    $html = array();
                    foreach($data->avtos as $key => $value){
                        $html[] = $value->id;
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
                    foreach($data->engine as $key => $value){
                        $html[] = $value->id;
                    }
                    return implode(', ', $html);
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ];

        // Renders a export dropdown menu
        echo ExportMenu::widget([
            'dataProvider' => $dataPParts,
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
                    return $data->parent ? Html::a($data->title, \yii\helpers\Url::to(['/parts', 'id' => $data->id]), ['title' => 'Перейти к списку запчастей']) : '<span>' . $data->title . '</span>';
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
            //'description:ntext',
            //'keywords:ntext',
            //'created',
            //'modified',
            //'car_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
