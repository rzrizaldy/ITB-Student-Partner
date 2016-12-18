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
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <meta charset="utf-8">
		<title>Form tempat FotoCopy</title>
		<meta name="description" content="">
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<script src="http://cdn.pubnub.com/pubnub-3.7.1.min.js"></script>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <style>
		  html, body, #map-canvas {
			height: 470px;
			width: 1520px;
			margin: 0px;
			padding: 0px
		  }
		</style>
		
<!--Menggunakan google maps API dengan key-->
		<script async defer src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAUOLSZjFOokT9DSZD7BMmCNaHkm6MScyE"
		type="text/javascript"></script>
    </head>

	<body>
<h1>Isi tempat FotoCopy baru!</h1>
	
<!--Pembuatan Form Tempat FotoCopy Baru-->
<form action="insert.php" method="post">
    <p>
        <label for="nama">Nama:</label>
        <input type="varchar" name="nama" id="nama">
    </p>
    <p>
        <label for="alamat">Alamat:</label>
        <input type="varchar" name="alamat" id="alamat">
    </p>
    <p>
        <label for="latitude">Latittude:</label>
        <input type="double" name="latitude" id="latitude">
    </p>
	<p>
        <label for="longitude">Longitude:</label>
        <input type="double" name="longitude" id="longitude">
    </p>
    <input type="submit" value="Submit">
</form>
	</body>
</html>