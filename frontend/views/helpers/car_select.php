<!-- // @changed 8.02.2021 -->

<div class="userCarSelect">
		<span><svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#filter-list"></use></svg> Уточните поколение и двигатель:</span>
		<select name="car" id="modelSelect">
                    
		</select>
		<select name="generation" id="generationSelect">
                    <option value="" selected="selected">все поколения</option>
		</select>
        <?php if ($render_engine) : ?>
                <select name="motor" id="motorSelect">
                <option value="" selected="selected">все двигатели</option>
                </select>
                
        <?php endif; ?>
                <button class="send-to-servicePage" id="send-to-servicePage" type="button">Выбрать</button>
    </div>

<script>
    const redirectState = {
        'path': '<?= Yii::$app->getUrlManager()->createAbsoluteUrl(Yii::$app->request->url) ?>',
        'to': '',
        'carId': '',
        'genId': '',
        'aliases': <?= json_encode($serviceAliases); ?>,
        set setCar (car) {
            this.to = this.aliases[car.id].alias;
            this.carId = car.id;
            $.cookie('fModel', this.carId, { path:'/'});
			$.cookie('fGen', null, { path:'/'});
			$.cookie('fMotor', null, { path:'/'});
        },
        set setGen(gen) {
            this.genId = gen.id
            $.cookie('fModel', this.carId, { path:'/'});
			$.cookie('fGen', this.genId, { path:'/'});
			$.cookie('fMotor', null, { path:'/'});
        },
        set setEng(eng) {
            console.log(eng);
            $.cookie('fModel', this.carId, { path:'/'});
			$.cookie('fGen', this.genId, { path:'/'});
			$.cookie('fMotor', eng.id, { path:'/'});
        },
        get url () {
            return this.path+'/'+this.to;
        }
    };

    const optionPattern = function (text, value) {
        return `<option value="${value}">${text}</option>`;
    }

    const fillSelects = function (car) {
        redirectState.setCar = car;
        $('#modelSelect').children(car.id).css('selected', 'selected');
        initGenerationSelect(car);
        var firstGen = car.generations[Object.keys(car.generations)[0]];
        initEngineSelect(firstGen);
    }

    const initCarSelect = function (cars) {
        console.log('rerender cars');
        var carSelect = $('#modelSelect');
        carSelect.children().remove();
        Object.entries(cars).forEach((car,key) => {
            car = car[1];
            carSelect.append($(optionPattern(car.title, car.id)));
        });
        var firstKey = Object.keys(cars)[0];
        fillSelects(cars[firstKey]);

        carSelect.children().click(event => fillSelects(cars[event.target.value]));
    }

    const initGenerationSelect = function (car) {
        console.log('rerender generations');
        var genSelect = $('#generationSelect');
        genSelect.children().remove();
        Object.entries(car.generations).forEach((gen, key) => {
            gen = gen[1];            
            genSelect.append($(optionPattern(gen.title, gen.id)));
        });
        genSelect.children().click (event => {
            initEngineSelect(car.generations[event.target.value]);            
        })
        genSelect.children().first().css('selected','selected');
    }

    const initEngineSelect = function (gen) {
        redirectState.setGen = gen;
        var motorSelect = $('#motorSelect');
        console.log('rerender engines');
        motorSelect.children().remove();
        gen.engines.forEach((motor, key) => {
            motorSelect.append($(optionPattern(motor.title, motor.id)));            
        });
        motorSelect.children().click(event => { redirectState.setEng = gen.engines[event.target.value]; });
        motorSelect.children().first().css('selected', 'selected');
        redirectState.setEng = gen.engines[0];
        console.log(redirectState);
    }

    $(document).ready(function () {
        var cars = <?= json_encode($init_cars_to_js); ?>;           
        initCarSelect(cars);  
        $('#send-to-servicePage').click( () => {
            window.location.href = redirectState.url;
        });

    });
</script>