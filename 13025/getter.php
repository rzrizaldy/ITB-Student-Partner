<?php
	include 'conm.php';

	if(isset($_GET['makul']) && isset($_GET['kegiatan'])) {
		$sql = "SELECT * FROM `db_01` WHERE KodeMakul=".$_GET['makul']." AND Kegiatan=".$_GET['kegiatan']."";
		
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
			$json = array();
		    while($row = $result->fetch_assoc()) {
				$temp = array(
					"ID"=>$row["ID"],
					"KodeMakul"=>$row["KodeMakul"],
					"Kegiatan"=>$row["Kegiatan"],
					"Date"=>$row["Date"],
					"Time"=>$row["Time"]);
				array_push($json, $temp);
		    }
		} else {
		    $json = array("status" => 0, "message" => "Data is empty.");
		}	
	}
	else {
		$json = array("status" => 0, "message" => ".");
	}

	
	$conn->close();
	/* Output header */
	header('Content-type: application/json');
	echo json_encode($json);
?>