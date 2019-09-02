<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Parts */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Запчасти', 'url' => ['index']];
\yii\web\YiiAsset::register($this);
?>
<div class="parts-view">

    <p>
        <?= Html::a('Изменить', ['update','cat_id' => $cat_id, 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete','cat_id' => $cat_id, 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Добавить', ['create', 'id' => $cat_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
               'attribute' => 'categories',
                'format' => 'html',
                'value' => function($data){
                    $html = '';
                    foreach($data->cats as $key => $value){
                        $html .= '<p>' . Html::a($value->title, yii\helpers\Url::to(['index', 'id' => $value->id])) . '</p>';
                    }
                    return $html;
                }
            ],
             [
                'attribute' => 'cars',
                'format' => 'html',
                'value' => function($data){
                    $html = '';
                    if($data->avtos && !empty($data->avtos))
                    foreach($data->avtos as $key => $value){
                        $html .= Html::a($value->title, yii\helpers\Url::to(['/cars/view', 'id' => $value->id])) . ' ';
                    }
                    return $html;
                }
            ],
            [
                'attribute' => 'generations',
                'format' => 'html',
                'value' => function($data){
                    $html = '';
                    if($data->generation && !empty($data->generation))
                    foreach($data->generation as $key => $value){
                        $html .= Html::a($value->title, yii\helpers\Url::to(['/generations/view', 'id' => $value->id])) . ' ';
                    }
                    return $html;
                }
            ],
            [
                'attribute' => 'engines',
                'format' => 'html',
                'value' => function($data){
                    $html = '';
                    if($data->engine && !empty($data->engine))
                    foreach($data->engine as $key => $value){
                        $html .= Html::a($value->title, yii\helpers\Url::to(['/engines/view', 'id' => $value->id])) . ' ';
                    }
                    return $html;
                }
            ],
            [
                'attribute' => 'brand_id',
                'format' => 'html',
                'value' => function($data){
                    return $data->brand_id ? yii\helpers\Html::a($data->brand->title, yii\helpers\Url::to(['/brands/view', 'id' => $data->brand_id])) : '';
                }
            ],
            [
                'attribute' => 'works',
                'format' => 'html',
                'value' => function($data){
                    $html = '';
                    if($data->jobs && !empty($data->jobs))
                    foreach($data->jobs as $key => $value){
                        $html .= Html::a($value->title, yii\helpers\Url::to(['/jobs/view', 'id' => $value->id])) . ' ';
                    }
                    return $html;
                }
            ],
            'price',
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
            'code',
            'created',
            'modified',
        ],
    ]) ?>

</div>
