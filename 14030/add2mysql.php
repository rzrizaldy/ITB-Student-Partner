<?php
	$servername = "sql6.freemysqlhosting.net";
	$username = "sql6148416";
	$password = "1gnryAU1Ik";
	$dbname = "sql6148416";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	if(isset($_POST['ToiletName'])) {
		$ToiletName = $_POST['ToiletName'];
	}

	if(isset($_POST['ToiletDesc'])) {	
		$ToiletDesc = $_POST['ToiletDesc'];
	}

	if(isset($_POST['ToiletLat'])) {
		$ToiletLat = $_POST['ToiletLat'];
	}

	if(isset($_POST['ToiletLng'])){
		$ToiletLng = $_POST['ToiletLng'];
	}	

	if(isset($_POST['UserNIM'])) {
		$UserNIM = $_POST['UserNIM'];
	}

	if(isset($_POST['optionsRadios'])) {

		if($_POST['optionsRadios'] = "1") {
			$Is24hr = 1;
		} else {
			$Is24hr = 0;
		}
	}


	$sql = "INSERT INTO markers (name, address, lat, lng, nimsender, is24hr)
	VALUES ('$ToiletName', '$ToiletDesc', '$ToiletLat', '$ToiletLng', '$UserNIM', '$Is24hr')";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	    header('Location: index.php' );
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
?>