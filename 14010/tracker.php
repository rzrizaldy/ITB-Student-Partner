<!DOCTYPE html>
<?php

	

        include 'connectdb.php';
		connectDB();

        // Get data from the dropdown
        $nama=isset($_GET['Nama'])?$_GET['Nama']:"";
        
        $sql = "select * from user where Nama = '$nama'";
		$res = mysqli_query($connect, $sql);
		$namajurusan = array("182" => "STI", "132" => "Elektro", "180" => "Power", "181" => "Telekomunikasi", "135" => "IF");  
		while ($row = $res -> fetch_assoc()) {
			$nama = $row['Nama'];
			$jurusan = $namajurusan[substr($row['NIM'], 0,3)];
			$latitude = $row['Lattitude'];
			$longitude = $row['Longitude'];
			$waktu = $row['Waktu'];
			$date = $row['Tanggal'];
			$nim = $row['NIM'];
 		}
?>
<!-- END OF QUERY -->

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta charset="utf-8">
		<title>Location Tracker</title>
		<meta name="description" content="">
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<script src="http://cdn.pubnub.com/pubnub-3.7.1.min.js"></script>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <style>
		  html, body, #map-canvas {
			height: 700px;
			margin: 0px;
			padding: 0px
		  }
		</style>
		
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUOLSZjFOokT9DSZD7BMmCNaHkm6MScyE&callback=initMap"
		type="text/javascript"></script>
    </head>
    <body>
        
        <h1 div align="center">Lokasi Teman Anda</div></h1>
        
        <div align="center">
		<p>Nama : <?php echo $nama; ?> </p>
        <p>NIM : <?php echo $nim; ?> </p>
        <p>Jurusan : <?php echo $jurusan; ?> </p>
        <p>Latitude : <?php echo $latitude; ?> </p>
        <p>Longitude : <?php echo $longitude; ?> </p>
        <p>Tanggal Terakhir : <?php echo $date; ?> </p>
        <p>Waktu Terakhir : <?php echo $waktu; ?> </p>
        <p>Posisi terakhir : </p>
        </div>
		<div id="map-canvas"></div>
		
    <!-- Map Configuration and data -->
    <script>
    var map;
    var map_marker;
    var lat = null;
    var lng = null;
    var lineCoordinatesArray = [];

    // sets your location as default
      navigator.geolocation.getCurrentPosition(function() { 
        var locationMarker = null;
        if (locationMarker){
          // return if there is a locationMarker bug
          return;
        }

        lat = <?php echo $latitude; ?>;
        lng = <?php echo $longitude; ?>;

        // calls PubNub
        pubs();

        // initialize google maps
        google.maps.event.addDomListener(window, 'load', initialize());
      },
      function(error) {
        console.log("Error: ", error);
      },
      {
        enableHighAccuracy: true
      }
      );


    function initialize() {
      console.log("Google Maps Initialized")
      map = new google.maps.Map(document.getElementById('map-canvas'), {
        zoom: 15,
        center: {lat: lat, lng : lng, alt: 0}
      });

      map_marker = new google.maps.Marker({position: {lat: lat, lng: lng}, map: map});
      map_marker.setMap(map);
    }

    // moves the marker and center of map
    function redraw() {
      map.setCenter({lat: lat, lng : lng, alt: 0})
      map_marker.setPosition({lat: lat, lng : lng, alt: 0});
      pushCoordToArray(lat, lng);

      var lineCoordinatesPath = new google.maps.Polyline({
        path: lineCoordinatesArray,
        geodesic: true,
        strokeColor: '#2E10FF',
        strokeOpacity: 1.0,
        strokeWeight: 2
      });
      
      lineCoordinatesPath.setMap(map);
    }


    function pushCoordToArray(latIn, lngIn) {
      lineCoordinatesArray.push(new google.maps.LatLng(latIn, lngIn));
    }
    

    function pubs() {
      pubnub = PUBNUB.init({
        publish_key: 'demo',
        subscribe_key: 'demo'
      })

      pubnub.subscribe({
        channel: "mymaps",
        message: function(message, channel) {
          console.log(message)
          lat = message['lat'];
          lng = message['lng'];
          //custom method
          redraw();
        },
        connect: function() {console.log("PubNub Connected")}
      })
    }

    </script>
		</body>
</html>
