<?php

	$dbhost = 'sql6.freemysqlhosting.net';
	$dbuser = 'sql6149310';
	$dbpassword = 'vQLBnzaQb6';
	$dbname = 'sql6149310';
	
	//Membuat koneksi
	$con = mysqli_connect($dbhost,$dbuser,$dbpassword);
	
	//Cek koneksi
	if(!$con){
		echo "Failed to connect to MySQL: " . mysqli_error();
	}
	mysqli_select_db($con, $dbname);
	$query = "SELECT * FROM eventcalendar";
	$result = mysqli_query($con,$query);
	$num = mysqli_num_rows($result);
	mysqli_close($con);
	echo "<b><center>Database Output</center></b>
	<br>
	<br>";
//	$i = 0;
//	while ($i < $num){
//		$title = mysqli_result($result,$i,"title");
//		$detail = mysqli_result($result,$i,"detail");
//		$eventDate = mysqli_result($result,$i,"eventDate");
//		echo "<b>($title) $detail</b><br> $eventDate<br><br>";
//		$i++;
//	}
	
	while ($num = mysqli_fetch_assoc($result)){
		$title = $num['id'];
		$detail = $num['detail'];
		$eventDate = $num['eventDate'];
		echo "<b>($title) $detail</b><br> $eventDate<br><br>";
	}
	
?>
