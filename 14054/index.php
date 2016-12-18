
<html>
	<head>
		<style>
			body{
				background-image: url("picture/background.jpg");
				color: white;
			}
			img{
				position: relative;
				/left: 625px;
			}
			form{
				position: relative;
				margin : 50px;
			}
			table{
				background-color: rgba(15, 31, 31, 0.5);
			}
			.table > tbody > tr > td > a {
				color: #fff;
			}
		</style>
        <link href="./css/mainstyle.css" rel="stylesheet">
	</head>
	<body>
		<div class="wrapper-utama">
		<div class="container-utama">
		<h1 align="center"><b>carikerja ITB</b></h1>
		<center>
			<img src="picture/itb.png" width="100" height="100" align="center">
			<form method = "get">
				Perusahaan : <input type="text" name="value1">
				Bidang : <input type="text" name="value2">
				<input type="submit" name="kirim" value = "Send">
			</form>
			<table border = "1" style="border-color: #fff; font-size:14px">
				<tr>
					<th>Pekerjaan</th>
					<th>Bidang</th>
					<th>Gaji</th>
					<th>Perusahaan</th>
					<th>Lokasi</th>
				</tr>
			<?php
				if((isset($_GET['value1']) && isset($_GET['value2']))){
					$perusahaan = $_GET['value1'];
					$bidang = $_GET['value2'];
					$data = file_get_contents('http://localhost/14054/api.php?perusahaan='.$perusahaan.'&bidang='.$bidang);
				} else if (isset($_GET['value1'])){
					$perusahaan = $_GET['value1'];
					$data = file_get_contents('http://localhost/14054/api.php?perusahaan='.$perusahaan);
				} else if (isset($_GET['value2'])){
					$bidang = $_GET['value2'];
					$data = file_get_contents('http://localhost/14054/api.php?bidang='.$bidang);
				} else {
					$data = file_get_contents('http://localhost/14054/api.php');
				}

				$xml= xmlrpc_decode($data) or die("Error: Cannot create object");
				//print_r($xml);
				for($j=0;$j<sizeof($xml);$j++){
					echo "<tr>";
					$link = $xml[$j]['link'];
					$pekerjaan = $xml[$j]['pekerjaan'];
					echo "<td><a href ='".$link."'>".$pekerjaan."</a></td>";
					$bidang = $xml[$j]['bidang'];
					echo "<td>".$bidang."</td>";
					echo "<td>".$xml[$j]['gaji'] . "</td>";
					echo "<td>".$xml[$j]['perusahaan'] . "</td>";
					$gambar = $xml[$j]['logo'];
					//echo "<img src='".$gambar."'>" . "<br>";
					echo "<td>".$xml[$j]['kota'] . "</td>";
					echo "</tr>";
				}
			?>
			</table>
		</center>
		</div>
		</div>
	</body>
</html>

