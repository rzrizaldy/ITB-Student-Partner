<?php
  define('DB_SERVER', 'localhost');	// 167.205.67.249
    define('DB_USERNAME', 'dxgeneral');		// 18214027
    define('DB_PASSWORD', 'password');			// 27uukji
    define('DB_DATABASE', 'test');//
    $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	
	if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
	else{
		echo "Connected successfully<br>";
	}
?>
