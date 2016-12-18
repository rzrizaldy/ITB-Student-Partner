<?php

    include 'koneksi.php';
	if(isset($_GET['ID_Barang'])) {
		$sql = "SELECT Gambar FROM barang where ID_Barang=" . $_GET['ID_Barang'];
		$result = mysqli_query($conn,"$sql") or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($conn));
		$row = mysqli_fetch_array($result);
		//header("Content-type: " . $row["imageType"]);
			echo $row["Gambar"];
	}
	mysqli_close($conn);
	
?>