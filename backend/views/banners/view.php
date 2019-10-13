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
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'img',
            'img_thumb',
            'sort',
            'created',
            'modified',
        ],
    ]) ?>

</div>
