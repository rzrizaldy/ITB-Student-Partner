<!DOCTYPE html>
<html>
	<head>
		<title>Cetak Tiket</title>

		<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
		<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/jquery.seat-charts.css">
		<link href="css/newstyle.css" rel="stylesheet" type="text/css" media="all" />
	</head>
	<body>
		<div class="content">
		<h1>TRANSNANGOR</h1>
			
			<div class="main">
				
				<script language="javascript">
				function Clickheretoprint()
				{ 
				  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
				      disp_setting+="scrollbars=yes,width=400, height=400, left=100, top=25"; 
				  var content_vlue = document.getElementById("print_content").innerHTML; 
				  
				  var docprint=window.open("","",disp_setting); 
				   docprint.document.open(); 
				   docprint.document.write('<html><head><title>Inel Power System</title>'); 
				   docprint.document.write('</head><body onLoad="self.print()" style="width: 400px; font-size:12px; font-family:arial;">');          
				   docprint.document.write(content_vlue);          
				   docprint.document.write('</body></html>'); 
				   docprint.document.close(); 
				   docprint.focus(); 
				}
				</script>
				<center><h2><a href="javascript:Clickheretoprint()">Cetak Tiket</a></h2></center>
				<div id="print_content" style="width: 400px;">
				<br>
				<?php
				include('db.php');
				$id=$_GET['id'];
				
				$result = $bd->query("SELECT * FROM mahasiswa WHERE IDTransaksi='$id'");
				while($row = $result->fetch_assoc())
					{
						echo 'Nomor Transaksi	: '.$row['IDTransaksi'].'<br>';
						echo 'Nama 				: '.$row['Nama'].'<br>';
						echo 'NIM 				: '.$row['NIM'].'<br>';
						echo 'Alamat 			: '.$row['Alamat'].'<br>';
						echo 'Telepon 			: '.$row['Telepon'].'<br>';
					}
				$results = $bd->query("SELECT * FROM pemesanan WHERE IDTransaksi='$id'");
				while($rows = $results->fetch_assoc())
					{
						
						$ggagaga=$rows['IDRute'];
						echo 'Rute: ';
						$resulta = $bd->query("SELECT * FROM rute WHERE IDRute='$ggagaga'");
						while($rowa = $resulta->fetch_assoc())
							{
							echo $rowa['NamaRute'].'     :'.$rowa['berangkat'].'<br>';
							}
						echo 'Nomor Kursi: '.$rows['Seat'].'<br>';
						
					}
				?>
				
		</div>
		<br>
		<h3><a href="index.php">Pesan Lagi</a></h3>
		</div>
		</div>
	</body>
		
</html>
