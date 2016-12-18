<?php

	function getclassdetails($classid){
		// Create connection
		$conn = mysqli_connect("sql6.freemysqlhosting.net", "sql6148984", "CjtgzGiDjw", "sql6148984");

		// Check connection
		/*if (mysqli_connect_errno()) {
			echo "Connection failed: " . mysqli_connect_error();
		} else {
			echo "Connected successfully";
		}*/

		$result = mysqli_query($conn, "SELECT ClassID, Name FROM class WHERE ClassID = '$classid';");

		//$c = 0;

		if ($classid == 'ALL'){
			$details[0] = 'ALL';
			$details[1] = 'ALL';
			$details[2] = 'All Classes';
		} else {
			while ($row = mysqli_fetch_array($result)) {
				//echo "<tr>";
				$e = 0;
				$words = explode(" ", $row[ 'Name' ]);
				$initials = "";

				foreach ($words as $w) {
					$initials .= $w[0];
				}
				$details[$e] = $initials;
				$e = $e + 1;
				$details[$e] = $row[ 'ClassID' ];
				$e = $e + 1;
				$details[$e] = $row[ 'Name' ];
				//$c = $c + 1;
				//echo "</tr>";
			}
		}
		//echo "</table>";

		return $details;

		mysqli_close($conn);
	}

	function getcriteria($classid){
		// Create connection
		$conn = mysqli_connect("sql6.freemysqlhosting.net", "sql6148984", "CjtgzGiDjw", "sql6148984");

		// Check connection
		/*if (mysqli_connect_errno()) {
    		echo "Connection failed: " . mysqli_connect_error();
		} else {
    		echo "Connected successfully";
		}*/

		$result = mysqli_query($conn, "SELECT CriteriaID, Criteria FROM scorecriteria;");

		mysqli_close($conn);

		return $result;
	}

	function getjournal($classid){
		// Create connection
		$conn = mysqli_connect("sql6.freemysqlhosting.net", "sql6148984", "CjtgzGiDjw", "sql6148984");

		// Check connection
		/*if (mysqli_connect_errno()) {
    		echo "Connection failed: " . mysqli_connect_error();
		} else {
    		echo "Connected successfully";
		}*/

		$result = mysqli_query($conn, "SELECT LessonID, Date FROM lesson_plans;");

		mysqli_close($conn);

		return $result;
	}

?>
