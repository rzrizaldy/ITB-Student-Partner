<?php

	function submitannouncement($userid, $classid, $title, $content){
		// Create connection
		$conn = mysqli_connect("127.0.0.1", "18214045", "18214045", "db18214045");

		// Check connection
		/*if (mysqli_connect_errno()) {
			echo "Connection failed: " . mysqli_connect_error();
		} else {
			echo "Connected successfully";
		}*/

		$result = mysqli_query($conn, "INSERT INTO `announcements`(`ClassID`, `Title`, `Content`) VALUES ('$classid','$title','$content');");

		mysqli_close($conn);

		echo "Announcement submitted!";
	}

	function submitscore($userid, $classid, $criteriaid, $date, $title, $score){
		// Create connection
		$conn = mysqli_connect("127.0.0.1", "18214045", "18214045", "db18214045");

		// Check connection
		/*if (mysqli_connect_errno()) {
			echo "Connection failed: " . mysqli_connect_error();
		} else {
			echo "Connected successfully";
		}*/

		$result = mysqli_query($conn, "INSERT INTO `scores`(`UserID`, `ClassID`, `CriteriaID`, `Date`, `Title`, `Score`) VALUES ('$userid','$classid','$criteriaid','$date','$title','$score');");

		mysqli_close($conn);

		echo "Score submitted!";
	}

	function submitjournalprof($classid, $date, $topic, $status){
		// Create connection
		$conn = mysqli_connect("127.0.0.1", "18214045", "18214045", "db18214045");

		// Check connection
		/*if (mysqli_connect_errno()) {
			echo "Connection failed: " . mysqli_connect_error();
		} else {
			echo "Connected successfully";
		}*/

		$result = mysqli_query($conn, "INSERT INTO `lesson_plans`(`ClassID`, `Date`, `Topic`, `Status`) VALUES ('$classid','$date','$topic','$status');");

		mysqli_close($conn);

		echo "Lesson plan submitted!";
	}

	function submitjournalstudent($classid, $lessonid, $topic){
		// Create connection
		$conn = mysqli_connect("127.0.0.1", "18214045", "18214045", "db18214045");

		// Check connection
		/*if (mysqli_connect_errno()) {
			echo "Connection failed: " . mysqli_connect_error();
		} else {
			echo "Connected successfully";
		}*/

		$result = mysqli_query($conn, "UPDATE `lesson_plans` SET `Topic` = '$topic', `Status` = '1' WHERE `lesson_plans`.`ClassID` = '$classid' AND `lesson_plans`.`LessonID` = '$lessonid';");

		mysqli_close($conn);

		echo "Class journal submitted!";
	}

	function submitassignment($classid, $title, $details, $date){
		// Create connection
		$conn = mysqli_connect("127.0.0.1", "18214045", "18214045", "db18214045");

		// Check connection
		/*if (mysqli_connect_errno()) {
			echo "Connection failed: " . mysqli_connect_error();
		} else {
			echo "Connected successfully";
		}*/

		$result = mysqli_query($conn, "INSERT INTO `assignment`(`ClassID`, `Title`, `Details`, `DueDate`) VALUES ('$classid','$title','$details','$date');");

		mysqli_close($conn);

		echo "Assignment submitted!";
	}

	if ($_GET['action'] == 'announcement'){
		submitannouncement($_GET['userid'], $_GET['classid'], $_GET['title'], $_GET['content']);
	} elseif ($_GET['action'] == 'scores'){
		submitscore($_GET['userid'], $_GET['classid'], $_GET['criteriaid'], $_GET['date'], $_GET['title'], $_GET['score']);
	} elseif($_GET['action'] == 'journal'){
		submitjournalprof($_GET['classid'], $_GET['date'], $_GET['topic'], $_GET['status']);
	} elseif($_GET['action'] == 'journalstudent'){
		submitjournalstudent($_GET['classid'], $_GET['lessonid'], $_GET['topic']);
	} elseif($_GET['action'] == 'assignment'){
		submitassignment($_GET['classid'], $_GET['title'], $_GET['details'], $_GET['date']);
	}

?>
