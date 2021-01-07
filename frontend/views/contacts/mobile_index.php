<section class="content">
        <div class="dirs">
            <noindex><a href="<?= yii\helpers\Url::home(); ?>">Главная</a></noindex>
            <svg class="i arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#keyboard-down"></use></svg><a href="<?= yii\helpers\Url::to('contacts')?>">Контактные данные</a>
</div>
        <h1><?=$model->title; ?></h1>
       <?=$model->body; ?>
    
<script src="https://maps.googleapis.com/maps/api/js?language=ru&amp;key=AIzaSyAGZQBObycEsoKkt05vT_FdoEg_wF4cnjg"></script>
<script>

    $(document).ready(function(){
        initMaps();
    });

    function initMaps() {
        var styles = [
            {
                "stylers": [
                    {
                        "saturation": -100
                    },
                    {
                        "gamma": 1
                    }
                ]
            },
            {
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.business",
                "elementType": "labels.text",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.business",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.place_of_worship",
                "elementType": "labels.text",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.place_of_worship",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "geometry",
                "stylers": [
                    {
                        "visibility": "simplified"
                    }
                ]
            },
            {
                "featureType": "water",
                "stylers": [
                    {
                        "visibility": "on"
                    },
                    {
                        "saturation": 50
                    },
                    {
                        "gamma": 0
                    },
                    {
                        "hue": "#50a5d1"
                    }
                ]
            },
            {
                "featureType": "administrative.neighborhood",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#333333"
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "labels.text",
                "stylers": [
                    {
                        "weight": 0.5
                    },
                    {
                        "color": "#333333"
                    }
                ]
            },
            {
                "featureType": "transit.station",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "gamma": 1
                    },
                    {
                        "saturation": 50
                    }
                ]
            }
        ];

        console.log('init');

        var center_salova = {
            lat: 59.886224, lng: 30.367382
        };

        var center_ekater = {
            lat: 59.978611, lng: 30.431950
        };

        var salova = {
            lat: 59.886120, lng: 30.376824
        };
        var ekater = {
            lat: 59.978891, lng: 30.441819
        };

        var mapSalova = new google.maps.Map(
            document.getElementById('servicesMapSalova'),
            {
                zoom: 15,
                center: center_salova,
                disableDefaultUI: true,
                zoomControl: true,
                scrollwheel: false,
                styles: styles
            }
        );


        var mapEkater = new google.maps.Map(
            document.getElementById('servicesMapEkater'),
            {
                zoom: 15,
                center: center_ekater,
                disableDefaultUI: true,
                zoomControl: true,
                scrollwheel: false,
                styles: styles
            }
        );

        var salovaInfo = '<div id="content1" class="mapInfo">'+
                '<h2>Сервис на Салова 67</h2>'+
                '<div id="bodyContent">'+
                '<div class="schedule"><svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#timer"></use></svg> с 9:00 до 21:00, без выходных</div>'+
                '<div class="phones">' +
                '<div class="row"><div class="span5">мастер:</div><div class="span7"><strong>(812) 972-30-74</strong></div></div>'+
                '<div class="row"><div class="span5">запчасти:</div><div class="span7"><strong>(812) 406-81-97</strong></div></div>'+
                '<div class="row"><div class="span5">факс:</div><div class="span7"><strong>(812) 406-81-98</strong></div></div>'+
                '</div>'+
                '</div>';

        var ekaterInfo = '<div id="content2" class="mapInfo">'+
                '<h2>Сервис на Екатерининском пр. 5А</h2>'+
                '<div id="bodyContent">'+
                '<div class="schedule"><svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#timer"></use></svg> с 9:00 до 21:00, без выходных</div>'+
                '<div class="phones">' +
                '<div class="row"><div class="span5">мастер:</div><div class="span7"><strong>(812) 974-53-06</strong></div></div>'+
                '<div class="row"><div class="span5">запчасти:</div><div class="span7"><strong>(901) 305-50-56</strong></div></div>'+
                '<div class="row"><div class="span5">факс:</div><div class="span7"><strong>(812) 226-06-22</strong></div></div>'+
                '</div>'+
                '</div>';


        var salovaWindow = new google.maps.InfoWindow({
            content: salovaInfo
        });

        var ekaterWindow = new google.maps.InfoWindow({
            content: ekaterInfo
        });

        var markerSalova1 = new google.maps.Marker({
            position: salova,
            map: mapSalova
        });

        var markerEkater1 = new google.maps.Marker({
            position: ekater,
            map: mapSalova
        });

        var markerSalova2 = new google.maps.Marker({
            position: salova,
            map: mapEkater
        });

        var markerEkater2 = new google.maps.Marker({
            position: ekater,
            map: mapEkater
        });

        markerSalova1.addListener('click', function() {
            salovaWindow.open(mapSalova, markerSalova1);
        });

        markerEkater1.addListener('click', function() {
            ekaterWindow.open(mapSalova, markerEkater1);
        });


        markerSalova2.addListener('click', function() {
            salovaWindow.open(mapEkater, markerSalova2);
        });

        markerEkater2.addListener('click', function() {
            ekaterWindow.open(mapEkater, markerEkater2);
        });


    }
</script>
	</section>