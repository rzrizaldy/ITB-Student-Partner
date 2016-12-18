<?php

	include_once('simple_html_dom.php');

	//Define Database
	$servername = "sql6.freemysqlhosting.net";
	$username = "sql6148460";
	$password = "9jjWMaRrxz";
	$dbname = "sql6148460";

	//Create Connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	//Check Connection
	if (!$conn){
		die("Connection failed: " . mysqli_connect_error());
	}

	$target_url = "http://www.jobs.id/id/lowongan/semua-pekerjaan/semua-perusahaan/semua-lokasi/1";
	
	//Start Crawling
	$html = new simple_html_dom();
	$html->load_file($target_url);


	//Separate the Object into Parts
	$kerja = explode('<div class="col-xs-12 single-job-ads"',$html);

	//Make Array Result
	//$hasil = array();

	//Crawling Jobs in 1 Page
	for($j=1;$j<sizeof($kerja);$j++){

		//Get Link of Job Details 
		preg_match('/data-href=".+" /', $kerja[$j], $linkd, PREG_OFFSET_CAPTURE);
		if(isset($linkd[0][0])){
			$hlink=substr($linkd[0][0], 11, strrpos($linkd[0][0],'" ')-11);
		}
			
			//Start Crawling
			$html2 = new simple_html_dom();
			$html2->load_file($hlink);

			//Separate the Object into Parts
			$kerja2 = explode('<div class="col-xs-12 col-sm-6 col-md-4">', $html2);

			if(sizeof($kerja2)==4){
				$k = 2;
				$l = 3;
			} else {
				$k = 1;
				$l = 2;
			}

			preg_match("/\">.+<\/a>/", $kerja2[$k], $bid, PREG_OFFSET_CAPTURE);
			if(isset($bid[0][0])){
				$hbid=substr($bid[0][0], 2, strrpos($bid[0][0],'</a>')-2);
			}

			preg_match("/\">.+<\/span>\n +\n +<\/h4>/", $kerja2[$l], $gaji, PREG_OFFSET_CAPTURE);
			if(isset($gaji[0][0])){
				$hgaji=substr($gaji[0][0], 2, strrpos($gaji[0][0],"</span>")-2);
			}

		//Get Job Title
		preg_match('/"_blank">.+<\/a>/', $kerja[$j], $job, PREG_OFFSET_CAPTURE);
		if(isset($job[0][0])){
			$hjob=substr($job[0][0], 9, strpos($job[0][0],'</a>')-9);
		}

		//Get Job Company
		preg_match('/semua-lokasi\/1">.+<\/a>/', $kerja[$j], $perusahaan, PREG_OFFSET_CAPTURE);
		if(isset($perusahaan[0][0])){
			$hperusahaan=substr($perusahaan[0][0], 16, strpos($perusahaan[0][0],'</a>')-16);
		}

		//Get Company Logo
		preg_match('/<img src=".+">/', $kerja[$j], $logo, PREG_OFFSET_CAPTURE);
		if(isset($logo[0][0])){
			$hlogo=substr($logo[0][0], 10, strpos($logo[0][0],'">')-10);
		}

		//Get Company Location
		preg_match('/"location">.+<\//', $kerja[$j], $kota, PREG_OFFSET_CAPTURE);
		if(isset($kota[0][0])){
			$hkota=substr($kota[0][0], 11, strrpos($kota[0][0],'</')-11);
		}

		$sql1 = "SELECT link FROM kerja WHERE link = '$hlink'";
		$result = $conn->query($sql1);
		if ($result->num_rows > 0){
			//echo " ";
		} else {
			$sql2 = "INSERT INTO kerja VALUES ('$hlink', '$hjob', '$hbid', '$hgaji', '$hperusahaan', '$hlogo', '$hkota')";
			if (mysqli_query($conn,$sql2)){
				//echo " ";
			} else {
				//echo "Error: ". $sql2 . "<br>" . mysqli_error($conn) . "<br>";
			}
		}

		//$hasil[]=array('link'=>$hlink,'pekerjaan'=>$hjob,'gaji'=>$hgaji,'perusahaan'=>$hperusahaan,'logo'=>$hlogo,'kota'=>$hkota);

		/*echo $hlink."<br>";
		echo $hjob."<br>";
		echo $hperusahaan."<br>";
		echo $hbid."<br>";
		echo $hgaji."<br>";
		echo "<img src='".$hlogo."'> <br>";
		echo $hkota."<br>";
		echo "<br>";*/
		
		/*$bidang = isset($_GET['bidang'])?$_GET['bidang']:"";
		$perusahaan = isset($_GET['perusahaan'])?$_GET['perusahaan']:"";*/


		/*$sql = "SELECT * FROM kerja WHERE bidang like '%$bidang%' AND perusahaan like '%$perusahaan%'";*/

		/*$hasil = mysqli_query($conn,$sql);

		$encode = array();
		while($row=mysqli_fetch_array($hasil,1)){
			array_push($encode, $row);
		}*/	

		//echo xmlrpc_encode($hasil);

	}

	mysqli_close($conn);
?>