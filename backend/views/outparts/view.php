<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Parts */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Запчасти без категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="parts-view">

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
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
                    $check = '<span>Нет</span>';
                    if($data->check == 1){
                        $check = '<span>Да</span>';
                    }elseif($data->check == 2){
                        $check = '<span>Много</span>';
                    }
                    return $check;
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
