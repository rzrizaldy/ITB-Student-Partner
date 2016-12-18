<?php
		$servername = "sql6.freemysqlhosting.net";
        $username = "sql6148407";
        $password = "pXQ8MQQvBu";
        $db_name = "sql6148407";

        $connect = mysqli_connect($servername, $username, $password, $db_name);
 
	if(mysqli_connect_errno($connect))
	{
		echo 'Failed to connect';
	}
	// create a variable
	$nama=$_POST['name'];
	$agama=$_POST['religion'];
	$lat=$_POST['lat'];
	$lng=$_POST['lng'];
	//Execute the query
 
	mysqli_query($connect, "INSERT INTO list(nama,agama,lat,lng) VALUES('".$nama."','".$agama."','".$lat."','".$lng."')");

	
?>
