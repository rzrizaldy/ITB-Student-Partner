<!DOCTYPE html>
<html>
	<head>
		<title> REVIEW MATA KULIAH PILIHAN STI </title>
		<link rel="stylesheet" href="styles.css">
        <link href="./css/mainstyle.css" rel="stylesheet">
	</head>
	<body>
	<div class="wrapper-utama">
	<div class="container-utama">
		<h1>Mata Kuliah Pilihan Program Studi STI</h1>	
		<form action="" method="POST">
			<select name="MataKuliah">
			<?php
				//Database connection 		
				include 'config.php';
				
				//Select nama matakuliah query
				$sql = "SELECT m_id, namaMataKuliah FROM MataKuliah";
				$result = mysqli_query($conn, $sql);
				
				//Insert data to array
				while($row = mysqli_fetch_array($result)) 
				{
					unset($id, $nama);
					$id = $row['m_id'];
					$nama = $row['namaMataKuliah'];
					//Make dropdown list for matakuliah
					echo '<option value="'.$id.'">'.$nama.'</option>';
				}
			?>
			</select>
			<input type="submit" name="submit" value="Lihat Review"/> 
			<input type="submit" name="tambah" value="Tambahkan Review"/> 
			<br>
		</form>
		<br>
		
		<?php 
		//Action for selected matakuliah
		if(isset($_POST['MataKuliah']))
		{
			$matkul = $_POST['MataKuliah']; //storing selected id
		
			//Action for button 'Lihat Review'
			if(isset($_POST['submit'])) 
			{
				//Get nama matakuliah
				$nama="SELECT namaMataKuliah FROM MataKuliah WHERE m_id=$matkul";
				$dnama=mysqli_query($conn, $nama);
				if ($dnama){
					while ($nm = mysqli_fetch_array($dnama)){
						unset($name);
						$name = $nm['namaMataKuliah'];
						echo "<h2 align ='center'> Review Mata Kuliah </h2>";
						echo "<h3 align ='center'>".$name."</h3>";
						echo "<br>";
					}
				} else {
					echo "Error SQL: " . mysqli_error($conn);
				}
				
				//Get review from selected matakuliah
				$sql="SELECT * FROM Review WHERE m_id = $matkul ORDER BY vote DESC";
				$data = mysqli_query($conn, $sql);
				if ($data) 
				{
					//Make review table
					echo "<table>";
					echo "<thead>";
					echo "<th>No</th>";
					echo "<th>Hasil Review</th>";
					echo "<th>Jumlah Vote</th>";
					echo "<th>Pilihan</th>";
					echo "</thead>";
					
					$i=1;
					while($br = mysqli_fetch_array($data))
					{
						unset($no, $review, $vote);
						$no = $br['r_id'];
						$review = $br['review'];
						$vote = $br['vote'];				
    						echo "<tr>";
    						echo "<td>$i</td>";
							echo "<td>$review</td>";
							echo "<td>$vote</td>";
							echo "<td> <button onclick>
							<a href='vote.php?no=".$no."&vote=".$vote."'> Vote </a>
							</button> </td>";
							echo "</tr>";
							$i=$i+1;
					}
					echo "</table>";		
				} else {
					echo "Error creating table: " . mysqli_error($conn);
					}
			}
			
			//Action for button 'Tambahkan Review'
			if(isset($_POST['tambah'])) 
			{
				//Get nama matakuliah
				$nama="SELECT namaMataKuliah FROM MataKuliah WHERE m_id=$matkul";
				$dnama=mysqli_query($conn, $nama);
				if ($dnama){
					while ($nm = mysqli_fetch_array($dnama)){
						unset($name);
						$name = $nm['namaMataKuliah'];
						echo "Tambahkan Review Mata Kuliah ";
						echo $name;
						echo "<br> <br>";
					}
				} else {
					echo "Error SQL: " . mysqli_error($conn);
				}
			?>
			
			<!-- Insert review form -->
			<form method="post" action="">
				<div>
				<textarea id=review name="review" rows="5" cols="60">--Masukan Review--</textarea> <br>		
				</div>
				<p>
					<input type="hidden" name="matkul" value="<?php echo $matkul?>"/>
					<input type="submit" name="klik" value="Tambahkan"/>
				</p>
			</form>				
			
			<?php 			
			}
		}
			
			//Add review
			if(isset($_POST['klik']))
			{
				//Store attribute
				$mat = $_POST['matkul'];
				$rev = $_POST['review'];
				
				//Insert Review query
				$query = "INSERT INTO Review(m_id, review, vote) VALUES ('$mat','$rev','0')";
				$insert=mysqli_query($conn, $query);
				if ($insert){
					echo "Review berhasil ditambahkan";
				} else {
					echo "Error SQL: " . mysqli_error($conn);
				}
				
			}
			
			?>	
			</div>
	</div>	
	</body>
</html>