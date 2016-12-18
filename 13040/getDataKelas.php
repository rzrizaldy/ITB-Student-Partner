<?php
	include 'database.php';
	
	$sql = "SELECT * FROM jadwal_kelas";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
		$json = array();
	    while($row = $result->fetch_assoc()) {
			$temp = array("Nomer" => $row["Nomer"], "JamAwal" => $row["JamAwal"], "JamAkhir" => $row["JamAkhir"]);
			array_push($json, $temp);
	    }
	} else {
	    $json = array("status" => 0, "msg" => "Data is empty.");
	}
	$conn->close();
	/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);
?>