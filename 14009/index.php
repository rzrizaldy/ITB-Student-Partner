<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Poppins">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">

	<style>
	body,h1,h2,h3,h4 {font-family: "Poppins", Arial, sans-serif}
	h1 {letter-spacing: 6px}
	.w3-row-padding img {margin-bottom: 12px}

	table {
				border-collapse: collapse;
				width: 100%;
			}
	th, td {
				text-align: center;
				padding: 3px;
				font-size: 13px;
			}
	tr:nth-child(even){background-color: #f2f2f2}

	th {
				background-color: #003366;
				color: white;
			}

			.w3-display-container {
				padding-top: 7%;
			}

			.w3-content {
				background-color: #fff;
			}
	</style>

</head>
<body>
	
<!-- Header -->
<header class="w3-display-container w3-content" style="max-width:1500px">
  <img class="w3-image" src="itb.png" alt="Me" width="2003" height="776">

<!-- Navbar (sit on top) -->
<div class="w3-top" style="margin-top:7%">
  <ul class="w3-navbar w3-white w3-wide w3-padding-8 w3-card-2">
    <!-- Right-sided navbar links. Hide them on small screens -->
    <li class="w3-right w3-hide-small">
		<a href="#home" class="w3-left">Home</a>
		<a onclick="location.href='markermap.php'" href="#maps" class="w3-left">Maps</a>
    </li>
	</ul>
</div>


<!-- Page content -->

<!-- Form -->
<br><br>
<div class="w3-container" id="home">
	<div class="w3-card-4" style="width:100%;">
<form method = 'POST' class="w3-container w3-card-4">
  <h3 align="center" class="w3-text-teal"><b>Tulis Komplain Anda!</b></h3>
	<p align="center">Layanan Complaints for ITB memungkinkan civitas akademika ITB untuk melaporkan keluhan-keluhan terkait fasilitas yang ada di kampus Ganesha. 
	Persebaran komplain dapat dilihat pada fitur Maps. Share your complaints for a better ITB!</p>
  <div class="w3-group">
	<label>NIM/NIP/NIDN</label> <input class="w3-input w3-border" type="text" name="nim" value="">
  </div>
  <div class="w3-group">
	  Jenis Komplain <select class="w3-input w3-border" id="jenisk" name ="jenisk">
	  <?php		
				include('config.php');
				
				$result = $conn->query("SELECT jenis FROM jenisKomplain");
			
				while ($row = $result->fetch_assoc()) {
					$jenisk = $row['jenis'];
					echo '<option value="'.$jenisk.'">'.$jenisk.'</option>';
				}				
		?>
	  </select>
  </div>
 <label>Drag pada lokasi!</label>
    		<input type="hidden" name="lat" id="lat" value="0" />
    		<input type="hidden" name="lng" id="lng" value="0" />
		<div id="map-canvas" style="width:100%;height:300px" align="center"></div>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAosMsDbWq7fmxmMmHEAh4esEBITjC6VCo&sensor=false"></script>
		<script type="text/javascript" src="map.js"></script>
  
  <div class="w3-group">
  <label>Lokasi</label> <input class="w3-input w3-border" type="text" name="lokasi" value="" placeholder="Tulis spesifikasi tempat">
  </div>
  
  <div class="w3-group">
  <label>Keterangan</label> <input class="w3-input w3-border" type="text" name="ket" placeholder="Tulis keterangan dari komplain">
  </div>
  
  <div class="w3-group">
  <label>Saran</label> <input class="w3-input w3-border" type="text" name="saran">
  </div>
  
  <button type="submit" name="submit" class="w3-btn-block w3-padding-large w3-teal w3-margin-bottom">Submit</button>
  </p>
</form>
</div>

</div>

<br><br>

<br><br>

<!-- Footer -->
<footer class="w3-container w3-teal w3-padding-16">
  <h3 align="center">Institut Teknologi Bandung</h3>
  <p align="center">All rights reserved.</p>
  <p align="center">© 18214009</p>
  <div style="position:relative;bottom:55px;" class="w3-tooltip w3-right">
    <span class="w3-text w3-theme-light w3-padding">Go To Top</span>    
    <a class="w3-text-white" href="#home"><span class="w3-xlarge">
    <i class="fa fa-chevron-circle-up"></i></span></a>
  </div>
</footer>


<!-- Save into Database -->

<?php
	if (isset($_POST['submit'])) {
			$nim = $_POST['nim'];
			$jenis = $_POST['jenisk'];
			$ket = $_POST['ket'];
			$saran= $_POST['saran'];
			$lokasi=$_POST['lokasi'];
			$getLat=$_POST['lat'];
			$getLng=$_POST['lng'];
			
	if ((empty($_POST['nim'])) OR (empty($_POST['ket'])) OR (empty($_POST['lat'])) 
	OR (empty($_POST['lng'])) OR (empty($_POST['lokasi']))){
				echo "<script type='text/javascript'>alert('Kolom tidak boleh kosong')</script>";
	} else {
		$sql = "INSERT INTO dataKomplain (nim,jenisKomplain,keterangan,lokasi,saran) VALUES ('$nim','$jenis','$ket','$lokasi','$saran')";
		$tambah = mysqli_query($conn, $sql);

		$sql2 = "INSERT INTO markers(nama,tipe,lat,lng) VALUES ('$lokasi','$jenis','$getLat','$getLng')";
		$tambah2 = mysqli_query($conn, $sql2);
		
		if (($tambah) AND ($tambah2)) {
				echo "<script type='text/javascript'>alert('Terima kasih!')</script>";
		} else{
				echo "<script type='text/javascript'>alert('Submit gagal')</script>";
		}
	}
}
	mysqli_close($conn);
?>
</body>
<html>
