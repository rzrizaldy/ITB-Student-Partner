<!DOCTYPE html>
<?php
		include 'connectdb.php';
		connectDB();

	
		$sql = "select Nama FROM user order by Nama";
		$result = mysqli_query($connect, $sql);
	

	
	
?>


<html>
<body>
<h1 div align="center"> Pilih Teman Anda yang Ingin Anda Ketahui Lokasinya</div>

<form action="tracker.php" method="get">
	<?php
	echo "<select name='Nama'>";
	while ($row = $result -> fetch_assoc()) {
    echo "<option value='" . $row['Nama'] ."'>" . $row['Nama'] ."</option>";
	}
	echo "</select>";
	?>
    <input type="submit" value="Submit">
</form> 

</body>
</html>	
