<?php
	//Include library html dom
	include_once('simple_html_dom.php');
	
	//Database connection
	include('config.php');
	
	//Function for retrieve data from website
	function getdata($link,$notabel) {
		//Get HTML from link
		$htmlContent = file_get_contents($link);
		
		//Load HTML
		$DOM = new DOMDocument();
		@$DOM -> loadHTML($htmlContent);
		
		// Discard white space
		$DOM -> preserveWhiteSpace = FALSE;
		
		$table = array();
		
		//Get table by its tag name
		$tables = $DOM->getElementsByTagName('table');
	
		//Get all rows from the table
		$rows = $tables->item($notabel)->getElementsByTagName('tr');
		
		//Loop over the table rows
		foreach ($rows as $row) {
			//Get each column by tag name
			$cols = $row->getElementsByTagName('td');
			$row = array();
			$i = 0;
			
			foreach ($cols as $node){
				$row[] = $node->nodeValue;
				$i++;
			}
			$table[]=$row;
		}
		return ($table);
	}
	
	//Website link
	$link = "https://www.stei.itb.ac.id/file/kurikulum/kurikulum-s1-sti.htm";
	$no1 = '2'; //matakuliah pilihan prodi table 
	$no2 = '3'; //matakuliah luar prodi table
	
	//Array data
	$data1 = getdata($link,$no1);
	$data2 = getdata($link,$no2);
	
	//Show retrieved data
	//Matakuliah pilihan prodi
	echo '<pre>';
	print_r($data1);
	echo '</pre>';
	//Matakuliah luar prodi
	echo '<pre>';
	print_r($data2);
	echo '</pre>';
	
	//Insert data to database function
	function insert ($array, $conn){
		if (is_array($array)){
			foreach ($array as $row => $value){
				$kode = mysqli_real_escape_string($conn, $value[1]);
				$nama = mysqli_real_escape_string($conn, $value[2]);
				$sks = mysqli_real_escape_string($conn, $value[3]);
				$sql = "INSERT INTO MataKuliah (kodeMataKuliah, namaMataKuliah, jumlahSks)
						VALUES ('".$kode."','".$nama."','".$sks."')";
				mysqli_query($conn, $sql);
			}
		}	
	}
	
	//Insert data to database
	insert($data1, $conn);
	insert($data2, $conn);
	
	//Close connection
	mysqli_close($conn);

?>