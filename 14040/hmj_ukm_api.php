<?php

	//Function to get some information about HMJ and UKM in ITB
	function get_user_by_id($id)
	{
		$con = mysqli_connect("sql6.freemysqlhosting.net","sql6149465","mfxw1RR28z") or die("Cannot connect to host");
		mysqli_select_db($con,'sql6149465') or die("Cannot connect to db");

		$user_info = array();
		$result = mysqli_query($con,"SELECT * FROM ukmhmj WHERE id=$id");
		
		$row=mysqli_fetch_assoc($result);
		
		mysqli_free_result($result);
		mysqli_close($con);

		$user_info = $row;
		
		return $user_info;
	}

		if (isset($_GET["id"]))
		   {
		    $value = get_user_by_id($_GET["id"]);
		   }


	/* WEB SERIVCES FUNCTIONS */
	function tulis_file(){
		$con = mysqli_connect("sql6.freemysqlhosting.net","sql6149465","mfxw1RR28z") or die("Cannot connect to host");
		mysqli_select_db($con,'sql6149465') or die("Cannot connect to db");
		
		$result = mysqli_query($con, "SELECT * FROM ukmhmj");
		$xml = new DOMDocument('1.0'); $xml->preserveWhiteSpace = true; $xml->formatOutput = true;
		
		$group = $xml->createElement('UKM_HMJ_ITB');
		$xml->appendChild($group);
		
		while($isi = mysqli_fetch_array($result)){
			
			// INISIASI
			$head = $xml->createElement('Lembaga'); // createElement($tagname), dilakukan pada DOMDocument, menghasilkan DOMNode
			$type = $xml->createElement('Tipe');
			$id = $xml->createElement('Nama_Lembaga');
			$deskripsi = $xml->createElement('Deskripsi');
			$nama = $xml->createElement('Ketua_Lembaga');
			
			// PENGISIAN DATA XML DAN PENGELOMPOKAN TAG LEVEL 2
			$type->nodeValue =  htmlspecialchars($isi['type']);
			$head->appendChild($type);

			$id->nodeValue =  htmlspecialchars($isi['id']);
			$head->appendChild($id);
			
			$deskripsi->nodeValue = htmlspecialchars( $isi['deskripsi']);
			$head->appendChild($deskripsi); // $parentNode -> appendChild($childNode) 
			
			$nama->nodeValue =  htmlspecialchars($isi['ketua']);
			$head->appendChild($nama);
			
			// PENGELOMPOKAN TAG LEVEL 1
			$group->appendChild($head);
		}
		
		$xml->save('xml/ukmhmj.xml');

		return header("Location:data_saved.html");
	}
	
	function load_file(){
		
		$xml = new DOMDocument('1.0'); $xml->preserveWhiteSpace = true; $xml->formatOutput = true; // Buat kerapihan file
		
		$xml->load('xml/ukmhmj.xml');

		return $xml;
	}
	
	
	
	// localhost/Progif/yeay.php?action=tulis_file
	if (isset($_GET["action"])) {
		switch ($_GET["action"]){
			case "tulis_file";
				$value = tulis_file();
				echo $value;
			break;
			
			case "load_file";
				$value = load_file();
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