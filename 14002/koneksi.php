<?php

	$servername = "sql6.freemysqlhosting.net";
	$username = "sql6148414";
	$password = "JVZsZGZDqF";
	$dbname = "sql6148414";
	
	//UPDATE
	$servername = "sql6.freemysqlhosting.net";
	$username = "sql6149851";
	$password = "eVFKBMIua7";
	$dbname = "sql6149851";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

?>