<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PartsCategories */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Категории запчастей', 'url' => ['index']];
\yii\web\YiiAsset::register($this);
?>
<div class="parts-categories-view">

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Добавить', ['create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?php if($model->parent): ?>
            <?= Html::a('Список запчастей', ['/parts', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'menu_title',
            'meta_title',
            'alias',
            'body:html',
            [
                'attribute' => 'parent',
                'format' => 'html',
                'value' => function($data){
                    return $data->parent ? $data->parent : '<span>Самостоятельная категория</span>';
                } 
            ],
            'description:ntext',
            'keywords:ntext',
            'created',
            'modified',
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
        ],
    ]) ?>

</div>
