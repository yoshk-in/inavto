<form method="POST">
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
								<option data-carid="12" value="XC90" selected="selected">Volvo XC90</option>
<option data-carid="27" value="XC70">Volvo XC70</option>
<option data-carid="1" value="XC60">Volvo XC60</option>
<option data-carid="24" value="V50">Volvo V50</option>
<option data-carid="29" value="S80">Volvo S80</option>
<option data-carid="28" value="S60">Volvo S60</option>
<option data-carid="30" value="S40/V40">Volvo S40 и V40</option>
<option data-carid="31" value="C30">Volvo C30</option>
							</select>
						</div>
					</div>
					<div class="row param">
						<div class="span4 nameField">
							Поколение:
						</div>
						<div class="span8 inputField">
							<select name="generation" id="generationSwitch">
								<option value="20">II ( 2007 - 2015 )</option>
<option value="48">I ( 2002 - 2006 )</option>
							</select>
						</div>
					</div>
					<div class="row param">
						<div class="span4 nameField">
							Двигатель:
						</div>
						<div class="span8">
							<select name="motor" id="motorSwitch">
								<option value="29">Бензин  2.5 L</option>
<option value="91">Бензин  3.2 L</option>
<option value="71">Бензин  4.4 L</option>
<option value="64">Дизель 2.4 D</option>
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
	<div class="modal serviceModal">
		<span class="close close-btn"></span>
		<div class="modal-header">
			<h3>Заявка на техническое обслуживание</h3>
		</div>
		<div class="modal-body text-center">
			<div class="btnGroup">
				<input type="text" name="email" value="" placeholder="Ваш e-mail" />
				<input type="text" name="phone" value="" placeholder="+7 ( ___ ) ___ - __ - __" />
				<input type="hidden" name="type" value="" />
				<button type="submit" name="sendServiceOrder" value="1" class="btn success">Отправить данные</button>
			</div>
			<div class="alert alert-info">
				Данные по работам и запчастям будут моментально отправлены Вам на указанный e-mail.
			</div>
			
			
		</div>
	</div>
</form>
<script type="text/javascript" src="/js/avtoservice/avtoservice5.js"></script>
<script type="text/javascript">

	var srv = new avtoservice('serviceCalc','serviceWorks','sendToData');


	

	var cars = {
		'c12':{ 'model':'Volvo XC90','id_car':12,'generations': { 'g20': { 'id_gen':20,'generation':'II','motors': [ {'id_motor':29,'motorName':'Бензин  2.5 L','power':'0'}, {'id_motor':91,'motorName':'Бензин  3.2 L','power':'0'}, {'id_motor':71,'motorName':'Бензин  4.4 L','power':'0'}, {'id_motor':64,'motorName':'Дизель 2.4 D','power':'0'} ] ,'year_begin':2007,'year_end':2015 } , 'g48': { 'id_gen':48,'generation':'I','motors': [ {'id_motor':29,'motorName':'Бензин  2.5 L','power':'0'}, {'id_motor':63,'motorName':'Бензин  2.9 L','power':'0'}, {'id_motor':71,'motorName':'Бензин  4.4 L','power':'0'}, {'id_motor':64,'motorName':'Дизель 2.4 D','power':'0'} ] ,'year_begin':2002,'year_end':2006 }  } } , 'c27':{ 'model':'Volvo XC70','id_car':27,'generations': { 'g16': { 'id_gen':16,'generation':'II','motors': [ {'id_motor':32,'motorName':'Бензин  3.0 L','power':'0'}, {'id_motor':91,'motorName':'Бензин  3.2 L','power':'0'}, {'id_motor':23,'motorName':'Бензин 2.0 L','power':'0'}, {'id_motor':77,'motorName':'Дизель 2.0 D (5цил)','power':'0'}, {'id_motor':64,'motorName':'Дизель 2.4 D','power':'0'} ] ,'year_begin':2008,'year_end':2015 } , 'g19': { 'id_gen':19,'generation':'I','motors': [ {'id_motor':20,'motorName':'Бензин  2.3 L','power':'0'}, {'id_motor':25,'motorName':'Бензин  2.4 L','power':'0'}, {'id_motor':29,'motorName':'Бензин  2.5 L','power':'0'}, {'id_motor':64,'motorName':'Дизель 2.4 D','power':'0'} ] ,'year_begin':2001,'year_end':2007 }  } } , 'c1':{ 'model':'Volvo XC60','id_car':1,'generations': { 'g25': { 'id_gen':25,'generation':'I','motors': [ {'id_motor':32,'motorName':'Бензин  3.0 L','power':'0'}, {'id_motor':91,'motorName':'Бензин  3.2 L','power':'0'}, {'id_motor':77,'motorName':'Дизель 2.0 D (5цил)','power':'0'}, {'id_motor':64,'motorName':'Дизель 2.4 D','power':'0'} ] ,'year_begin':2009,'year_end':2015 }  } } , 'c24':{ 'model':'Volvo V50','id_car':24,'generations': { 'g43': { 'id_gen':43,'generation':'II','motors': [ {'id_motor':73,'motorName':'Бензин  1.6 L','power':'0'}, {'id_motor':33,'motorName':'Бензин  1.8 L','power':'0'}, {'id_motor':25,'motorName':'Бензин  2.4 L','power':'0'}, {'id_motor':29,'motorName':'Бензин  2.5 L','power':'0'}, {'id_motor':93,'motorName':'Дизель 1.6 D','power':'0'}, {'id_motor':77,'motorName':'Дизель 2.0 D (5цил)','power':'0'}, {'id_motor':64,'motorName':'Дизель 2.4 D','power':'0'} ] ,'year_begin':2004,'year_end':2012 }  } } , 'c29':{ 'model':'Volvo S80','id_car':29,'generations': { 'g30': { 'id_gen':30,'generation':'II','motors': [ {'id_motor':29,'motorName':'Бензин  2.5 L','power':'0'}, {'id_motor':32,'motorName':'Бензин  3.0 L','power':'0'}, {'id_motor':91,'motorName':'Бензин  3.2 L','power':'0'}, {'id_motor':71,'motorName':'Бензин  4.4 L','power':'0'}, {'id_motor':77,'motorName':'Дизель 2.0 D (5цил)','power':'0'}, {'id_motor':64,'motorName':'Дизель 2.4 D','power':'0'} ] ,'year_begin':2007,'year_end':2016 } , 'g28': { 'id_gen':28,'generation':'I','motors': [ {'id_motor':20,'motorName':'Бензин  2.3 L','power':'0'}, {'id_motor':25,'motorName':'Бензин  2.4 L','power':'0'}, {'id_motor':29,'motorName':'Бензин  2.5 L','power':'0'}, {'id_motor':23,'motorName':'Бензин 2.0 L','power':'0'}, {'id_motor':64,'motorName':'Дизель 2.4 D','power':'0'} ] ,'year_begin':2000,'year_end':2006 }  } } , 'c28':{ 'model':'Volvo S60','id_car':28,'generations': { 'g33': { 'id_gen':33,'generation':'II','motors': [ {'id_motor':73,'motorName':'Бензин  1.6 L','power':'0'}, {'id_motor':29,'motorName':'Бензин  2.5 L','power':'0'}, {'id_motor':32,'motorName':'Бензин  3.0 L','power':'0'}, {'id_motor':23,'motorName':'Бензин 2.0 L','power':'0'}, {'id_motor':93,'motorName':'Дизель 1.6 D','power':'0'}, {'id_motor':77,'motorName':'Дизель 2.0 D (5цил)','power':'0'}, {'id_motor':64,'motorName':'Дизель 2.4 D','power':'0'} ] ,'year_begin':2011,'year_end':2015 } , 'g31': { 'id_gen':31,'generation':'I','motors': [ {'id_motor':20,'motorName':'Бензин  2.3 L','power':'0'}, {'id_motor':25,'motorName':'Бензин  2.4 L','power':'0'}, {'id_motor':29,'motorName':'Бензин  2.5 L','power':'0'}, {'id_motor':23,'motorName':'Бензин 2.0 L','power':'0'}, {'id_motor':64,'motorName':'Дизель 2.4 D','power':'0'} ] ,'year_begin':2001,'year_end':2009 }  } } , 'c30':{ 'model':'Volvo S40 и V40','id_car':30,'generations': { 'g46': { 'id_gen':46,'generation':'II','motors': [ {'id_motor':73,'motorName':'Бензин  1.6 L','power':'0'}, {'id_motor':29,'motorName':'Бензин  2.5 L','power':'0'}, {'id_motor':23,'motorName':'Бензин 2.0 L','power':'0'}, {'id_motor':93,'motorName':'Дизель 1.6 D','power':'0'}, {'id_motor':107,'motorName':'Дизель 2.0 D (4цил)','power':'0'}, {'id_motor':77,'motorName':'Дизель 2.0 D (5цил)','power':'0'} ] ,'year_begin':2013,'year_end':2016 }  } } , 'c31':{ 'model':'Volvo C30','id_car':31,'generations': { 'g47': { 'id_gen':47,'generation':'I','motors': [ {'id_motor':73,'motorName':'Бензин  1.6 L','power':'0'}, {'id_motor':33,'motorName':'Бензин  1.8 L','power':'0'}, {'id_motor':25,'motorName':'Бензин  2.4 L','power':'0'}, {'id_motor':29,'motorName':'Бензин  2.5 L','power':'0'}, {'id_motor':23,'motorName':'Бензин 2.0 L','power':'0'}, {'id_motor':93,'motorName':'Дизель 1.6 D','power':'0'}, {'id_motor':77,'motorName':'Дизель 2.0 D (5цил)','power':'0'}, {'id_motor':64,'motorName':'Дизель 2.4 D','power':'0'} ] ,'year_begin':2007,'year_end':2013 }  } } 
	};


</script>