<!DOCTYPE html>
<!-- delete.php: Untuk menghapus entri buku -->
<html>
	<head>
		<title>Update List</title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css">
	</head>
	<body>
		<?php
			include('session.php');

			$id = $_GET['id'];
			$sql = "DELETE FROM `book_on_loan` WHERE `book_on_loan`.`book_id` = '$id'";

			if (mysqli_query($conn, $sql)) {
			    echo "<h1>Record deleted successfully</h1>";
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}

			echo "<br><a href='index.php'>Back</a>";

			mysqli_close($conn);
		?>
	</body>
</html>