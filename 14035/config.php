<?php
	$servername = "sql6.freemysqlhosting.net";
	$username = "sql6149743";
	$password = "b54pnjYYPP";
	$dbname = "sql6149743";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}
?>
