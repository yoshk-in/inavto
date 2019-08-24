<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Generations */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Поколения ' . $model->car->title, 'url' => ['index', 'id' => $model->car_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="generations-view">

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Добавить', ['create', 'id' => $model->car_id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Двигатели', ['/engines', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'car_id',
                'format' => 'html',
                'value' => function($data){
                    return Html::a(
                        $data->car->title,
                        \yii\helpers\Url::to(['/cars/view', 'id' => $data->car_id]),
                        [
                            'title' => 'Перейти к автомобилю',
                        ]
                    );
                } 
            ],
            'created',
            'modified',
        ],
    ]) ?>

</div>
