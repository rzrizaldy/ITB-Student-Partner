<?php	
	
	if (isset($_GET["lat1"]) && isset($_GET["lng1"]) && isset($_GET["lat2"]) && isset($_GET["lng2"])) {
		$info = file_get_contents('http://localhost/script/kalkulasi.php?lat1=' . $_GET["lat1"] . '&lng1=' . $_GET["lng1"] . '&lat2=' . $_GET["lat2"] . '&lng2=' . $_GET["lng2"]);
		$info = json_decode($info,true);
	}
?>

<!DOCTYPE html>
<html lang="en">
	
	<head>
		
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
	<meta charset="utf-8">
	
	<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cosmo/bootstrap.min.css">

	<title>Place to Eat</title>
	<style type="text/css">
	form {
    padding: 20px 0;
    padding-right: 10% !important;
    padding-left: 10% !important;
    position: relative;
    z-index: 2;
    width: 100%;
}

form input {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    outline: 0;
    border: 1px solid rgba(255, 255, 255, 0.4);
    background-color: rgba(255, 255, 255, 1);
    width: 250px;
    border-radius: 3px;
    padding: 10px 15px;
    margin: 0 auto 10px auto;
    display: block;
    text-align: center;
    font-size: 16px;
    color: #000;
    -webkit-transition-duration: 0.25s;
    -moz-transition-duration: 0.25s;
    transition-duration: 0.25s;
    font-weight: 300;
}

form input:hover {
    background-color: rgba(255, 255, 255, 0.4);
}

form > font {
    color:#fff;
}

form input:focus {
    background-color: white;
    width: 300px;
    color: #53e3a6;
}

p {
	color: #fff;
}
	</style>
	</head>
	
	<body onload="load(); getLocation();" style="background: #50a3a2;
    background: -webkit-linear-gradient(bottom left, #091212 0%, #53e3a6 100%);
    background: -moz-linear-gradient(bottom left, #091212 0%, #53e3a6 100%);
    background: linear-gradient(to top right, #091212 0%, #53e3a6 100%);
    font-color: #fff">
	
	<p id="demo"></p>
	
		<!-- Header -->
	<header class="w3-display-container w3-content w3-wide" style="max-width:1600px;min-width:500px" id="home">
	  <img class="w3-image" src="asset/food1.jpg" width="1600" height="800">
	  <div class="w3-display-middle w3-padding-xlarge">
		<h1 class="w3-xxxlarge w3-text-white w3-codespan"><font color="black" align="Center">Place to Eat</font></h1>
		<h2 class="w3-xlarge w3-text-white w3-codespan"><font color="black">Institut Teknologi Bandung</h2>
		<br>
		<br>
	  </div>
	</header>
			
	
	<div class="col-xs-offset-1 container">	
	<h1><font face="" font size="6">Place to Eat in ITB and Calculating Distance & Time<br></h1></font>
	<p align="justify">
	Anda dapat melihat <b>informasi lengkap</b> berupa nama, letak, dan deskripsi dari tempat-tempat makan yang ada di ITB dengan <b>mengklik marker-marker</b> pada google maps di bawah.<br><br>
	Selain itu, anda juga <b>dapat menghitung jarak dan waktu tempuh</b> dari lokasi anda saat ini menuju tempat makan ITB yang ingin dituju. 
	Untuk menghitung jarak dan waktu, dibutuhkan latitude dan longitude dari masing-masing posisi (posisi awal dan posisi tujuan). <br><br>
	Posisi awal <b><i>default</i>-nya adalah lokasi anda sekarang</b> (sudah otomatis muncul dalam bentuk latitude dan longitude pada lokasi 1).<br>
	Posisi tujuan merupakan lokasi yang ingin anda tuju. Untuk mengetahui latitude dan longitude dari lokasi tujuan, 
	anda hanya perlu <b>mengklik marker pada peta</b>, maka <b>otomatis</b> latitude dan longitude tujuan akan muncul pada lokasi 2.
	Setelah kedua lokasi terisi lengkap latitude dan longitude nya, anda tinggal <b>mengklik 'kalkulasi'</b> untuk mengetahui jarak dan waktu tempuh. <br><br>
	Anda juga dapat meng-<i>input</i> latitude dan longitude lokasi 1 dan lokasi 2 sesuai dengan keinginan anda, sehingga anda dapat mengkalkulasi jarak dan waktu
	tempuh dari dan menuju mana saja. Untuk mengetahui latitude dan longitude tempat lain (yang sudah tersedia dalam google maps), anda bisa mengklik
	icon-icon pada peta dan pilih <i>'view on Google Maps'</i>. </p>
	</div>
	
	<div class="col-xs-offset-1 container">
	<h2><font color="black">Peta ITB</font></h2>
	<font color="black" font size="2">Silahkan klik marker untuk melihat informasi lebih lanjut</font>
	</div>
	
	<div>
	<div class="col-xs-offset-1 col-sm-1" id="peta" style="width: 1065px; height: 1300px;"></div>
	</div>
	
	
	<div class="container">
		<Center>
		<form action="index.php">
		<font font size="2"></font><br>Klik 'Kalkulasi' untuk menghitung jarak dan waktu tempuh<br></font>
		<font face="calibri" font size="4"><b><br><u>Lokasi anda saat ini:</u></b><br></font>
		<font face="calibri" font size="2" font color="blue">(Lokasi 1)<br></font>
		<label for="lat1" >Latitude : </label>
		<input type="text" id="mylat" name="lat1"></input>
		<br>
			<label for="lng1" >Longitude : </label>
			<input type="text" id="mylng" name="lng1"></input>
		<br>
		<br>
		<font face="calibri" font size="4"></font><b><u>Lokasi tujuan: </u></b><br></font>
		<font face="calibri" font size="2">(Silahkan klik marker tempat makan yang ingin dituju)<br></font>
		<font face="calibri" font size="2" font color="blue">(Lokasi 2)<br></font>
		<label for="lat2" >Latitude : </label>
		<input type="text" id="lat2" name="lat2"></input>
		<br>
		<label for="lng2" >Longitude : </label>
		<input type="text" id="lng2" name="lng2"></input>
		<br>
		<br>
		<input type="submit" name="submit" value="Kalkulasi!"></input>
		<br>
		<br><br><font face="courier" font size="3" font color="blue"><b><?php if(isset($info[4])) echo "Jarak : " . $info[4] . " Meter<br><br>"; ?></b>
		<br><b><?php if(isset($info[5])) echo "Waktu tempuh dengan jalan kaki : " . $info[5] . " Jam " . $info[6] . " Menit " . $info[7] . " detik <br><br>"; ?></b>
		<br><b><?php if(isset($info[5])) echo "Waktu tempuh dengan kendaraan : " . $info[8] . " Jam " . $info[9] . " Menit " . $info[10] . " detik <br><br>"; ?></b>
		</font>
		<br>
		</form>
		</Center>
	</div>
	</body>
	
			
	<script type="text/javascript">
		var customIcons = {};
	
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
		
		function load() { //untuk load map nya
		  var map = new google.maps.Map(document.getElementById("peta"), {
			center: {lat: -6.89011, lng: 107.6107},//ITB
			zoom: 18,
		  });     
		  
		  var infoWindow = new google.maps.InfoWindow;
		  downloadUrl("api.php", function(data) {
			var xml = data.responseXML;
			var markers = xml.documentElement.getElementsByTagName("marker");
			// Loop & place each marker on the map
			for (var i = 0; i < markers.length; i++) {
			  var nama = markers[i].getAttribute("nama");
			  var letak = markers[i].getAttribute("letak");
			  var deskripsi = markers[i].getAttribute("deskripsi");
			  var type = markers[i].getAttribute("type");
			  var posisi = new google.maps.LatLng(
				  parseFloat(markers[i].getAttribute("lat")),
				  parseFloat(markers[i].getAttribute("lng")));
			  
			  var contentString = 	'<div id="content">'+
									'<div id="siteNotice">'+
									'</div>'+
									'<h1 id="firstHeading" class="firstHeading">' + nama + '</h1>'+
									'<div id="bodyContent">'+
									'<p><b>' + letak + '</b> <br/>' + '<p>' + deskripsi + '</p>'+
									'</div>'+
									'</div>';
		 
			  var icon = customIcons[type] || {};
			  var image = 'asset/markerfix.png';
			  var marker = new google.maps.Marker({
				map: map,
				position: posisi,
				icon: image
			  });
  
			  bindInfoWindow(marker, map, infoWindow, contentString);
			  
			}
		  });		  	  
		}
		
		function toggleBounce() {
			if (marker.getAnimation() !== null) {
			  marker.setAnimation(null);
			} else {
			  marker.setAnimation(google.maps.Animation.BOUNCE);
			}
		  }

		function bindInfoWindow(marker, map, infoWindow, contentString) {
		  google.maps.event.addListener(marker, 'click', function(event) {
			infoWindow.setContent(contentString);
			infoWindow.open(map, marker);
			document.getElementById("lat2").value = this.getPosition().lat();
			document.getElementById("lng2").value = this.getPosition().lng();
						
		  }); 
		 		  
		}
			
	//GEOLOCATION 
	var x = document.getElementById("demo");
	function getLocation() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition);
		} else { 
			x.innerHTML = "Geolocation is not supported by this browser.";
		}
	} 
	
	function showPosition(position) {
		var x = position.coords.latitude;
		var y = position.coords.longitude;
		
		document.getElementById("mylat").value = x;
		document.getElementById("mylng").value = y;
    }
		
	</script>
	
	<script src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyDDpLouJbbd1BcL5swzJLuh96Ejg6dNVJE" type="text/javascript"></script>


</html>
