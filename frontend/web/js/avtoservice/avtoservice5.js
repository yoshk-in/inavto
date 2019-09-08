
function avtoservice(idCalc, idWorks, idSendBtn) {
    var t = this;
    t.idCalc = idCalc;
    t.idWorks = idWorks;
    t.idSendBtn = idSendBtn;

    $(document).ready(function(){
        t.init();
    });
}

avtoservice.prototype = {
    n: {
        'calc': false,
        'worksDest': false,
        'sendBtn': false,
        'modelSwitch': false,
        'generationSwitch': false,
        'motorSwitch': false,
        'carImage': false,
        'modelName': false,
        'generationName': false,
        'motorName': false,
        'rangeValue': false,
        'results': { 'parent':false, 'totalPrice':false },
        'totalPrice': false,
        'modal': { 'parent':false },
        // dynamic nodes
        'mandatory': { 'table': false, 'slide': false },
        'recommended': { 'table': false, 'slide': false }
    },
    // service data
    d: {
        'motorId': false,
        'shortModel': false,
        'genId':false,
        'range': false,
        'modelName': false,
        'generationName': false,
        'motorName': false,
        'requestId': false
    },
    requestId: 0,
    lastData: {
        'motorId': false,
        'genId': false,
        'shortModel': false,
        'range': 2
    },
    countWorks: 0,

    modelSwitch: function() {
        var t=this;
        var carId=parseInt(t.n.modelSwitch.find('option:selected').data('carid'));
        var carIndex='c'+carId;

        // show car generations
        t.n.generationSwitch.html('');

        // show car generations by selected model
        if(cars[carIndex].generations != undefined) {
            
            // show generations
            for(g in cars[carIndex].generations) {

                var genData=cars[carIndex].generations[g];

                var years='';
                if(genData.year_begin) {
                    years=' ( '+genData.year_begin+' - ';
                    if(genData.year_end) {
                        years += genData.year_end;
                    } else {
                        years +='н.в'
                    }
                    years+=' )';
                }
                t.n.generationSwitch.append('<option value="'+genData.id_gen+'">'+genData.generation+years+'</option>');
            }
          
            t.genSwitch();

        }
    },

    genSwitch: function() {

        var t=this;
        var carId=parseInt(t.n.modelSwitch.find('option:selected').data('carid'));
        var carIndex='c'+carId;
        var genId=parseInt(t.n.generationSwitch.find('option:selected').val());
        var genIndex='g'+genId;

        // show motors in selected car generation
        t.n.motorSwitch.html('');

        // show motors by selected car generation
        if('generations' in cars[carIndex]) {
            if(genIndex in cars[carIndex].generations) {
                if('motors' in cars[carIndex].generations[genIndex]) {
                    for(m in cars[carIndex].generations[genIndex].motors) {

                        var motorData=cars[carIndex].generations[genIndex].motors[m];
                        var pwr='';
                        if(motorData.power > 0) {
                            pwr+=', '+motorData.power+' л.c';
                        }
                        t.n.motorSwitch.append('<option value="'+motorData.id_motor+'">'+motorData.motorName+pwr+'</option>');

                    }
                }
            }
        }

        t.calc();
    },

    calc: function() {

        var t=this;
        t.d.shortModel=t.n.modelSwitch.val().toLowerCase();
        t.d.genId=parseInt(t.n.generationSwitch.val());
        t.d.motorId=parseInt(t.n.motorSwitch.val());

        t.n.inputRange.val(t.d.range);

        // reset results
        t.n.worksDest.html('<div class="spinner"></div>');

        // switch image
        t.n.carImage.attr('class','volvo').toggleClass(t.d.shortModel,true);

        // show model and motor name
        t.d.modelName=t.n.modelSwitch.find('option:selected').text();
        t.d.generationName=t.n.generationSwitch.find('option:selected').text();
        t.d.motorName=t.n.motorSwitch.find('option:selected').text();

        var rangeKm = t.d.range*20000;

        var years = t.d.range+' ';
        if(t.d.range == 1) {
            years += 'год';
        } else if (t.d.range >= 2 && t.d.range <= 4) {
            years += 'года';
        } else {
            years += 'лет';
        }

        if(t.d.range == 12) {
            years += ' и больше';
        }

        t.n.modelName.text(t.d.modelName);

        t.n.generationName.text(t.d.generationName);

        if(t.d.motorName) {
            t.n.motorName.text('Двигатель '+t.d.motorName);
        } else {
            t.n.motorName.text('');
        }

        $('#selectedRange').text(rangeKm.formatMoney(false)+' км / '+years);

        // check full data
        if(t.d.shortModel == '' || !t.d.genId || !t.d.motorId || !t.d.range) {

            t.n.worksDest.html('<span class="warning">Выберите модель, поколение, двигатель и пробег/возраст автомобиля.</span>');

        } else {

            t.n.worksDest.toggleClass('loading', true);

            // set current request id
            t.requestId++;
            t.d.requestId=t.requestId;

            // get works by car and motor
            var url=PATH+'site/calculator';
            
            $.ajax({
                type: "GET",
                data: t.d,
                dataType: "json",
                url: url,
                success: function (data) {
                    t.n.worksDest.toggleClass('loading',false);
                    if(data.error) {
                        console.log(data.error);
                    } else {
                        t.showResults(data);
                    }
                }
            });
        }
    },

    showResults: function(data) {

        var t=this;

        if (data.errors) {
            console.log(data.errors);
            return;
        }

        t.countWorks = 0;
        var totalPrice=0;

        var mandatoryWorksPrice = '';
        if(data.mandatoryWorksPrice) {
            totalPrice+=parseInt(data.mandatoryWorksPrice);
            mandatoryWorksPrice = parseInt(data.mandatoryWorksPrice).formatMoney(false);
        }

        var mandatoryPartsPrice = '&nbsp;';
        if(data.mandatoryPartsMin) {
            totalPrice+=parseInt(data.mandatoryPartsMin);
            mandatoryPartsPrice = '<span class="type">Зап.части </span><span class="val">'+parseInt(data.mandatoryPartsMin).formatMoney(false)+'</span><span class="ruble">p</span>';
        }

        var mandatoryResultPrice = '&nbsp;';
        if(data.mandatoryPartsMin && data.mandatoryWorksPrice) {
            mandatoryResultPrice=data.mandatoryPartsMin+data.mandatoryWorksPrice;
            mandatoryResultPrice = '<span class="type">Итого </span><strong><span class="val">'+parseInt(mandatoryResultPrice).formatMoney(false)+'</span><span class="ruble">p</span></strong>';
        }

        var recommendedWorksPrice = '&nbsp;';
        if(data.recommendedWorksPrice) {
            totalPrice+=parseInt(data.recommendedWorksPrice);
            recommendedWorksPrice = parseInt(data.recommendedWorksPrice).formatMoney(false);
        }

        var recommendedPartsPrice = '&nbsp;';
        var partsMinPrice=0;
        if(data.recommendedPartsMin) {
            partsMinPrice=parseInt(data.recommendedPartsMin);
            totalPrice+=partsMinPrice;
            recommendedPartsPrice = '<span class="type">Зап.части </span><span class="val">'+partsMinPrice.formatMoney(false)+'</span> <span class="ruble">p</span>';
        }

        var recommendedResultPrice = '&nbsp;';
        if(data.mandatoryPartsMin && data.mandatoryWorksPrice) {
            recommendedResultPrice=data.recommendedPartsMin+data.recommendedWorksPrice;
            recommendedResultPrice = '<span class="type">Итого </span><strong><span class="val">'+parseInt(recommendedResultPrice).formatMoney(false)+'</span><span class="ruble">p</span></strong>';
        }

        //console.log("ml="+data.works.mandatory.length+" rl="+data.works.recommended.length);
        console.log(data);

        if(!data.works.mandatory.length && !data.works.recommended.length) {

            t.n.worksDest.append('<p>Работ не найдено.</p>');
            // hide price
            t.n.results.txt.hide();

        } else {

            t.n.mandatory.table = $('<div class="listWorks table bordered">' +
                '<div class="row subtopic active" id="subtopic_mandatory_works">'+
                '<div class="icon"><label for="mandatory_works"><svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#wrench"></use></svg></label></div>'+
                '<div class="name shortName"><h3>'+
                '<label for="mandatory_works">Обязательные работы</label></h3></div>' +
                '<div class="workPrice"><span class="type">Работа </span> <span class="val">'+mandatoryWorksPrice+'</span><span class="ruble">p</span></div>' +
                '<div class="partsPrice">'+mandatoryPartsPrice+'</div>' +
                '<div class="resultPrice" data-totalprice="'+partsMinPrice+'">'+mandatoryResultPrice+'</div>' +
                '<div class="toggle"><label class="btn"><input type="checkbox" checked="checked" value="slide_mandatory_works" id="mandatory_works" /> <svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#keyboard-up"></use></svg></label></div>'+
                '</div>');

            t.n.signatures = $('<div class="row header signatures"><div class="num">&nbsp;</div><div class="workCheck">&nbsp;</div><div class="workName">Наименование работ:</div><div class="workPrice">Стоимость работ:</div><div class="partsPrice">Стоимость запчастей:</div><div class="lastEmpty">&nbsp;</div></div>');

            t.n.mandatory.slide = $('<div class="slide open" id="slide_mandatory_works"></div>');

            t.n.recommended.table = $('<div class="listWorks table bordered">' +
                '<div class="row subtopic active" id="subtopic_recommended_works">' +
                '<div class="icon"><label for="recommended_works"><svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#wrench"></use></svg></label></div>'+
                '<div class="name"><h3>'+
                '<label for="recommended_works">Рекомендуемые работы</label></h3></div>' +
                '<div class="workPrice"><span class="type">Работа </span> <span class="val">'+recommendedWorksPrice+'</span><span class="ruble">p</span></div>' +
                '<div class="partsPrice">'+recommendedPartsPrice+'</div>' +
                '<div class="resultPrice">'+recommendedResultPrice+'</div>' +
                '<div class="toggle"><label class="btn"><input type="checkbox" checked="checked" value="slide_recommended_works" id="recommended_works" /> <svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#keyboard-up"></use></svg></label></div>'+
                '</div>');

            t.n.recommended.slide = $('<div class="slide open" id="slide_recommended_works"></div>');

            // check exists mandatory works
            if(data.works.mandatory.length) {
                t.n.mandatory.table.append(t.n.mandatory.slide.append(t.n.signatures));
                t.n.worksDest.append(t.n.mandatory.table);
            }

            // check exists recommended works
            if(data.works.recommended.length) {
                t.n.recommended.table.append(t.n.recommended.slide.append(t.n.signatures.clone()));
                t.n.worksDest.append(t.n.recommended.table);
            }

            t.n.results.txt.show();
            t.n.results.totalPrice.html(totalPrice.formatMoney(false));

        }

        // mandatory works
        if(data.works.mandatory.length) {
            for(index in data.works.mandatory) {

                // MANDATORY WORK ITERATION

                var nSetsOfParts=false;

                // add work row
                t.countWorks++;
                var wd=data.works.mandatory[index];

                var strPrice='-';
                var price=0;
                if(price = parseInt(wd['price'])) {
                    strPrice = price.formatMoney(true)+' <span class="ruble">p</span>';
                }

                var strPeriod='&nbsp;';
                if(wd['period'] > 0) {
                    strPeriod = '<svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#timer"></use></svg> '+wd['period']+' час.';
                }

                var strPartsPrice = '-';
                var minPartsPrice=parseInt(wd['minPartsPrice']);
                var maxPartsPrice=parseInt(wd['maxPartsPrice']);

                console.log('mandatory work minPartsPrice = '+minPartsPrice+' maxPartsPrice = '+maxPartsPrice);

                if((minPartsPrice != 0  && maxPartsPrice == 0) || (minPartsPrice != 0 && maxPartsPrice != 0 && (minPartsPrice == maxPartsPrice))) {
                    strPartsPrice = minPartsPrice.formatMoney(false)+' <span class="ruble">p</span>'
                } else if(minPartsPrice != 0 && maxPartsPrice != 0 && (minPartsPrice < maxPartsPrice)) {
                    strPartsPrice = minPartsPrice.formatMoney(false)+' - '+maxPartsPrice.formatMoney(false)+' <span class="ruble">p</span>';
                }

                var strSelectParts='';
                var nSetsOfParts=false;
                var strName=wd['name'];

                if('sets' in wd && wd.sets.length) {

                    strName = strName;//'<label for="slide_parts_'+wd.id_work+'">'+strName+'</label>';
                    strSelectParts = '<input class="slide_check" type="checkbox" data-workid="'+wd.id_work+'" value="slide_parts_'+wd.id_work+'" id="slide_parts_'+wd.id_work+'" /><label class="btn small showSets" for="slide_parts_'+wd.id_work+'">' +
                        '<svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#keyboard-up"></use></svg>' +
                        'выбрать запчасти</label>';

                    // create sets of parts
                    var nSetsOfParts=$('<div class="setsOfParts" id="setsOfParts_'+wd.id_work+'"></div>');
                    if(typeof sets != "undefined") {
                        if(typeof sets[wd.id_work] != "undefined") {
                            // open slide
                            nSetsOfParts.toggleClass('open',true);
                        }
                    }

                    for(s in wd.sets) {

                        var set=wd.sets[s];
                        if(!set.price) {
                            continue;
                        }

                        var partsPrice=parseInt(set.price);

                        var strSetPrice = partsPrice.formatMoney(true)+' <span class="ruble">p</span>';

                        var nSet=$('<div class="set"><div class="row"><div class="select"><input data-partsPrice="'+partsPrice+'" data-workid="'+wd.id_work+'" type="radio" name="set['+wd.id_work+']" id="parts_set_'+set.id_set+'" value="'+set.id_set+'" /></div><div class="name"><label for="parts_set_'+wd.sets[s].id_set+'"><div class="info">Набор запчастей для работы</div><strong>'+set.setName+'</strong></label></div><div class="setPrice"><div class="info">Общая стоимость запчастей</div><strong>'+strSetPrice+'</strong></div><div class="arrow"><svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#arrow-down"></use></svg></div></div></div>');


                        if(typeof sets != "undefined") {
                            if(sets[wd.id_work] == set.id_set) {
                                nSet.find('input[type="radio"]').attr('checked','checked');
                            }
                        }

                        // get parts in set
                        if('parts' in set && set.parts.length) {
                            for(p in set.parts) {
                                var part=set.parts[p];
                                var strPartPrice='';
                                if(part.price) {
                                    partPrice = parseInt(part.price).formatMoney(false);
                                    strPartPrice = partPrice+' <span class="ruble">p</span><div class="desc">за 1 шт.</div>';
                                }
                                var strTotalPartPrice='';
                                if(part.totalPrice) {
                                    totalPartsPrice = parseInt(part.totalPrice).formatMoney(false);
                                    strTotalPartPrice = totalPartsPrice+' <span class="ruble">p</span>';
                                }
                                var strVendor='';
                                if(part.vendor != null) {
                                    strVendor=', '+part.vendor;
                                }
                                var nPart=$('<div class="part row"><div class="num">'+(parseInt(p)+1)+'.</div><div class="partName">'+part.partName+strVendor+'<div class="articul">'+part.articul+'</div></div><div class="partCount">'+part.count+' шт.</div><div class="partPrice">'+strPartPrice+'</div><div class="partTotalPrice">'+strTotalPartPrice+'</div><div class="arrow"></div></div>');
                                nSet.append(nPart);
                            }
                        }

                        nSetsOfParts.append(nSet);
                    }
                }

                var nWorkRow = $('<div class="work" id="row_work_'+wd.id_work+'"><div class="row flex"><div class="num">'+t.countWorks+'.</div>' +
                    '<div class="workCheck"><input id="check_work_'+wd.id_work+'" data-workid="'+wd.id_work+'" type="checkbox" name="mand[]" value="'+wd.id_work+'" checked="checked" disabled="disabled" /></div>' +
                    '<div class="workName"><label for="check_work_'+wd.id_work+'">'+strName+'</label></div>' +
                    '<div class="workPrice" data-price="'+price+'">'+strPrice+'</div>' +
                    '<div class="partsPrice" data-partsprice="'+minPartsPrice+'" data-workid="'+wd.id_work+'">'+strPartsPrice+'</div>' +
                    '<div class="selectParts">'+strSelectParts+'</div>' +
                    '</div></div>');

                t.n.mandatory.slide.append(nWorkRow);
                if(nSetsOfParts!==false) {
                    nWorkRow.append(nSetsOfParts);
                }
            }


        }

        // recommended works
        if(data.works.recommended.length) {
            for(index in data.works.recommended) {

                // RECOMMENDED WORK ITERATION

                var nSetsOfParts=false;

                t.countWorks++;

                var wd=data.works.recommended[index];

                var strPrice='';
                var price=0;
                if(price = parseInt(wd['price'])) {
                    strPrice = price.formatMoney(true)+' <span class="ruble">p</span>';
                }

                var strPeriod='&nbsp;';
                if(wd['period'] > 0) {
                    strPeriod = '<svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#timer"></use></svg> '+wd['period']+' час.';
                }

                var strPartsPrice = '-';
                var minPartsPrice=parseInt(wd['minPartsPrice']);
                var maxPartsPrice=parseInt(wd['maxPartsPrice']);

                console.log('recommended work minPartsPrice = '+minPartsPrice+' maxPartsPrice = '+maxPartsPrice);

                if((minPartsPrice != 0  && maxPartsPrice == 0) || (minPartsPrice != 0 && maxPartsPrice != 0 && (minPartsPrice == maxPartsPrice))) {
                    strPartsPrice = minPartsPrice.formatMoney(false)+' <span class="ruble">p</span>'
                } else if(minPartsPrice != 0 && maxPartsPrice != 0 && (minPartsPrice < maxPartsPrice)) {
                    strPartsPrice = minPartsPrice.formatMoney(false)+' - '+maxPartsPrice.formatMoney(false)+' <span class="ruble">p</span>';
                }

                var strSelectParts='';
                var nSetsOfParts=false;
                var strName=wd['name'];

                if('sets' in wd && wd.sets.length) {

                    strName = strName;//'<label for="slide_parts_' + wd.id_work + '">' + strName + '</label>';

                    strSelectParts = '<input class="slide_check" type="checkbox" data-workid="' + wd.id_work + '" value="slide_parts_' + wd.id_work + '" id="slide_parts_' + wd.id_work + '" /><label class="btn small showSets" for="slide_parts_' + wd.id_work + '">' +
                        '<svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#keyboard-up"></use></svg>' +
                        'выбрать запчасти</label>';

                    // create sets of parts
                    var nSetsOfParts=$('<div class="setsOfParts" id="setsOfParts_'+wd.id_work+'"></div>');
                    if(typeof sets != "undefined") {
                        if(sets[wd.id_work]) {
                            // open slide
                            nSetsOfParts.toggleClass('open',true);
                        }
                    }

                    for(s in wd.sets) {
                        var set=wd.sets[s];
                        if(!set.price) {
                            continue;
                        }
                        var partsPrice=parseInt(set.price);

                        var strSetPrice = partsPrice.formatMoney(true)+' <span class="ruble">p</span>';

                        var nSet=$('<div class="set"><div class="row"><div class="select"><input data-partsprice="'+partsPrice+'"  data-workid="'+wd.id_work+'" type="radio" name="set['+wd.id_work+']" id="parts_set_'+set.id_set+'" value="'+set.id_set+'" /></div><div class="name"><label for="parts_set_'+wd.sets[s].id_set+'"><div class="info">Набор запчастей для работы</div><strong>'+set.setName+'</strong></label></div><div class="setPrice"><div class="info">Общая стоимость запчастей</div><strong>'+strSetPrice+'</strong></div><div class="arrow"><svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#arrow-down"></use></svg></div></div></div>');

                        if(typeof sets != "undefined") {
                            if(sets[wd.id_work] == set.id_set) {
                                nSet.find('input[type="radio"]').attr('checked','checked');
                            }
                        }

                        // get parts in set
                        if('parts' in set && set.parts.length) {
                            for(p in set.parts) {
                                var part=set.parts[p];
                                var strPartPrice='';
                                if(part.price) {
                                    partPrice = parseInt(part.price).formatMoney(false);
                                    strPartPrice = partPrice+' <span class="ruble">p</span><div class="desc">за 1 шт.</div>';
                                }
                                var strTotalPartPrice='';
                                if(part.totalPrice) {
                                    totalPrice = parseInt(part.totalPrice).formatMoney(false);
                                    strTotalPartPrice = totalPrice+' <span class="ruble">p</span>';
                                }

                                var strVendor='';
                                if(part.vendor != null) {
                                    strVendor=', '+part.vendor;
                                }
                                var nPart=$('<div class="part row"><div class="num">'+(parseInt(p)+1)+'.</div><div class="partName">'+part.partName+strVendor+'<div class="articul">'+part.articul+'</div></div><div class="partCount">'+part.count+' шт.</div><div class="partPrice">'+strPartPrice+'</div><div class="partTotalPrice">'+strTotalPartPrice+'</div></div>');
                                nSet.append(nPart);
                            }
                        }

                        nSetsOfParts.append(nSet);
                    }
                }


                var nWorkRow = $('<div class="work"><div class="row flex" id="row_work_'+wd.id_work+'"><div class="num">'+t.countWorks+'.</div>' +
                    '<div class="workCheck"><input id="check_work_'+wd.id_work+'" data-workid="'+wd.id_work+'" type="checkbox" name="rec[]" checked="checked" value="'+wd.id_work+'" /></div>' +
                    '<div class="workName"><label for="check_work_'+wd.id_work+'">'+strName+'</label></div>' +
                    '<div class="workPrice" data-price="'+price+'">'+strPrice+'</div>' +
                    '<div class="partsPrice" data-partsprice="'+minPartsPrice+'">'+strPartsPrice+'</div>' +
                    '<div class="selectParts">'+strSelectParts+'</div>' +
                    '</div></div>');

                t.n.recommended.slide.append(nWorkRow);
                if(nSetsOfParts!==false) {
                    nWorkRow.append(nSetsOfParts);
                }

            }
        }

        // add event parts toggle
        $('.listWorks .work .selectParts input').click(function(){

            var checked=$(this).is(':checked');
            var workId=parseInt($(this).data('workid'));

            if(checked === true) {
                t.showParts(workId);
            } else {
                t.hideParts(workId);
            }

        });

        $('.listWorks .work .workCheck input').click(function(){

            var checked=$(this).is(':checked');
            var workId=parseInt($(this).data('workid'));

            console.log($('#setsOfParts_'+workId).length);

            if(checked === true) {
                $('#setsOfParts_'+workId+' input').attr('disabled',false);
                t.showParts(workId);
            } else {
                // disabled inputs in sets
                $('#setsOfParts_'+workId+' input').attr('disabled','disabled');
                t.hideParts(workId);
            }

            t.recalc();
        });

        $('.listWorks .work .setsOfParts .select input').click(function(){
            var selectedPartsPrice=parseInt($(this).data('partsprice'));
            var workId=parseInt($(this).data('workid'));
            console.log(partsPrice+' '+workId);
            var row=$('#row_work_'+workId);
            row.find('.partsPrice').html(selectedPartsPrice.formatMoney(false)+' <span class="ruble">p</span>').data('partsprice',selectedPartsPrice);
            t.recalc();
        });


        // reinit slide toggle events
        t.n.worksDest.find('.toggle .btn input[type=checkbox]').click(function(){

            var nSubtopic=$(this).parent().parent().parent();
            var nName=nSubtopic.find('.name');

            nSubtopic.toggleClass('active');

            var slideId=$(this).val();
            var nSlide=$('#'+slideId);

            nSlide.slideToggle('fast');

        });
    },

    recalc: function() {
        var t=this;
        console.log('recalc');
        var total={mandatory:0,recommended:0,mandatoryParts:0,recommendedParts:0};

        t.n.mandatory.table.find('.work>.row').each(function(){
            var check=$(this).find('.workCheck input').is(':checked');
            if(check === true) {
                total.mandatory+=$(this).find('.workPrice').data('price');
                total.mandatoryParts+=$(this).find('.partsPrice').data('partsprice');
            }
        });
        t.n.recommended.table.find('.work>.row').each(function(){
            var check=$(this).find('.workCheck input').is(':checked');
            if(check === true) {
                total.recommended+=$(this).find('.workPrice').data('price');
                total.recommendedParts+=$(this).find('.partsPrice').data('partsprice');
            }
        });

        $('#subtopic_mandatory_works .workPrice .val').html(total.mandatory.formatMoney(false));
        $('#subtopic_mandatory_works .partsPrice .val').html(total.mandatoryParts.formatMoney(false));
        var sumMandatory=total.mandatory+total.mandatoryParts;
        $('#subtopic_mandatory_works .resultPrice .val').html(sumMandatory.formatMoney(false));

        $('#subtopic_recommended_works .workPrice .val').html(total.recommended.formatMoney(false));
        $('#subtopic_recommended_works .partsPrice .val').html(total.recommendedParts.formatMoney(false));
        var sumRecommended=total.recommended+total.recommendedParts;
        $('#subtopic_recommended_works .resultPrice .val').html(sumRecommended.formatMoney(false));

        $('.serviceResults .secondCol .totalPrice').html((sumMandatory+sumRecommended).formatMoney(false));

        console.log('mandatory = '+total.mandatory+' mandatoryParts = '+total.mandatoryParts+' recommended = '+total.recommended+' recommendedParts = '+total.recommendedParts);
    },

    showParts: function(workId) {
        var slideSets=$('#setsOfParts_'+workId);
        if(slideSets.length) {
            console.log('show parts');
            var inputPartsSlide=$('#slide_parts_'+workId);
            inputPartsSlide.attr('checked','checked');
            slideSets.slideDown('fast');
        }
    },

    hideParts: function(workId) {
        var slideSets=$('#setsOfParts_'+workId);
        if(slideSets.length) {
            console.log('hide parts');
            var inputPartsSlide=$('#slide_parts_'+workId);
            inputPartsSlide.attr('checked',false);
            slideSets.slideUp('fast');
        }
    },

    init: function() {

        var t=this;

        t.n.calc = $('#'+t.idCalc);
        t.n.worksDest = $('#'+t.idWorks);
        t.n.sendBtn = $('#'+t.idSendBtn);

        // interface values
        t.n.modelSwitch = t.n.calc.find('#modelSwitch');
        t.n.generationSwitch = t.n.calc.find('#generationSwitch');
        t.n.motorSwitch = t.n.calc.find('#motorSwitch');
        t.n.inputRange = t.n.calc.find('#inputHiddenRange');

        t.d.range = t.n.inputRange.val();
        // showing nodes
        t.n.modelName = t.n.calc.find('#modelName');
        t.n.generationName = t.n.calc.find('#generationName');
        t.n.motorName = t.n.calc.find('#motorName');
        t.n.rangeValue = t.n.calc.find('#selectedRange');

        t.n.carImage = t.n.calc.find('#volvoCarImage');

        // service results
        t.n.results.parent = $('.serviceResults');
        t.n.results.txt = t.n.results.parent.find('.secondCol');
        t.n.results.totalPrice = t.n.results.parent.find('.totalPrice');

        t.n.modal.parent = $('.modal.serviceModal');

        // bind events
        t.n.modelSwitch.change(function(){ t.modelSwitch() });
        t.n.generationSwitch.change(function(){ t.genSwitch() });
        t.n.motorSwitch.change(function(){ t.calc() });

        t.n.sendBtn.click(function() { t.showForm() });

        console.log("Range: "+t.d.range);

        // init slider
        $('#slider').slider({
            animate: "fast",
            min: 1,
            max: 12,
            step: 1,
            value: t.d.range, // initial values
            range: "min",
            change: function(e, ui) {
                t.d.range=parseInt(ui.value);
                t.calc();
            }
        });

        t.calc();

    },

    showForm: function() {
        $('.backdrop').toggleClass('show',true);

        $('.modal.serviceModal').toggleClass('show',true);
        $('.modal.serviceModal').find('input[name="type"]').val('srv');

        // set focus
        setTimeout(function(){ $('.modal.serviceModal').find('input[name="email"]').focus() }, 100);
    }

};
