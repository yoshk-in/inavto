<?php
use yii\widgets\ActiveForm;
?>
<?php
    if(!isset($model)) $model = new \frontend\models\Orders;
    $form = ActiveForm::begin([
        'action'=>\yii\helpers\Url::toRoute(['site/order']),
    ]); 
?>
<?php 
    if ($this->beginCache('CalculatorWidget', ['duration' => 60])) { 
    echo \frontend\widgets\CalculatorWidget::widget(['tpl' => 'index', 'car_id' => 2, 'cache_time' => 60]);     
    $this->endCache(); } 
?>
<div class="modal serviceModal <?=Yii::$app->session->hasFlash('show') ? Yii::$app->session->getFlash('show') : ''; ?>">
		<span class="close close-btn"></span>
		<div class="modal-header">
			<h3>Заявка на техническое обслуживание</h3>
		</div>
		<div class="modal-body text-center">
			<div class="btnGroup">
				<!--<input type="text" name="email" value="" placeholder="Ваш e-mail" />-->
                                <?= $form->field($model, 'email', [
                                   'inputOptions'=>['placeholder' => 'Ваш e-mail'],
                                   'template'=>"{input}",
                                    'options' => [
                                        'tag' => null
                                    ],
                                ])->textInput() ?>
                                <?= $form->field($model, 'phone', [
                                   'inputOptions'=>['placeholder' => '+7 ( ___ ) ___ - __ - __'],
                                   'template'=>"{input}",
                                    'options' => [
                                        'tag' => null
                                    ],
                                ]); ?>
				<input type="hidden" name="type" value="" />
				<button type="submit" name="sendServiceOrder" value="1" class="btn success">Отправить данные</button>
			</div>
			<div class="alert alert-info">
				Данные по работам и запчастям будут моментально отправлены Вам на указанный e-mail.
			</div>
                        <?php if( Yii::$app->session->hasFlash('success') ): ?>
                            <div class="alert alert-success">
                                <div><?php echo Yii::$app->session->getFlash('success'); ?></div>
                            </div>
                        <?php endif;?>
                        <?php if( Yii::$app->session->hasFlash('error') ): ?>
                            <div class="alert alert-error">
                                <div><?php echo Yii::$app->session->getFlash('error'); ?></div>
                            </div>
                        <?php endif;?>
		</div>
	</div>
<?php ActiveForm::end(); ?>

<?php if ($this->beginCache('ScriptsWidget', ['duration' => 60])): ?>
<script type="text/javascript" src="/js/avtoservice/avtoservice5.js"></script>
<script type="text/javascript">

	var srv = new avtoservice('serviceCalc','serviceWorks','sendToData');

	var cars = {
            <?php $flag = 0; ?>
            <?php $len_cars = count($cars); ?>
            <?php foreach($cars as $key => $value): ?>
		'c<?=$value->id; ?>':{
                    'model':'<?=$value->title; ?>',
                    'id_car':'<?=$value->id; ?>',
                    'generations': {
                        <?php $i = 0; ?>
                        <?php $len_gen = count($value->generations); ?>
                        <?php foreach($value->generations as $k => $v): ?>
                        'g<?=$v->id; ?>': { 
                            'id_gen':'<?=$v->id; ?>',
                            'generation':'<?=$v->alter_title; ?>',
                            'motors': [
                                <?php $item = 0; ?>
                                <?php $len = count($v->engines); ?>
                                <?php foreach($v->engines as $e_k => $e_v): ?>
                                {
                                    'id_motor':'<?=$e_v->id; ?>',
                                    'motorName':'<?=$e_v->title; ?>',
                                    'power':'0'
                                }<?=$item == $len -1 ? '' : ',' ?>
                                <?php $item++; ?>
                                <?php endforeach; ?>
                            ],
                            'year_begin': '<?=$v->start; ?>',
                            'year_end': '<?=$v->end; ?>' 
                        }<?=$i == $len_gen -1 ? '' : ',' ?>
                                <?php $i++; ?>
                        <?php endforeach; ?>
                    }
                }<?=$flag == $len_cars -1 ? '' : ',' ?>
                                <?php $flag++; ?>
             <?php endforeach; ?>
	};


</script>
<?php $this->endCache(); ?>
<?php endif; ?>
	<section class="content">
		
<div class="row">
    <div class="span9 rpadd">
        <?php if(@$main_page): ?>
            <h1><?=$main_page->title; ?></h1>
            <?=$main_page->body; ?>
        <?php endif; ?>
    </div>
    <div class="span3">
        <?php
            if ($this->beginCache('NewsWidget', ['duration' => 60])) { 
                  echo  \frontend\widgets\NewsWidget::widget(['tpl' => 'index', 'cache_time' => 60]);
            $this->endCache(); } 
        ?>
    </div>
</div>
	</section>
	<style>
	.map {
		height: 400px;
		width: 100%;
	}
</style>
<?= \frontend\widgets\MapWidget::widget(['tpl' => 'index', 'cache_time' => 60])?>
