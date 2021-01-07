<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['index']];
\yii\web\YiiAsset::register($this);
?>
<div class="news-view">

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Добавить', ['create', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'meta_title',
            'alias',
            'introtext',
            'body:html',
            [
                'attribute' => 'publish',
                'format' => 'html',
                'value' => function($data){
                    return $data->publish ? '<span>Да</span>' : '<span>Нет</span>';
                }
            ],
            'description:ntext',
            'keywords:ntext',
            'created',
            'modified',
        ],
    ]) ?>

</div>
