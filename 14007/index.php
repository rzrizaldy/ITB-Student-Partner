<!--Muhammad Nur Alif
	18214007 -->

<?php
//Connect ke Database
	$servername = "sql6.freemysqlhosting.net";
    $username = "sql6148489";
    $password = "FTW5n8hliP";
    $db_name = "sql6148489";

    $connect = mysqli_connect($servername, $username, $password, $db_name);

	if ($connect->connect_error) {
		die("Connection failed: " . $connect->connect_error);
	} 
	

//Membuat Query Database	
	$sql = "select * FROM fotocopy";
	$result = mysqli_query($connect, $sql);

//Membuat Array dari Database	
	$array1 = array();
	$array2 = array();
		
	while ($row =$result-> fetch_assoc()) {
		$array1 []= $row['latitude'];
		$array2 []= $row['longitude'];
	}	
	
//Disconnect
	mysqli_close($connect);
		
?>


<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <meta charset="utf-8">
		<title>Location Tracker</title>
		<meta name="description" content="">
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<script src="http://cdn.pubnub.com/pubnub-3.7.1.min.js"></script>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
		
        <style>
		  html, body, #map-canvas {
			height: 620px;
			margin: 0px;
			padding: 0px
		  }
		</style>
		
<!--Menggunakan google maps API dengan key-->
		<script async defer src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAUOLSZjFOokT9DSZD7BMmCNaHkm6MScyE"
		type="text/javascript">
		</script>
		
    </head>

	<body>
		<h1>Lokasi FotoCopy Sekitar ITB</h1>
		<form>
<!--Tombol untuk pindah page-->
			<input type="button" value="Cari FotoCopy terdekat" onclick="window.location.href='nearest.php'" />
			<input type="button" value="Isi tempat FotoCopy baru" onclick="window.location.href='form.php'" />
		</form>

	
<div id="map-canvas"></div>
    <script type='text/javascript'>
    
//Deklarasi variabel
	var map;
    var map_marker;
    var lat = null;
    var lng = null;
	var latme = null;
    var lngme = null;
    var lineCoordinatesArray = [];

//Pembuatan array dari database-->
	var array1= <?php echo json_encode($array1 ); ?>;
	var array2= <?php echo json_encode($array2 ); ?>;


//Menentukan posisi default
      navigator.geolocation.getCurrentPosition(function(position) { 
        var locationMarker = null;
        if (locationMarker){
          return;
        }
//Deklarasi variable lat dan lng sebagai posisi awal
		lat = position.coords["latitude"];
		lng = position.coords["longitude"];
		
//Memanggil PubNub
        pubs();
//Inisalisasi google maps
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
		map = new google.maps.Map(document.getElementById('map-canvas'),
		{
			zoom: 15,
			center: {lat: lat, lng : lng, alt: 0}
		});
//Marker untuk menunjukkan lokasi sekarang
		map_marker = new google.maps.Marker({position: {lat: lat, lng: lng}, map: map});
//Marker untuk menunjukkan tempat FotoCopy  
		for (i = 0; i < array1.length; i++) {  
			map_marker = new google.maps.Marker({position: {lat: parseFloat(array1[i]), lng: parseFloat(array2[i])}, map: map});
		};
	}
	
//Memindahkan ke tengah peta
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