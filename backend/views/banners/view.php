<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Banners */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Баннеры', 'url' => ['index']];
\yii\web\YiiAsset::register($this);
?>
<div class="banners-view">

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'title',
            'slogan_one',
            'slogan_two',
            'link',
            [
              'attribute' => 'img',
              'format' => 'html',
              'value' => function($data){
                  return '<img src="'. Yii::getAlias('@front_path/upload/banners/prev').'/thumb_'.$data->img .'" alt="" style="max-width:300px;">';
              }
            ],
            [
                'attribute' => 'articles',
                'format' => 'html',
                'value' => function($data){
                    $html = '';
                    foreach($data->pages as $key => $value){
                        $html .= $value->title . '<br />';
                    }
                    return $html;
                }
            ],
            'sort',
            'created',
            'modified',
        ],
    ]) ?>

</div>
