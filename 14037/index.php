<?php
	function print_info(){

		include_once("simple_html_dom.php");

		echo '
		<div class="table-responsive">
			<table class="table table-hover">
				<tr>
					<td>
						Nama Beasiswa
					</td>
					<td>
						Kuota
					<td>
						Link
					</td>
				</tr>';

		for($idx=1; $idx<=18; $idx++) {
			$url = 'http://kemahasiswaan.itb.ac.id/beasiswa/beasiswa/index/'.$idx;

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$page = curl_exec($ch);

			$html = new simple_html_dom();
			$html->load($page, true, false);

			$judul = array();
			$kuota = array();
			$link = array();
			$neff = -1;

			foreach($html->find('h5.beasiswa-title')as $temp) {
				$judul[] = $temp;
				$neff++;
			}
			foreach($html->find('table.beasiswa') as $bs) {
				$kuota[] = $bs->find('td',2)->plaintext;
				if($bs->find('tr',3)) {
					$link[] = $bs->find('tr',3)->find('td',2)->plaintext;
				} else {
					$link[] = null;
				}
			}

			for($i=0;$i<=$neff;$i++) {
				if($kuota[$i]!='0' && $kuota[$i]!='' && $kuota[$i]!='-'){	//Hanya menampilkan beasiswa yang masih tersedia
					echo '<tr>';
					echo '<td>'.$judul[$i].'</td>';
					echo '<td>'.$kuota[$i].'</td>';
					if($link[$i]!=null) {
						echo '<td><a href="'.$link[$i].'">'.$link[$i].'</a></td>';
					} else {
						echo '<td><a href="http://kemahasiswaan.itb.ac.id/beasiswa/">http://kemahasiswaan.itb.ac.id/beasiswa/</a></td>';
					}
					echo '</tr>';
				}
			}
		}

		echo '
			</table>
		</div>';
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8">
	<meta name="author" content="Bona Muvid">
	<meta http-equiv="refresh" content="600">
	<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
	<title>Info Beasiswa ITB</title>
	<style>
		html, body {
			height:100%;
			width:100%;
		}
		body {
			background-color:#EFEFEF;
			margin:auto;
			padding:0px;
			position:absolute;
			background-repeat:no-repeat;
			background-position:center center;
			background-attachment:fixed;
			width:100%;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-default" style="padding-top:7% !important">
		<div class="container-fluid">
			<a class="navbar-brand" href="">Info Beasiswa ITB</a>
		</div>
	</nav>
	<section class="container">
		<div class="white">
			<div class="content">
				<?php
					print_info();
				?>
			</div>
		</div>
	</section>
</body>
</html>