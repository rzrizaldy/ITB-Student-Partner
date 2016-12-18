<?php
	
	//Start session
		session_start();
		
		//Unset the variables stored in session
		unset($_SESSION['SESS_MEMBER_ID']);
	
	$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "transnangor";

					// Create connection
					$conn = mysqli_connect($servername, $username, $password, $dbname);
					// Check connection
					if (!$conn) {
					    die("Connection failed: " . mysqli_connect_error());
					}

		$jadwal = file_get_contents("https://jatinangor.itb.ac.id/fasilitas/shuttle-bus-darike-ganesha/");

		$nangor = explode('<td style="width: 77.25pt;border: solid windowtext 1.0pt;border-top: none;',$jadwal);
		

		for($j=4;$j<sizeof($nangor);$j++){

			echo "baris ".$j."<br>";

			preg_match('/<p class="MsoNormal" style="margin-bottom: .0001pt;text-align: center;line-height: normal" align="center"><span style="color: black">.+<\//', $nangor[$j], $waktu1, PREG_OFFSET_CAPTURE);
			
			if($waktu1!==false){
				$hwaktu1=substr($waktu1[0][0], 133, strrpos($waktu1[0][0],'</')-133);
			}
			
			preg_match('/valign="bottom" nowrap="nowrap" width="102">\n<p class="MsoNormal" style="margin-bottom: .0001pt;text-align: center;line-height: normal" align="center"><span style="color: black">.+<\//', $nangor[$j], $waktu2, PREG_OFFSET_CAPTURE);
			

			if($waktu2!==false){
				$hwaktu2=substr($waktu2[0][0], 178, strrpos($waktu2[0][0],'</')-178);
			}

			preg_match('/valign="bottom" nowrap="nowrap" width="107">\n<p class="MsoNormal" style="margin-bottom: .0001pt;text-align: center;line-height: normal" align="center"><span style="color: black">.+<\//', $nangor[$j], $waktu3, PREG_OFFSET_CAPTURE);
			

			if($waktu3!==false){
				$hwaktu3=substr($waktu3[0][0], 178, strrpos($waktu3[0][0],'</')-178);
			}

			preg_match('/valign="bottom" nowrap="nowrap" width="108">\n<p class="MsoNormal" style="margin-bottom: .0001pt;text-align: center;line-height: normal" align="center"><span style="color: black">.+<\//', $nangor[$j], $waktu4, PREG_OFFSET_CAPTURE);
			

			if($waktu4!==false){
				$hwaktu4=substr($waktu4[0][0], 178, strrpos($waktu4[0][0],'</')-178);
			}
			

			echo $hwaktu1."<br>";
			echo $hwaktu2."<br>";
			echo $hwaktu3."<br>";
			echo $hwaktu4."<br>";

			echo "<br>";
			
		
			$hwaktu1=substr($hwaktu1,0,5);
			$hwaktu2=substr($hwaktu2,0,5);
			$hwaktu3=substr($hwaktu3,0,5);
			$hwaktu4=substr($hwaktu4,0,5);
			$rute1 = "Ganesha-Jatinangor";
			$sql1 = "INSERT INTO rute(berangkat, sampai, NamaRute)
						VALUES ('$hwaktu1', '$hwaktu2', '$rute1')";

						if (mysqli_query($conn, $sql1)) {
						    echo "New record created successfully";
						} else {
						    echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
						}
			$rute2 = "Jatinangor-Ganesha";
			$sql2 = "INSERT INTO rute(berangkat, sampai, NamaRute)
						VALUES ('$hwaktu3', '$hwaktu4', '$rute2')";

						if (mysqli_query($conn, $sql2)) {
						    echo "New record created successfully". "<br>";
						} else {
						    echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
						}

		}


?>