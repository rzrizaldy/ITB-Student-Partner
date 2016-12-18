<?php

	function openconnection(){
		// Create connection
		$conn = mysqli_connect("sql6.freemysqlhosting.net", "sql6148984", "CjtgzGiDjw", "sql6148984");

		// Check connection
		/*if (mysqli_connect_errno()) {
    		echo "Connection failed: " . mysqli_connect_error();
		} else {
    		echo "Connected successfully";
		}*/

		return $conn;
	}

	function closeconnection($conn){
		mysqli_close($conn);
	}

	function getclassdetails($classid, $conn){

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

	}

	function getotherclass($userid, $classid, $conn){
		$result = mysqli_query($conn, "SELECT class.ClassID, Name FROM class, takes WHERE class.ClassID = takes.ClassID AND UserID = $userid AND class.ClassID <> '$classid';");

		$c = 0;

		if (is_null($result)){
			return $result;
		} else {
			while ($row = mysqli_fetch_array($result)) {
			//echo "<tr>";
				$e = 0;
				$words = explode(" ", $row[ 'Name' ]);
				$initials = "";

				foreach ($words as $w) {
					$initials .= $w[0];
				}
				$details[$c][$e] = $initials;
				$e = $e + 1;
				$details[$c][$e] = $row[ 'ClassID' ];
				$e = $e + 1;
				$details[$c][$e] = $row[ 'Name' ];
				$c = $c + 1;
			//echo "</tr>";
			}
		}
		//echo "</table>";

		return $details;
	}

	function getclassannouncements($userid, $classid, $conn){
		if ($classid ==  'ALL'){
			$result = mysqli_query($conn, "SELECT announcements.ClassID, Title, Content FROM announcements, takes WHERE takes.ClassID = announcements.classID AND takes.UserID = '$userid' ORDER BY AnnouncementID DESC;");
		} else {
			$result = mysqli_query($conn, "SELECT Title, Content FROM announcements WHERE ClassID = '$classid' ORDER BY AnnouncementID DESC;");
		}

		echo mysql_error();

		return $result;

	}

	function getclassassignments($userid, $classid, $conn){

		if ($classid ==  'ALL'){
			$result = mysqli_query($conn, "SELECT assignment.ClassID, Title, Details FROM assignment, takes WHERE assignment.ClassID = takes.ClassID AND takes.UserID = '$userid' ORDER BY AssignmentID DESC;");
		} else {
			$result = mysqli_query($conn, "SELECT Title, Details FROM assignment WHERE ClassID = '$classid' ORDER BY AssignmentID DESC;");
		}

		echo mysql_error();

		return $result;

	}

	function getscore($userid, $classid, $conn){

		$criteria = mysqli_query($conn, "SELECT CriteriaID, Percentage, Criteria FROM scorecriteria WHERE ClassID = '$classid';");
		echo mysql_error();

		if (mysqli_num_rows($criteria) == 0){
			$result[0][0] = 'No criteria defined yet!';
			$result[0][1] = '';
		} else {
			$i = 0;
			while ($row = mysqli_fetch_array($criteria)) {
				$criteriaid = $row[ 'CriteriaID' ];

				$result[$i][0] = $row[ 'Criteria' ];

				$scores = mysqli_query($conn, "SELECT ROUND(AVG(Score), 2) AS Average FROM scores WHERE ClassID = '$classid' AND CriteriaID = '$criteriaid' AND UserID = '$userid';");
				echo mysql_error();

				while ($res = mysqli_fetch_array($scores)){
					if ($res[ 'Average' ] == NULL){
						$result[$i][1] = 0;
					} else {
						$result[$i][1] = $res[ 'Average' ];
					}
				}

				$i = $i + 1;
			}
		}

		return $result;

	}

	function getclassjournal($userid, $classid, $conn){

		if ($classid ==  'ALL'){
			$result = mysqli_query($conn, "SELECT lesson_plans.ClassID, DAYNAME(Date), DATE_FORMAT(Date, '%D'), MONTHNAME(Date), YEAR(Date), Topic, Status FROM lesson_plans, takes WHERE lesson_plans.ClassID = takes.ClassID and takes.UserID = '$userid' ORDER BY Date ASC;");
		} else {
			$result = mysqli_query($conn, "SELECT DAYNAME(Date), DATE_FORMAT(Date, '%D'), MONTHNAME(Date), YEAR(Date), Topic, Status FROM lesson_plans WHERE ClassID = '$classid' ORDER BY Date ASC;");
		}

		echo mysql_error();

		return $result;

	}

	function isadmin($userid, $classid, $conn){

		$result = mysqli_query($conn, "SELECT admin FROM takes WHERE ClassID = '$classid' AND UserID = '$userid';");

		echo mysql_error();

		if (is_null($result)){
			$admin = 0;
		} else {
			while ($row = mysqli_fetch_array($result)) {
				if ($row['admin'] == 1){
					$admin = 1;
				} else {
					$admin = 0;
				}
			}
		}

		return $admin;

	}

?>
