<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Contacts */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Контакты', 'url' => ['index']];
\yii\web\YiiAsset::register($this);
?>
<div class="contacts-view">

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
         <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'service_id',
                'format' => 'html',
                'value' => function($data){
                   return $data->service->title;
                } 
            ],
            [
                'attribute' => 'type',
                'format' => 'html',
                'value' => function($data){
                    $arr = array(0 => 'Нет', 1 => 'Мастер', 2 => 'Запчасти', 3 => 'Факс');
                    foreach($arr as $key => $value){
                        if($data->type == $key){
                            return $value;
                        }
                    }
                } 
            ],
            'created',
            'modified',
        ],
    ]) ?>

</div>
