<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pages */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Информационные страницы', 'url' => ['index']];
\yii\web\YiiAsset::register($this);
?>
<div class="pages-view">

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
            'image',
            [
              'attribute' => 'image',
                'format' => 'html',
                'value' => function($data){
                    return $data->image ? '<img src="' . Yii::getAlias('@front_path') . $data->image . '" alt="" />' : '';
                }
            ],
            'description:ntext',
            'keywords:ntext',
            [
                'attribute' => 'main',
                'format' => 'html',
                'value' => function($data){
                    return $data->main ? '<span>Да</span>' : '<span>Нет</span>';
                }
            ],
            [
                'attribute' => 'menu',
                'format' => 'html',
                'value' => function($data){
                    return $data->menu ? '<span>Да</span>' : '<span>Нет</span>';
                }
            ],
            'created',
            'modified',
        ],
    ]) ?>

</div>
