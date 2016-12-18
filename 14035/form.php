<!DOCTYPE html>
<!-- form.php: Form untuk memasukkan entri buku -->
<?php
	include('session.php');

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$link="edit.php?id=$id";
		$sql = "SELECT * FROM book_on_loan WHERE book_id = $id";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_assoc($result);
		$title = $row['book_title'];
		$desc = $row['book_desc'];
		$from = date_create($row['date_loan']);
		$until = date_create($row['date_return']);
	} else {
		$link="edit.php";
		$id = NULL;
		$title = NULL;
		$desc = NULL;
		$from = NULL;
		$until = NULL;
	}

	mysqli_close($conn);
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Form</title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css">
		<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
		<script type="text/javascript" src="js/moment.js"></script>
		<script type="text/javascript" src="js/transition.js"></script>
		<script type="text/javascript" src="js/collapse.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
	</head>
	
	<body>
		<div class="container">
			<form name="formTitleDesc" method="post" action="<?php echo $link; ?>">
				<div class="form-group">
					<label for="bookTitle">Judul Buku:</label>
					<input type="text" class="form-control" name="bookTitle" value="<?php echo $title; ?>"/>
				</div>
				<div class="form-group">
					<label for="bookDesc">Deskripsi Buku:</label>
					<textarea class="form-control" style="resize:none" name="bookDesc" rows="12"><?php echo $desc; ?></textarea>
				</div>
				<div class='row'>
					<div class='col-md-3'>
						<div class="form-group">
							<div class='input-group date'>
								<label for='datetimeFrom'>Tanggal/Waktu Pinjam:</label>
								<input type='text' class="form-control" name='datetimeFrom' id='dtFrom' >
							</div>
						</div>
					</div>
					<div class='col-md-3'>
						<div class="form-group">
							<div class='input-group date'>
								<label for='datetimeUntil'>Tanggal/Waktu Kembali:</label>
								<input type='text' class="form-control" id='dtUntil' name='datetimeUntil' >
							</div>
						</div>
					</div>
				</div>
				<script type="text/javascript">
					$(function () {
						$('#dtFrom').datetimepicker(
							<?php
								if (isset($_GET['id'])) {
									$dateF = date_format($from,"Y/m/d H:i:s");
									echo "{defaultDate: '$dateF'}";
								}
							?>
						);
						$('#dtUntil').datetimepicker({
							<?php
								if (isset($_GET['id'])) {
									$dateU = date_format($until,"Y/m/d H:i:s");
									echo "defaultDate: '$dateU',";
								}
							?>
							useCurrent: false //Important! See issue #1075
						});
						$('#dtFrom').data("DateTimePicker").sideBySide(true);
						$('#dtFrom').data("DateTimePicker").format('YYYY-MM-DD HH:mm');
						$('#dtFrom').data("DateTimePicker").stepping(10);
						$('#dtUntil').data("DateTimePicker").sideBySide(true);
						$('#dtUntil').data("DateTimePicker").format('YYYY-MM-DD HH:mm');
						$('#dtUntil').data("DateTimePicker").stepping(10);
						$("#dtFrom").on("dp.change", function (e) {
							$('#dtUntil').data("DateTimePicker").minDate(e.date);
						});
						$("#dtUntil").on("dp.change", function (e) {
							$('#dtFrom').data("DateTimePicker").maxDate(e.date);
						});
					});
				</script>
				<button type="submit" class="btn btn-primary" action="">Simpan</button>
				<a href="index.php" class="btn btn-default">Batal</a>
			</form>
		</div>
	</body>
</html>