<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Engines */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Двигатели ' . $model->generation->car->title . ' ' . $model->generation->title, 'url' => ['index', 'id' => $model->generation_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="engines-view">

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Добавить', ['create', 'id' => $model->generation_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'alter_title',
            [
                'attribute' => 'generation_id',
                'format' => 'html',
                'value' => function($data){
                    return Html::a(
                        $data->generation->car->title . ' ' . $data->generation->title,
                        \yii\helpers\Url::to(['/generations/view', 'id' => $data->generation_id]),
                        [
                            'title' => 'Перейти к поколениям ' . $data->generation->car->title,
                        ]
                    );
                } 
            ],
            'created',
            'modified',
        ],
    ]) ?>

</div>
