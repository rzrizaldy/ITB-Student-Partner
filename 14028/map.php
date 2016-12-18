<!DOCTYPE html>
<head>
<meta name="viewport" content="initial-scale=1.0">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="styles.css"></link>
<script src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyBqsdxTz26OMSuEUaJTC5Yf0rWCjiJgg_Q&callback=initMap&sensor=true" async defer type="text/javascript" ></script>


<script type="text/javascript">
	var map;
	//ini fungsi untuk meload map - done
	function initMap(){
		
		var mapOptions = {
		center: {
				lat:-6.889656,
				lng: 107.609449
			},
		zoom : 17,
		};
		map =  new google.maps.Map(document.getElementById('map'), mapOptions);
	

		<?php
		$server = "sql7.freemysqlhosting.net";
		$user = "sql7148438";
		$pass = "pClru3xee4";

		//Membuat koneksi 
		$conn = new mysqli($server,$user,$pass);

		//Pilih database
		mysqli_select_db($conn,"sql7148438");
		$sql = "SELECT * FROM informasi_perpustakaan";
		$hasil = $conn->query($sql);
		echo "var infowindow = new google.maps.InfoWindow();";		
		while($baris=$hasil->fetch_assoc()){
			echo "

			lat = ".$baris['latitude'].";
			lng = ".$baris['longitude'].";
			latlng = new google.maps.LatLng(lat,lng);
			var image = 'http://167.205.67.249:8000/18214028/Progrif/raw/c901d32886848d1f21e66ba9ce5c8d780856d7f8/icon.png';
			

			marker = new google.maps.Marker({
				position: latlng,
				map:map,
				icon :image,
				title: '".$baris['nama']."'
			});
			google.maps.event.addListener(marker, 'click', (function(mm, tt) {
				return function() {
				    infowindow.setContent(tt);
			        infowindow.open(map, mm);

			    }
			})(marker, '".$baris['nama']."'));
			

			
				";

		}
		mysqli_close($conn);
		?>
		getLocation();
		
 	}		

	//Ini fitur geolocation - (kurang ditambahkan infowindows)
	function getLocation(){
		if(navigator.geolocation){
			navigator.geolocation.getCurrentPosition(showPosition);
		} else{
			alert("Browser tidak mendukung HTML5. Silahkan gunakan versi terbaru");
		}
	}

	//Ini fungsi menampilkan posisi saat ini - done
	function showPosition(position){
		var lat = position.coords.latitude;
		var lng = position.coords.longitude;
		map.setCenter(new google.maps.LatLng(lat,lng));
	}

	google.maps.event.addDomListener(window, 'load', initialize);

</script>
</head>

<body>
	<?php
	function showlist(){
	$server = "sql7.freemysqlhosting.net";
	$user = "sql7148438";
	$pass = "pClru3xee4";

	//Membuat koneksi 
	$conn = new mysqli($server,$user,$pass);

	//Pilih database
	mysqli_select_db($conn,"sql7148438");
	$sql = "SELECT * FROM informasi_perpustakaan";
	
	$hasil = $conn->query($sql);
	
	while($baris=$hasil->fetch_assoc()){
		echo "
		<a href='#'>
	<div id = 'container' class='container'>
		".$baris['nama']."
		<img style='float:right;width:30%;height:90%;' src='".$baris['image']."'>
		<br>".$baris['alamat']."<br>".$baris['deskripsi']."

	</div>		
	</a>
	";
	}

	
	
	mysqli_close($conn);
	}

	
	error_reporting(0);
	?>
		
</body>
</html>