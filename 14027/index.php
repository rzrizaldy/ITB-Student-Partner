<?php
	include "API.php";
?>

<html>
<head>
<style>
	table, th, td {
		border: 1px solid black;
		border-collapse: collapse;
	}
	th, td {
		padding: 5px;
		text-align: left;    
	}
</style>
        <link href="./css/mainstyle.css" rel="stylesheet">
</head>

<body>
<div class="wrapper-utama">
<div class="container-utama">
	<h1>Jurnal Pustaka ITB</h1>
	<table style="width:100%">
	  <tr>
		<th>ID</th>
		<th>Judul</th>
		<th>Penulis</th>
		<th>Fakultas</th>
	  </tr>
		<?php
			parse_xml(tangkap_xml(kirim_file()));
		?>
	</table>
	</div>
	</div>
</body>

<?php
	function parse_xml($xml){
		$nodes = $xml->getElementsByTagName("KelompokJurnal");
		foreach ($nodes as $node){
			$jurnal = $node->getElementsByTagName("Jurnal");
			foreach ($jurnal as $isi){
				
				$id = $isi->getElementsByTagName("ID");
				$id_value = $id->item(0)->nodeValue; 
				
				$judul = $isi->getElementsByTagName("Judul");
				$judul_value = $judul->item(0)->nodeValue; 
				
				$nama = $isi->getElementsByTagName("NamaPenulis");
				$nama_value = $nama->item(0)->nodeValue; 
				
				$fakultas = $isi->getElementsByTagName("Fakultas");
				$fakultas_value = $fakultas->item(0)->nodeValue; 
				
				echo "
					<tr>
						<td>$id_value</td>
						<td>$judul_value</td>
						<td>$nama_value</td>
						<td>$fakultas_value</td>
					</tr>
					";
			}
		}
	}

	function tangkap_xml($source){
		
		$xml = new DOMDocument('1.0'); $xml->preserveWhiteSpace = true; $xml->formatOutput = true; // Buat kerapihan file
		
		$xml = $source;
		//$xml->loadXML($source);
		
		return $xml;
	}	
	
?>