<!-- // @changed 8.02.2021 -->
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
							<?php
                            
                            foreach ($cars as $key => $value) : ?>
								<option data-carid="<?= $value->id ?>" value="<?= str_replace('Volvo ', '', $value->title) ?>" <?= $curent_car->id == $value->id ? 'selected="selected"' : ''; ?>><?= $value->title ?></option>
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
							<?php foreach ($curent_car->generations as $key => $value) : ?>
								<option value="<?= $value->id; ?>" <?= $flag == 0 ? 'selected="selected"' : ''; ?>><?= $value->title; ?></option>
								<?php $flag++; ?>
							<?php endforeach; ?>
						</select>
					</div>
                </div>
                <div class="row">
					<div class="selectedParams span8">
						<strong class="model" id="modelName"></strong>
						<span class="generation" id="generationName"></span>
						<span class="motor" id="motorName"></span>
						<span class="mileage" id="selectedRange"></span>
					</div>
					<div class="span6">
						<div class="volvo" id="volvoCarImage"></div>
					</div>
				</div>
				<div class="row param">
					<div class="span4 nameField">
						Двигатель:
					</div>
					<div class="span8 inputField" id="engineSet">
						<?php foreach ($curent_car->generations[0]->engines as $key => $value) : ?>
						<span class="selectBtn">
                            <input type="radio" name="engineSet" id="engine<?= $value->id ?>" <?= $key == 0 ? 'checked="checked"' : '' ?> value="<?= $value->id ?>" >
                            <label for="engine<?= $value->id ?>"><?= $value->title ?></label>                            
						</span>
						<?php endforeach ?>					
						<!-- <select name="motor" id="motorSwitch"> -->
							<?php //$flag = 0; ?>
							<?php //foreach ($curent_car->generations[0]->engines as $key => $value) : ?>
								<!-- <option value="<?php //echo $value->id; ?>" <?php //echo $flag == 1 ? 'selected="selected"' : ''; ?>><?php //echo $value->title; ?></option> -->
								<?php // $flag++; ?>
							<?php //endforeach; ?>
						<!-- </select> -->
						<input maxlength="2" type="hidden" name="range" value="1" id="inputHiddenRange" />
					</div>
                </div>
                <div class="row param">
					<div class="span4 nameField">
						Пробег:
					</div>
					<div class="span8 inputField">
						<select name="distance" id="distance">
							<option value="1">20 000км</option>
							<option value="2">40 000км</option>
							<option value="3">60 000км</option>
							<option value="4">80 000км</option>
							<option value="5">100 000км</option>
							<option value="6">120 000км</option>
							<option value="7">140 000км</option>
							<option value="8">160 000км</option>
							<option value="9">180 000км</option>
							<option value="10">200 000км</option>
							<option value="11">220 000км</option>
							<option value="12">240 000км</option>
						</select>
					</div>
                </div>
                <div class="row param">
                    <div class="span4 nameField">Запчасти:</div>
                    <div class="span8 inputField">
                        <span class="partsBtn selectBtn">
                            <input type="radio" name="partsSet" id="partsOrigin">
                            <label for="partsOrigin">Оригинальные</label>                            
                        </span>
                        <span class="partsBtn selectBtn">
                            <input type="radio" name="partsSet" id="partsAnalog">
                            <label for="partsAnalog">Аналогичные</label>
                        </span>
                    </div>
                </div>
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
<script>
    // $(document).ready(() => {
    //     $('#partsOrigin').on('click', () => console.info('original parts selected'));
	// 	$('#partsAnalog').click(() => console.info('analog parts selected'));
	// 	let options = $('#motorSwitch').children('option');
	// 	$('#motorSwitch').attr('size', options.length);
		
    // })
</script>