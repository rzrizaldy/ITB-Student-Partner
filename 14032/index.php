<!DOCTYPE html>	
	
<?php
	error_reporting(0);
	function bacaHTML($url){
		// inisialisasi CURL
		$data = curl_init();
		// setting CURL
		curl_setopt($data, CURLOPT_URL, $url);
		curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
		// menjalankan CURL untuk membaca isi file
		$hasil = curl_exec($data);
		curl_close($data);
		return $hasil;
		}
		
	$lat = -6.891310;
	$lng = 107.610874;
	$lat2 = -6.9147444;
	$lng2 = 107.6098111;
	
	if(isset($_POST['kirim']))
	{
		$asal = $_POST['asal'];
		$destination = $_POST['apayo'];
		
		//curling URL asal
		$url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($asal);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = json_decode(curl_exec($ch), true);
		curl_close($ch);
		
		//If google responds with a status of OK
		//Store latitude and longitude into variables
		if($response['status'] == "OK"){
		  $lat = $response['results'][0]['geometry']['location']['lat'];
		  $lng = $response['results'][0]['geometry']['location']['lng'];
		}
		
		//curling URL tujuan
		$url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($destination);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = json_decode(curl_exec($ch), true);
		curl_close($ch);
		
		//If google responds with a status of OK
		//Store latitude and longitude into variables
		if($response['status'] == "OK"){
		  $lat2 = $response['results'][0]['geometry']['location']['lat'];
		  $lng2 = $response['results'][0]['geometry']['location']['lng'];
		}
		
		//hitung jarak dan tarif
		$data = file_get_contents('http://maps.googleapis.com/maps/api/distancematrix/json?origins='.$lat.','.$lng.'&destinations='.$lat2.','.$lng2.'&language=id-ID&sensor=false');
		$data = json_decode($data);

		$time = 0;
		$distance = 0;

		foreach($data->rows[0]->elements as $road) {
			$time += $road->duration->value;
			$distance += $road->distance->value;
		}
		
		//meng-cut alamat yang dimasukkan sehingga didapat hanya nama jalan
		$angkotAsal = substr($asal,4);
		$angkotTujuan = substr($destination,4);
		
		//crawling data angkot dan rutenya
		$kodeHTML =  bacaHTML('http://www.bandungview.info/p/rute-angkot.html');
		$pecah = explode('<td>', $kodeHTML);
		$n=1;
		$pecahLagi = array();
		while ($n <= count($pecah)){
			$val = explode('</td>', $pecah[$n]);
			array_push($pecahLagi, $val[0]);
			$n++;
		}

		$searchword = $angkotAsal;
		$search2 = $angkotTujuan;
		foreach($pecahLagi as $k=>$v) {
		if((preg_match("/\b$searchword\b/i", $v))and(preg_match("/\b$search2\b/i", $v))) {
			$matches[$k] = $v;
			$m=0;
			while ($m <= count($pecahLagi)){
				if ($pecahLagi[$m] === $v){
					break;
				}else{
					$m++;
				}
			} 
			break;
		}
		}
		

		
	}
?>
<html>
<head>
        <link href="./css/mainstyle.css" rel="stylesheet">
</head>
<body>
<!-- Tampilan -->
<div class="wrapper-utama">
<div class="container-utama">
	<h1 align = "left" style = "background-color : maroon; font-size:150%; color:white;">Mencari Angkot dan Menghitung Tarif</h1>

	<div style="float:left" id="map"></div>
	
	<p>
		<strong>CATATAN</strong>
		<?php echo "<br>"; ?>
		&nbsp;&nbsp;&nbsp;1. Asal dan Tujuan diisi dengan nama jalan tanpa nomor dan embel-embel lainnya, dengan format: Jl. (nama jalan). Contoh: Jl. Tubagus Ismail&nbsp;&nbsp;&nbsp;
		<?php echo "<br>"; ?>
		&nbsp;&nbsp;&nbsp;2. Nama jalan yang dimasukkan adalah jalan yang dilewati angkot. Apabila </br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;nama angkot tidak muncul di hasil adalah karena nama jalan tersebut tidak &nbsp;&nbsp;&nbsp;&nbsp;dilewati angkot (tidak ada di dalam website yang memuat rute angkot)
	</p>
	
	<form style="color:#fff" method="post">
		&nbsp;&nbsp;&nbsp;Asal : <input placeholder = "Isi Asal" name="asal" type="text" id="asal"/> <br><br>
		&nbsp;&nbsp;&nbsp;Tujuan : <input placeholder = "Isi Tujuan" name="apayo" type="text" id="tujuan"/> <br>
		<p>&nbsp;&nbsp;&nbsp;<button class="button" type="submit" name="kirim" style="padding:5px; width:100px">Cari</button></p>
	</form>		
	
	
	
	<p><strong>HASIL</strong></p>
	<p>
	<?php
		echo "&nbsp;&nbsp;&nbsp;Asal: ".$data->origin_addresses[0];
		echo "<br><br>";
		echo "&nbsp;&nbsp;&nbsp;Tujuan: ".$data->destination_addresses[0];
		echo "<br><br>";
		echo "&nbsp;&nbsp;&nbsp;Jarak: ".$distance." m atau +- " .ceil($distance / 1000). " km";
		echo "<br><br>";
		$harga = (ceil($distance/1000))*1000;
		echo "&nbsp;&nbsp;&nbsp;Tarif: Rp".$harga. " (Rp1.000/km)";
		echo "<br><br>";
		echo "&nbsp;&nbsp;&nbsp;Angkot: ".$pecahLagi[$m-1];
	?>
	</p>
	</div>
	</div>
	
</body>


	<style>
      #map {
        width: 50%;
        height: 450px;
        background-color: grey;
      }
    </style>
    <body>
    <script>
      function initMap() {
		
		var bounds = new google.maps.LatLngBounds();
        var uluru = {lat: <?php echo $lat; ?>, lng: <?php echo $lng; ?>};
        
        var asal = {
			info: '<strong><?php echo $data->origin_addresses[0]; ?>',
			lat: <?php echo $lat; ?>,
			lng: <?php echo $lng; ?>
			};

		var tujuan = {
			info: '<strong><?php echo $data->destination_addresses[0]; ?>',
			lat: <?php echo $lat2; ?>,
			lng: <?php echo $lng2; ?>
		};
        
        var locations = [
		  [asal.info, asal.lat, asal.lng, 0],
		  [tujuan.info, tujuan.lat, tujuan.lng, 1],
		];
        
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: uluru,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        
        var infowindow = new google.maps.InfoWindow({});

		var marker, i;

		for (i = 0; i < locations.length; i++) {
			var position = new google.maps.LatLng(locations[i][1], locations[i][2]);
			bounds.extend(position);
			marker = new google.maps.Marker({
				position: position,
				map: map
			});

			google.maps.event.addListener(marker, 'click', (function (marker, i) {
				return function () {
					infowindow.setContent(locations[i][0]);
					infowindow.open(map, marker);
				}
			})(marker, i));
			map.fitBounds(bounds);
		}
		
      }     
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrQ4y9jeX-160C9xC_KTywk1kTDYgd3ZA&callback=initMap">
    </script>
    
 
  </body>
      
</html>
