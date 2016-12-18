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

	function getclass($userid, $conn){

		$result = mysqli_query($conn, "SELECT class.ClassID, Name FROM class, teaches WHERE class.ClassID = teaches.ClassID AND UserID = $userid;");

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

	function getclassjournal($userid, $classid, $conn){

		if ($classid ==  'ALL'){
			$result = mysqli_query($conn, "SELECT lesson_plans.ClassID AS ClassID, DAYNAME(Date) AS Day, DATE_FORMAT(Date, '%D') AS Date, MONTHNAME(Date) AS Month, YEAR(Date) AS Year, Topic, Status FROM lesson_plans, teaches WHERE lesson_plans.ClassID = teaches.ClassID AND teaches.UserID = '$userid' ORDER BY Date ASC;");
		} else {
			$result = mysqli_query($conn, "SELECT DAYNAME(Date) AS Day, DATE_FORMAT(Date, '%D') AS Date, MONTHNAME(Date) AS Month, YEAR(Date) AS Year, Topic, Status FROM lesson_plans WHERE ClassID = '$classid' ORDER BY Date ASC;");
		}

		echo mysql_error();

		return $result;
	}

	function showclassjournal($userid, $classid, $conn){
		$result = getclassjournal($userid, $classid, $conn);

		if ((mysqli_num_rows($result)) == 0){
			echo "<p>No Journal.</p>";
		} else {
			echo "<ul>";
				while ($row = mysqli_fetch_array($result)) {
					echo "<li><h3>" . $row[ 'Day' ] . ", " . $row[ 'Date' ] . " " . $row[ 'Month' ] . " " . $row[ 'Year' ] . "</h3>";
					echo "<p>" . $row[ 'Topic' ] . "</p></li>";
				}
			echo "</ul>";
		}
	}

	function getclassannouncements($userid, $classid, $conn){
		if ($classid ==  'ALL'){
			$result = mysqli_query($conn, "SELECT announcements.ClassID, Title, Content FROM announcements, teaches WHERE teaches.ClassID = announcements.classID AND teaches.UserID = '$userid' ORDER BY AnnouncementID DESC;");
		} else {
			$result = mysqli_query($conn, "SELECT Title, Content FROM announcements WHERE ClassID = '$classid' ORDER BY AnnouncementID DESC;");
		}

		echo mysql_error();

		return $result;
	}

	function showclassannouncements($userid, $classid, $conn){

		$result = getclassannouncements($userid, $classid, $conn);

		if ((mysqli_num_rows($result)) == 0){
			echo "<p>No announcements.</p>";
		} else {
			echo "<ul>";
				while ($row = mysqli_fetch_array($result)) {
					echo "<li><h3>" . $row[ 'Title' ] . "</h3>";
					echo "<p>" . $row[ 'Content' ] . "</p></li>";
				}
			echo "</ul>";
		}
	}

	function showscorecriteria($classid, $conn){
		$criteria = mysqli_query($conn, "SELECT CriteriaID, Percentage, Criteria FROM scorecriteria WHERE ClassID = '$classid';");
		echo mysql_error();

		if (mysqli_num_rows($criteria) == 0){
			echo "No criteria defined yet!";
		} else {
			echo "<table class='scoretable'>";
			$i = 0;
			while ($row = mysqli_fetch_array($criteria)) {
				echo "<tr>";
				$criteriaid = $row[ 'CriteriaID' ];

				echo "<td style='width:200px;'>" . $row[ 'Criteria' ] . "</td>";

				$scores = mysqli_query($conn, "SELECT ROUND(AVG(Score), 2) AS Average FROM scores WHERE ClassID = '$classid' AND CriteriaID = '$criteriaid';");
				echo mysql_error();

				while ($res = mysqli_fetch_array($scores)){
					echo "<td>";
					if ($res[ 'Average' ] == NULL){
						echo "0";
					} else {
						echo $res[ 'Average' ];
					}
					echo "</td>";
				}

				$i = $i + 1;
				echo "</tr>";
			}
			echo "</table>";
		}
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

		mysqli_close($conn);
	}

	function showclassassignments($classid, $conn){

		$result = mysqli_query($conn, "SELECT Title, Details FROM assignment WHERE ClassID = '$classid' ORDER BY AssignmentID DESC;");

		echo mysql_error();

		if ((mysqli_num_rows($result)) == 0){
			echo "<p>No assignments.</p>";
		} else {
			echo "<ul>";
				while ($row = mysqli_fetch_array($result)) {
					echo "<li><h3>" . $row[ 'Title' ] . "</h3>";
					echo "<p>" . $row[ 'Details' ] . "</p></li>";
				}
			echo "</ul>";
		}
	}

	function getuserdetail($userid, $conn){

		$result = mysqli_query($conn, "SELECT Name FROM user WHERE UserID = '$userid';");

		while ($row = mysqli_fetch_array($result)){
			$user = $row[ 'Name' ];
		}

		echo mysql_error();

		return $user;

	}

	function getclassdetails($classid, $conn){
		$result = mysqli_query($conn, "SELECT ClassID, Name FROM class WHERE ClassID = '$classid';");

		while ($row = mysqli_fetch_array($result)) {
		//echo "<tr>";
			$end[0] = $row[ 'ClassID' ];
			$end[1] = $row[ 'Name' ];
		}

		return $end;
	}

?>
