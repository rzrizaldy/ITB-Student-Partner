<?php
		function connectDB() {
		global $connect;
		$servername = "sql6.freemysqlhosting.net";
        $username = "sql6148398";
        $password = "dAwxdliJ74";
        $db_name = "sql6148398";
        
        $connect = mysqli_connect($servername, $username, $password, $db_name);
        
        if (!$connect) {
            die("Koneksi gagal : " . mysqli_connect_error());
        }
	}
?>
