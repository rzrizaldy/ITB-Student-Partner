<!--Muhammad Nur Alif
	18214007 -->

<?php
	$link = mysqli_connect("sql6.freemysqlhosting.net", "sql6148489", "FTW5n8hliP", "sql6148489");

	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
		
	$nama = mysqli_real_escape_string($link, $_POST['nama']);
	$alamat = mysqli_real_escape_string($link, $_POST['alamat']);
	$latitude = mysqli_real_escape_string($link, $_POST['latitude']);
	$longitude = mysqli_real_escape_string($link, $_POST['longitude']);
 
//Membuat Query Insert ke Database
	$sql = "INSERT INTO fotocopy (nama, alamat, latitude, longitude) VALUES ('$nama', '$alamat', '$latitude', '$longitude')";

	if(mysqli_query($link, $sql)){
		echo "Records added successfully.";
	} else{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	}
?>

<html>
	<form>
<!--Tombol untuk kembali ke menu utama-->
	<input type="button" value="Kembali ke menu utama" onclick="window.location.href='main.php'" />
	</form>
</html>