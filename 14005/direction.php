<?php
        $servername = "sql6.freemysqlhosting.net";
        $username = "sql6148407";
        $password = "pXQ8MQQvBu";
        $db_name = "sql6148407";

        $conn = mysqli_connect($servername, $username, $password, $db_name);

        if (!$conn) {
            die("Koneksi gagal : " . mysqli_connect_error());
        }
        // Get data from the dropdown
        $agama= $_POST['agama'];
        
        $sql = "select * from list where agama = '$agama'";
		$res = mysqli_query($conn, $sql);
		$emparray = [];
		if ($res->num_rows > 0) {
		// output data of each row
		
		while($row = $res->fetch_assoc()) {
			// echo "id: " . $row["nama"]. " - Name: " . $row["lat"]. " " . $row["lng"]. "<br>";
			array_push($emparray, $row);
		}
		echo json_encode($emparray);
		} else {
			echo "0 results";
		}
?>

