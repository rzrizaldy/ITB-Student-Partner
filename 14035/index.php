<!DOCTYPE html>
<!-- index.php: Untuk menampilkan entri-entri buku -->
<?php
	include('session.php');

	$sql = "SELECT * FROM `book_on_loan` ORDER BY `book_id` DESC";
	$result = mysqli_query($conn,$sql);

	mysqli_close($conn);
?>
<html>
	<head>
		<title>List</title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css">
        <link href="./css/mainstyle.css" rel="stylesheet">
	</head>
	<body>
		<div class="wrapper-utama">
		<div class="container" style="padding-top:8% !important; background-color:#fff; padding:2%">
			<div class='row'>
				<div class='col-md-9'>
					<h1>List available</h1>
				</div>
				<div class='col-md-2'>
					<a href='form.php' class='btn btn-primary btn-lg' role='button'>+ Peminjaman Baru</a>
				</div>
			</div>
			<?php
				while ($row = mysqli_fetch_assoc($result)) {
					$id = $row['book_id'];
					$title = $row['book_title'];
					$desc = $row['book_desc'];
					$from = date_create($row['date_loan']);
					$from = date_format($from,"d/m/Y H:i");
					$until = date_create($row['date_return']);
					$until = date_format($until,"d/m/Y H:i");
					$user_id = $row['user_id'];
					echo "
						<div class='row bottom-buffer border'>
							<div class='col-md-8'>
								<h3>$title   <small>($user_id)</small><br></h3>
								<h5>$desc</h5>
								<div class='row'>
									<div class='col-md-4'>
										<p><strong>Dipinjam:</strong> $from</p>
									</div>
									<div class='col-md-8'>
										<p><strong>Dikembalikan:</strong> $until</p>
									</div>
								</div>
							</div>";
					if ($user_id == $login_session) {
						echo "
							<div class='col-md-4' style='padding-top: 10px;'>
								<div class='row' style='margin-bottom:10px;'>
									<a href='form.php?id=$id' class='btn btn-primary btn-lg' role='button'>Ubah</a>
								</div>
								<div class='row' style='margin-bottom:10px;'>
									<a href='delete.php?id=$id' class='btn btn-danger btn-lg' role='button'>Hapus</a>
								</div>
							</div>
						";
					}
					echo "</div>";
				}
			?>
		</div>
		</div>
	</body>
</html>