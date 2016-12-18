<?php
 
	$mysql_hostname = "sql6.freemysqlhosting.net";
	$mysql_user = "sql6149465";
	$mysql_password = "mfxw1RR28z";
	$mysql_database = "sql6149465";

	$conn = mysqli_connect ($mysql_hostname, $mysql_user, $mysql_password, $mysql_database) or die ("Opps something went wrong ");

   $sql = "INSERT INTO aspirasihimpunan (nama, email, subject, himpunan, aspirasi) VALUES ('{$conn->real_escape_string($_POST['nama'])}','{$conn->real_escape_string($_POST['email'])}','{$conn->real_escape_string($_POST['subject'])}','{$conn->real_escape_string($_POST['himpunan'])}','{$conn->real_escape_string($_POST['aspirasi'])}')";

   if ($conn->query($sql) === TRUE) {
    	header("Location:aspirasi_sent.html");
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();

?>