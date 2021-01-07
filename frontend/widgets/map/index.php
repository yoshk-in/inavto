<div class="map" id="servicesMap">
	<script>
		function initMap() {

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

			var center = {
				lat: 59.940781, lng: 30.380897
			};

			var salova = {
				lat: 59.886120, lng: 30.376824
			};
			var ekater = {
				lat: 59.978891, lng: 30.441819
			};

			var map = new google.maps.Map(document.getElementById('servicesMap'), {
				zoom: 11,
				center: center,
				disableDefaultUI: true,
				zoomControl: true,
				scrollwheel: false,
				styles: styles
			});

			var salovaInfo = '<div id="content" class="mapInfo">'+
					'<h2>Ремонт Volvo на Салова 68</h2>'+
					'<div id="bodyContent">'+
					'<div class="schedule"><svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#timer"></use></svg> с 9:00 до 21:00, без выходных</div>'+
					'<div class="phones">' +
					'<div class="row"><div class="span5">мастер:</div><div class="span7"><strong>(812) 972-30-74</strong></div></div>'+
					'<div class="row"><div class="span5">запчасти:</div><div class="span7"><strong>(812) 406-81-97</strong></div></div>'+
					'<div class="row"><div class="span5">факс:</div><div class="span7"><strong>(812) 406-81-98</strong></div></div>'+
					'</div>'+
					'</div>';

			var ekaterInfo = '<div id="content" class="mapInfo">'+
					'<h2>Ремонт Volvo на Екатерининском пр. 5А</h2>'+
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

			var markerSalova = new google.maps.Marker({
				position: salova,
				map: map
			});

			var markerEkater = new google.maps.Marker({
				position: ekater,
				map: map
			});

			markerSalova.addListener('click', function() {
				salovaWindow.open(map, markerSalova);
			});

			markerEkater.addListener('click', function() {
				ekaterWindow.open(map, markerEkater);
			});



		}
	</script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGZQBObycEsoKkt05vT_FdoEg_wF4cnjg&callback=initMap">
	</script>
</div>