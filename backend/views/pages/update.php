<?php
// @changed 8.02.2021
use yii\helpers\Html;
use backend\models\Pages;

/* @var $this yii\web\View */
/* @var $model common\models\Pages */

$this->title = 'Изменить страницу';
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
?>
<div class="pages-update">

<?php if (Pages::isMobile()) : ?>
        <?= Html::a('Мобильная версия', ['update', 'id' => $model->id, Pages::TABLE_NAME_PROP => Pages::MOBILE], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Десктопная версия', ['update', 'id' => $model->id, Pages::TABLE_NAME_PROP => Pages::DESKTOP], ['class' => 'btn']) ?>
        <?php else : ?>
        <?= Html::a('Мобильная версия', ['update', 'id' => $model->id, Pages::TABLE_NAME_PROP => Pages::MOBILE], ['class' => 'btn']) ?>
        <?= Html::a('Десктопная версия', ['update', 'id' => $model->id, Pages::TABLE_NAME_PROP => Pages::DESKTOP], ['class' => 'btn btn-default']) ?>
<?php endif ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
