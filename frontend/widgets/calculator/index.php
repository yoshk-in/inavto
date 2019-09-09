<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Orders;

?>
<?php 
    if(!isset($model)) $model = new Orders;
    $form = ActiveForm::begin(); 
?>
	<!--<div class="calc_banner">
		<div class="in">
			<strong class="tmp">Калькулятор технического обслуживания</strong>
		</div>
	</div>-->
	<div class="serviceCalc" id="serviceCalc">
		<div class="in">
			<div class="row">
				<div class="span6 params">
					<div class="row param">
						<div class="span4 nameField">
							Модель автомобиля:
						</div>
						<div class="span8 inputField">
							<select name="model" id="modelSwitch">
                                             <?php foreach($cars as $key => $value): ?>               
                                                 <option data-carid="<?=$value->id?>" value="<?= str_replace('Volvo ', '', $value->title)?>" <?=$curent_car->id == $value->id ? 'selected="selected"' : ''; ?>><?=$value->title?></option>
                                            <?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="row param">
						<div class="span4 nameField">
							Поколение:
						</div>
						<div class="span8 inputField">
							<select name="generation" id="generationSwitch">
                                                            <?php $flag = 0; ?>
                                                            <?php foreach($curent_car->generations as $key => $value): ?>
                                                            <option value="<?=$value->id; ?>" <?=$flag == 0 ? 'selected="selected"' : ''; ?>><?=$value->title; ?></option>
                                                            <?php $flag++; ?>
                                                            <?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="row param">
						<div class="span4 nameField">
							Двигатель:
						</div>
						<div class="span8">
							<select name="motor" id="motorSwitch">
                                                            <?php $flag = 0; ?>
                                                            <?php foreach($curent_car->generations[0]->engines as $key => $value): ?>
								<option value="<?=$value->id;?>" <?=$flag == 0 ? 'selected="selected"' : ''; ?>><?=$value->title;?></option>
                                                                <?php $flag++; ?>
                                                                <?php endforeach; ?>
							</select>
							<input maxlength="2" type="hidden" name="range" value="1" id="inputHiddenRange" />
						</div>
					</div>
				</div>
				<div class="span6">
					<div class="row">
						<div class="selectedParams span6">
							<strong class="model" id="modelName"></strong>
							<span class="generation" id="generationName"></span>
							<span class="motor" id="motorName"></span>
							<span class="mileage" id="selectedRange"></span>
						</div>
						<div class="span6">
							<div class="volvo" id="volvoCarImage"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="rule">
				<div id="slider">
					<div class="val p1">
						<div class="miles">20 000 км</div>
						<div class="age">1 год</div>
					</div>
					<div class="val p2">
						<div class="miles">40 000 км</div>
						<div class="age">2 года</div>
					</div>
					<div class="val p3">
						<div class="miles">60 000 км</div>
						<div class="age">3 года</div>
					</div>
					<div class="val p4">
						<div class="miles">80 000 км</div>
						<div class="age">4 года</div>
					</div>
					<div class="val p5">
						<div class="miles">100 000 км</div>
						<div class="age">5 лет</div>
					</div>
					<div class="val p6">
						<div class="miles">120 000 км</div>
						<div class="age">6 лет</div>
					</div>
					<div class="val p7">
						<div class="miles">140 000 км</div>
						<div class="age">7 лет</div>
					</div>
					<div class="val p8">
						<div class="miles">160 000 км</div>
						<div class="age">8 лет</div>
					</div>
					<div class="val p9">
						<div class="miles">180 000 км</div>
						<div class="age">9 лет</div>
					</div>
					<div class="val p10">
						<div class="miles">200 000 км</div>
						<div class="age">10 лет</div>
					</div>
					<div class="val p11">
						<div class="miles">220 000 км</div>
						<div class="age">11 лет</div>
					</div>
					<div class="val p12">
						<div class="miles">240 000 км</div>
						<div class="age">12 лет</div>
					</div>
					<div class="val"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="works" id="serviceWorks">
		<div class="spinner"></div>
	</div>
	<div class="serviceResults row">
		<div class="firstCol">
			<button type="button" class="sendData" id="sendToData">
				<strong>Заказать ТО и сохранить данные</strong>
				<span class="info">Все данные будут отправлены на Ваш e-mail</span>
			</button>
		</div>
		<div class="secondCol">
			<span class="txt">Общая сумма ТО -</span> <strong><span class="totalPrice"></span> <span class="ruble">p</span></strong>
		</div>
	</div>
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