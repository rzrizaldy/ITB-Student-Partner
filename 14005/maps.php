<!DOCTYPE html>
<html>
  <head>
    <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link href="./css/mainstyle.css" rel="stylesheet">
  </head>
  <body>

		<div class="wrapper-utama">
		<div class="container-utama">
    <h3 style="color:#000">My Google Maps Demo</h3>
    <div id="map"></div>
	<span id="agama">
		<?php
			echo $_POST['agama'];
		?>
	</span>
	<script>
		
		
	</script>
    <script>
		var latlng = 'asd';
	
		$.post('direction.php',
		{
          agama: $.trim($('#agama').html()),
        },
		function(data,status){
			latlng = JSON.parse(data);
			initMap();
        }
		);
	
      function initMap() {
		//alert(latlng);
		//alert(latlng[0].lat);
		var pointer;
		var arrayLength = latlng.length;
		var map = new google.maps.Map(document.getElementById('map'), {
			  zoom: 4,
			  center: {lat: Number(latlng[0].lat), lng: Number(latlng[0].lng)}
			});
		for (var i = 0; i < arrayLength; i++) {
			//alert(latlng[i]);
			//Do something
			pointer = {lat: Number(latlng[i].lat), lng: Number(latlng[i].lng)};
			
			var marker = new google.maps.Marker({
			  position: pointer,
			  map: map
			});
				google.maps.event.addListener(marker, 'click', (function(marker, i) {
			return function() {
			  infowindow.setContent(locations[i][0]);
			  infowindow.open(map, marker);
			}
		  })(marker, i));
		}
      }

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKJvKhQu5_3t1pMWijkYGrxMtLR0pwZQ4">
    </script>
	</div>
	</div>
  </body>
</html>