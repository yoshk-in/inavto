<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Jobs */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Список работ', 'url' => ['index', 'id' => $model->jc_id]];
\yii\web\YiiAsset::register($this);
?>
<div class="jobs-view">

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Добавить', ['create', 'id' => $model->jc_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
               'attribute' => 'jc_id',
                'format' => 'html',
                'value' => function($data){
                    return Html::a($data->jc->title, yii\helpers\Url::to(['index', 'id' => $data->jc_id]));
                }
            ],
            'price',
             [
               'attribute' => 'recomended',
                'format' => 'html',
                'value' => function($data){
                    return $data->recomended ? '<span>Да</span>' : '<span>Нет</span>';
                }
            ],
            'created',
            'modified',
        ],
    ]) ?>

</div>
