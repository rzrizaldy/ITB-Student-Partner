<!DOCTYPE html>
<?php

		$servername = "sql6.freemysqlhosting.net";
        $username = "sql6148407";
        $password = "pXQ8MQQvBu";
        $db_name = "sql6148407";

        $connect = mysqli_connect($servername, $username, $password, $db_name);


	$sql = "select nama FROM list order by nama";
	$result = mysqli_query($connect, $sql);
	

	
	
?>


<html>
<head>
        <link href="./css/mainstyle.css" rel="stylesheet">
</head>
<body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script>
				var map;
				var map_marker;
				var lat = null;
				var lng = null;
				var lineCoordinatesArray = [];

				// sets your location as default
				if (navigator.geolocation) {
				  navigator.geolocation.getCurrentPosition(function(position) { 
					var locationMarker = null;
					if (locationMarker){
					  // return if there is a locationMarker bug
					  return;
					}
					
					lat = position.coords.latitude;
					lng = position.coords.longitude;
					document.getElementById("lat").value = lat;
					document.getElementById("lng").value = lng;
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
				}
		</script>
		<div class="wrapper-utama">
		<div class="container-utama">
<h1> Pilih Agama Anda</h1>
<form action="maps.php" method="post">
	<select name = 'agama'>
		<option value="islam">Islam</option>
		<option value="kristen">Kristen</option>
		<option value="katolik">Katolik</option>
		<option value="hindu">Hindu</option>
		<option value="buddha">Buddha</option>
	</select> 
    <input type="submit" value="Find Nearest Place">
</form> 

<form method="post" action="process.php">
	<label>Nama Tempat Ibadah</label>
		<input type="text" name="name" />
		<br />
	<label>Agama Anda</label>
		<select name = 'religion'>
		<option value="islam">Islam</option>
		<option value="kristen">Kristen</option>
		<option value="katolik">Katolik</option>
		<option value="hindu">Hindu</option>
		<option value="buddha">Buddha</option>
	</select> 
		<br />
	<input type="hidden" name="lat" id="lat"></input>
	<input type="hidden" name="lng" id="lng"></input>

<br />
<input type="submit" value="Add Your Place">
</form>
</div>
</div>
 

</body>
</html>	
