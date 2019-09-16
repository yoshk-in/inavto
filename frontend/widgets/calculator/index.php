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