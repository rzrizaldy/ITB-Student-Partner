<?php
	
	$servername = "sql6.freemysqlhosting.net";
	$username = "sql6149467";
	$password  = "SItP7U7xsX";
	$dbname = "sql6149467";

	// create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	//check connection
	if (!$conn){
		exit("connection failed :". mysqli_connect_error());
	}

	function tampil($kalori){
		$servername = "sql6.freemysqlhosting.net";
		$username = "sql6149467";
		$password  = "SItP7U7xsX";
		$dbname = "sql6149467";

		// create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		//check connection
		if (!$conn){
			exit("connection failed :". mysqli_connect_error());
		}
		$sql = "SELECT * FROM Calories where Calories_kcal > '$kalori'";
		$result = mysqli_query($conn,$sql);

		$tabel = array();
		if (mysqli_num_rows($result)>0){
			while ($row = mysqli_fetch_assoc($result)){
				array_push($tabel,$row);
			} 
		} 
		return $tabel;
	}
	if (isset($_GET['perintah'])){
		$perintah = $_GET['perintah'];
		if ($perintah == 'simpan'){
			$origin=$_GET['origin'];
			$destination = $_GET['destination'];
			$distance = $_GET['distance'];
			$exercise = $_GET['exercise'];
			$calories = $_GET['calories']; 
			$hydration = $_GET['hydration'];
			$time = $_GET['time'];
			$compare = $_GET['compare'];

			$query = "INSERT INTO `Calories` (`Tanggal`, `Origin`, `Destination`, `Distance_meter`, `Exercise`, `Calories_kcal`, `Hydration_Letre`, `Time_mins`, `Compare_meter`) VALUES (CURRENT_TIMESTAMP, '$origin', '$destination', '$distance', '$exercise', '$calories', '$hydration', '$time', '$compare')";
			mysqli_query($conn,$query); 
		}
		if ($perintah == 'tampilkan'){
			$kalori = isset($_GET['kalori'])?$_GET['kalori']:0;
			$tabel=tampil($kalori);
			echo json_encode($tabel);
		}
	}
?>
