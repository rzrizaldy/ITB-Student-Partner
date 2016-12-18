<?php
	include 'database.php';

	if(isset($_GET['nomer']) && isset($_GET['waktu'])) {
		$sql = "SELECT * FROM `jadwal_kelas` WHERE Nomer=".$_GET['nomer']." AND JamAwal<='".$_GET['waktu']."' AND JamAkhir<='".$_GET['waktu']."'";
		
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
			$json = array();
		    while($row = $result->fetch_assoc()) {
				$temp = array("Nomer" => $row["Nomer"], "JamAwal" => $row["JamAwal"], "JamAkhir" => $row["JamAkhir"]);
				array_push($json, $temp);
		    }
		} else {
		    $json = array("status" => 0, "message" => "Data is empty.");
		}	
	}
	else {
		$json = array("status" => 0, "message" => "The parameters needed are not set. Include nomer dan tanggal as parameters.");
	}

	
	$conn->close();
	/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);
?>