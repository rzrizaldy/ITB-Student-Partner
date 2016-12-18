<?php

/* Konfigurasi koneksi database */
$server = "sql6.freemysqlhosting.net";
$username = "sql6148415";
$password = "pbXvU5HmvB";
$dbname = "sql6148415";

//Open connection
$conn = mysqli_connect($server, $username, $password, $dbname);

//Check connection
if (!$conn){
	die("Connection failed: ".mysqli_connect_error());
}

?>