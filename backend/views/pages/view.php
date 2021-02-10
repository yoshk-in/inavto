<?php
// @changed 8.02.2021
use backend\models\Pages;
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
        <?= Html::a('Изменить', ['update', 'id' => $model->id, Pages::TABLE_NAME_PROP => Pages::$tableName], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id, Pages::TABLE_NAME_PROP => Pages::$tableName], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Добавить', ['create', 'id' => $model->id, Pages::TABLE_NAME_PROP => Pages::$tableName], ['class' => 'btn btn-warning']) ?>
        <?php if (Pages::isMobile()) : ?>
        <?= Html::a('Мобильная версия', ['view', 'id' => $model->id, Pages::TABLE_NAME_PROP => Pages::MOBILE], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Десктопная версия', ['view', 'id' => $model->id, Pages::TABLE_NAME_PROP => Pages::DESKTOP], ['class' => 'btn']) ?>
        <?php else : ?>
        <?= Html::a('Мобильная версия', ['view', 'id' => $model->id, Pages::TABLE_NAME_PROP => Pages::MOBILE], ['class' => 'btn']) ?>
        <?= Html::a('Десктопная версия', ['view', 'id' => $model->id, Pages::TABLE_NAME_PROP => Pages::DESKTOP], ['class' => 'btn btn-default']) ?>
        <?php endif ?>
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
