<?php
# FileName="connection.php"
# Type="MYSQL"
# HTTP="true"
$hostname = "167.205.67.249";
$database= "db18214055";
$username= "18214055";
$password= "anm55lk";
$conn = mysqli_connect($hostname, $username, $password, $database) or trigger_error(mysqli_error(),E_USER_ERROR);
mysqli_select_db($conn, $database);
?>
