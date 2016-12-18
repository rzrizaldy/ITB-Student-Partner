<?php
		function connectDB() {
		global $connect;
		$servername = "sql6.freemysqlhosting.net";
        $username = "sql6149464";
        $password = "yNYVe3JrNl";
        $db_name = "sql6149464";
        
        $connect = mysqli_connect($servername, $username, $password, $db_name);
        
        if (!$connect) {
            die("Koneksi gagal : " . mysqli_connect_error());
        }
	}
?>