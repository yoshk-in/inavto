<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Jobs */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Список работ', 'url' => ['index', 'id' => $cat_id]];
\yii\web\YiiAsset::register($this);
?>
<div class="jobs-view">

    <p>
        <?= Html::a('Изменить', ['update', 'cat_id' => $cat_id, 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'cat_id' => $cat_id, 'id' => $model->id], [
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
               'attribute' => 'works',
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
               'attribute' => 'generations',
                'format' => 'html',
                'value' => function($data){
                    $html = '';
                    foreach($data->generation as $key => $value){
                        $html .= '<p>' . Html::a($value->title, yii\helpers\Url::to(['/generations/view', 'id' => $value->id])) . '</p>';
                    }
                    return $html;
                }
            ],
            [
               'attribute' => 'engines',
                'format' => 'html',
                'value' => function($data){
                    $html = '';
                    foreach($data->motors as $key => $value){
                        $html .= '<p>' . Html::a($value->title, yii\helpers\Url::to(['/engines/view', 'id' => $value->id])) . '</p>';
                    }
                    return $html;
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
