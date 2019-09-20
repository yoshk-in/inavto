<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */

$this->title = 'Заказ на ТО №'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">

    <p>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'model',
            [
              'attribute' => 'generation_id',
                'format' => 'html',
                'value' => function($data){
                    return $data->generation->title;
                }
            ],
            [
              'attribute' => 'engine_id',
                'format' => 'html',
                'value' => function($data){
                    return $data->engine->title;
                }
            ],
            'year',
             [
                'attribute' => 'works',
                'format' => 'html',
                'value' => function($data){
                    $html = '';
                    foreach($data->jobs as $key => $value){
                        foreach($value->cats as $k => $v){
                            if($v->service)
                            $html .= '<p>' . Html::a($value->title . ' - '. $value->price, yii\helpers\Url::to(['jobs/view','cat_id' => $v->id, 'id' => $value->id])) . '</p>';
                        }
                    }
                    return $html;
                }
             ],
            [
                'attribute' => 'detales',
                'format' => 'html',
                'value' => function($data){
                    $html = '';
                    foreach($data->parts as $key => $value){
                        $html .= '<p>' . $value->code . ' - ' . $value->title . ' - '. $value->price  . '</p>';
                    }
                    return $html;
                }
             ],
            'email:email',
            'phone',
            'created',
            'modified',
        ],
    ]) ?>

</div>
