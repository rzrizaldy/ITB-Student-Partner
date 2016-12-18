<?php
	
	/* WEB SERIVCES FUNCTIONS */
	
	function tulis_file(){
		require_once("dbconf.php");
		$result = mysqli_query($conn, "SELECT * FROM buku");
		$xml = new DOMDocument('1.0'); $xml->preserveWhiteSpace = true; $xml->formatOutput = true; // Buat kerapihan file
		
		$group = $xml->createElement('KelompokJurnal');
		$xml->appendChild($group);
		
		while($isi = mysqli_fetch_array($result, MYSQL_ASSOC)){
			
			// INISIASI
			$data = $xml->createElement('Jurnal'); // createElement($tagname), dilakukan pada DOMDocument, menghasilkan DOMNode
			$id = $xml->createElement('ID');
			$judul = $xml->createElement('Judul');
			$nama = $xml->createElement('NamaPenulis');
			$fakultas = $xml->createElement('Fakultas');
			
			// PENGISIAN DATA XML DAN PENGELOMPOKAN TAG LEVEL 2
			$id->nodeValue =  htmlspecialchars($isi["ID"]);
			$data->appendChild($id);
			
			$judul->nodeValue = htmlspecialchars( $isi["Judul"]);
			$data->appendChild($judul); // $parentNode -> appendChild($childNode) 
			
			$nama->nodeValue =  htmlspecialchars($isi['NamaPenulis']);
			$data->appendChild($nama);
			
			$fakultas->nodeValue =  htmlspecialchars($isi['Fakultas']);
			$data->appendChild($fakultas);
			
			// PENGELOMPOKAN TAG LEVEL 1
			$group->appendChild($data);
		}
		
		$xml->save('../Progif/XML/a.xml');

		return "Thank You!";
	}
	
	function kirim_file(){
		
		$xml = new DOMDocument('1.0'); $xml->preserveWhiteSpace = true; $xml->formatOutput = true; // Buat kerapihan file
		
		$xml->load('../Progif/XML/a.xml');

		return $xml;
	}
	
	
	
	// localhost/Progif/yeay.php?action=tulis_file
	if (isset($_GET["action"])) {
		switch ($_GET["action"]){
			case "tulis_file";
				$value = tulis_file();
				echo $value;
			break;
			
			case "kirim_file";
				$value = kirim_file();
				return $value;
			break;
			
			case "tangkap_file";
				$value = tangkap_file(kirim_file());
				echo $value;
			break;
		} 
	}
	
	
	//exit(json_encode($value));
?> 