<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Poppins">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
		  position: absolute;
		  top: 100px;
		  left: 25%;
		  z-index: 5;
		  background-color: #fff;
		  padding: 5px;
		  border: 1px solid #999;
		  text-align: center;
		  font-family: 'Roboto','sans-serif';
		  line-height: 30px;
		  padding-left: 10px;
		}
		
		.floating-menu {
			font-family: Poppins;
			color : white;
			background: teal;
			padding: 5px;;
			width: 200px;
			z-index: 100;
			position: fixed;
			top: 30px;
			right: 30px;
		}
		
    </style>
  </head>

  <body>
	
	<nav class="floating-menu">
	<h3 align="center">Keterangan</h3>
	<p align="center">S : daerah dengan masalah kebersihan</p>
	<p align="center">L : daerah dengan masalah kelistrikan</p>
	
		<div align="center">
			<button class="w3-btn w3-hover-sand" onclick="location.href='index.php'">Back to home</button>
		</div>
	</nav>
	
    <div id="map"></div>

    <script>
	  
      var customLabel = {
        Kebersihan: {
          label: 'S'
        },
        Kelistrikan: {
          label: 'L'
        }
      };

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(-6.89148, 107.61065),
          zoom: 17
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('parsetoXML.php', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            
            Array.prototype.forEach.call(markers, function(markerElem) {
              var nama = markerElem.getAttribute('nama');
              var tipe = markerElem.getAttribute('tipe');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = nama
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = tipe
              infowincontent.appendChild(text);
              
              var icon = customLabel[tipe] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
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
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAosMsDbWq7fmxmMmHEAh4esEBITjC6VCo&callback=initMap">
    </script>
  </body>
</html>
