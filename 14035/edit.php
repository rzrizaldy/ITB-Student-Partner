<!DOCTYPE html>
<!-- edit.php: Untuk mengubah dan menambah entri buku -->
<html>
	<head>
		<title>Update List</title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css">
	</head>
	<body>
		<?php
			include('session.php');

			$bookTitle = $_POST['bookTitle'];
			$bookDesc = $_POST['bookDesc'];
			$datetimeFrom = date('Y-m-d G:i:s', strtotime($_POST['datetimeFrom']));
			$datetimeUntil = date('Y-m-d G:i:s', strtotime($_POST['datetimeUntil']));

			if (isset($_GET['id'])) {
				$id = $_GET['id'];
				$sql = "UPDATE `book_on_loan` SET `book_title` = '$bookTitle', `book_desc` = '$bookDesc', `date_loan` = '$datetimeFrom', `date_return` = '$datetimeUntil' WHERE `book_id` = $id";
				$string = "<h1>Record changed successfully</h1>";
			} else {
				$sql = "INSERT INTO `book_on_loan` (`book_id`, `book_title`, `book_desc`, `date_loan`, `date_return`, `user_id`) VALUES (NULL, '$bookTitle', '$bookDesc', '$datetimeFrom', '$datetimeUntil', '$login_session')";
				$string = "<h1>New record created successfully</h1>";
			}

			if (mysqli_query($conn, $sql)) {
			    echo $string;
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}

			echo "<br><a href='index.php'>Back</a>";

			mysqli_close($conn);
		?>
	</body>
</html>