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
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Добавить', ['create', 'id' => $model->pc_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'pc_id',
                'format' => 'html',
                'value' => function($data){
                    return $data->pc_id ? yii\helpers\Html::a($data->pc->title, yii\helpers\Url::to(['index', 'id' => $data->pc_id])) : '';
                }
            ],
            [
                'attribute' => 'car_id',
                'format' => 'html',
                'value' => function($data){
                    return $data->car_id ? yii\helpers\Html::a($data->car->title, yii\helpers\Url::to(['/cars/view', 'id' => $data->car_id])) : '';
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
                'attribute' => 'job_id',
                'format' => 'html',
                'value' => function($data){
                    return $data->job_id ? '<span>' . $data->job->title . '</span>' : '';
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
