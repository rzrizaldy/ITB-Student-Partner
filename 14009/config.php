<?php

$servername = "sql6.freemysqlhosting.net";
$username = "sql6148453";
$password = "B4ph3IWKba";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_select_db($conn,"sql6148453");
 ?>
