<?php

	//require('crawl.php');

	//Define Database
	$servername = "sql6.freemysqlhosting.net";
	$username = "sql6148460";
	$password = "9jjWMaRrxz";
	$dbname = "sql6148460";
	
	/* UPDATE */
	$servername = "sql6.freemysqlhosting.net";
	$username = "sql6149842";
	$password = "mvGgqiqp81";
	$dbname = "sql6149842";

	//Create Connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	//Check Connection
	if (!$conn){
		die("Connection failed: " . mysqli_connect_error());
	}

	$bidang = isset($_GET['bidang'])?$_GET['bidang']:"";
	$perusahaan = isset($_GET['perusahaan'])?$_GET['perusahaan']:"";


	$sql = "SELECT * FROM kerja WHERE bidang like '%$bidang%' AND perusahaan like '%$perusahaan%'";

	$hasil = mysqli_query($conn,$sql);

	$encode = array();
	while($row=mysqli_fetch_array($hasil,1)){
		array_push($encode, $row);
	}	

	echo xmlrpc_encode($encode);

?>