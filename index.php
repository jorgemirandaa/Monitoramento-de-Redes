<!DOCTYPE html >
  <head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="refresh" content="30"/>

		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

		<!--Import personalizado-->
		<link rel="stylesheet" type="text/css" href="css/personalizado.css">
		
		<!-- FAVICON -->
		<link rel="shortcut icon" href="favicon.png" />
		<link rel="icon" href="favicon.png" type="image/x-icon" />

		<title>Monitoramento - Redes</title>
	</head>
	<body>
		<nav>
		    <div class="nav-wrapper light-blue lighten">
		      <a href="index.php" class="brand-logo center"><img class="responsive-img" src="LOGOMARCA.png"></a>
		      <ul id="nav-mobile" class="left hide-on-med-and-down">
		        <li><a href="index.php">Roteadores</a></li>
		        <li><a href="#">Sistemas (Em breve)</a></li>
		        <li><a href="#">Serviços (Em breve)</a></li>
		      </ul>
		    </div>
	  	</nav>
		
		<div id="map"></div>
		
		<div class="fixed-action-btn vertical">
		    <a class="btn btn-floating btn-large pulse blue">
		      <i class="large material-icons">security</i>
		    </a>
		    <ul>
		      <li><a class="btn-floating red"><i class="material-icons">desktop_windows</i></a></li>
		      <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
		      <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
		      <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
		    </ul>
		</div>

		<script type="text/javascript" >
		  var customLabel = {
			router: {
			  label: ''
			}
		  };

		function initMap() {
			var map = new google.maps.Map(document.getElementById('map'), {
				center: new google.maps.LatLng(-13.5501975, -41.5145175),
				zoom: 6
			});
		
			var infoWindow = new google.maps.InfoWindow;

			downloadUrl('mapmarkers.xml', function(data) {
				var xml = data.responseXML;
				var markers = xml.documentElement.getElementsByTagName('marker');
				Array.prototype.forEach.call(markers, function(markerElem) {
					var name = markerElem.getAttribute('name');
					var address = markerElem.getAttribute('address');
					var type = markerElem.getAttribute('type');
					var num_ip_js = markerElem.getAttribute('ip');
					var point = new google.maps.LatLng(
						parseFloat(markerElem.getAttribute('lat')),
						parseFloat(markerElem.getAttribute('lng')));
					var infowincontent = document.createElement('div');
					var strong = document.createElement('strong');
						strong.textContent = name;
						infowincontent.appendChild(strong);
						infowincontent.appendChild(document.createElement('br'));
					var text = document.createElement('text');
						text.textContent = address
						infowincontent.appendChild(text);
					var label = customLabel[type] || {};
					
					var resultado_status = markerElem.getAttribute('status');

					var marker = new google.maps.Marker({
						map: map,
						position: point,
						label: label.label,
						icon: resultado_status
					});
					
					marker.addListener('click', function() {
						infoWindow.setContent(infowincontent);
						infoWindow.open(map, marker);
					});
				});

			});
		}
		
		function downloadUrl(url, callback) {
			var request = window.ActiveXObject ?
				new ActiveXObject('Microsoft.XMLHTTP') :
				new XMLHttpRequest;

				request.onreadystatechange = function() {
					if (request.readyState == 4) {
						request.onreadystatechange = doNothing;
						callback(request, request.status);
					}
				};

			request.open('GET', url, true);
			request.send(null);
		}
		
		function doNothing() {}
			
		</script>

		<!--Import jQuery before materialize.js-->
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="js/materialize.min.js"></script>
		
		<!--Import Google MAPS-->
		<script async defer
			src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=initMap">
		</script>
	</body>
</html>