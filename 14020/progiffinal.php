<?php

error_reporting(1);

function get_web_page( $url, $cookie )
{
	$options = array(
		CURLOPT_RETURNTRANSFER    => true,	 // return web page
		CURLOPT_HEADER            => false,	// don't return headers
		CURLOPT_FOLLOWLOCATION    => true,	 // follow redirects
		CURLOPT_ENCODING	      => "",	   // handle all encodings
		CURLOPT_USERAGENT	      => "Mozilla", // who am i
		CURLOPT_AUTOREFERER	      => true,	 // set referer on redirect
		CURLOPT_CONNECTTIMEOUT    => 120,	  // timeout on connect
		CURLOPT_TIMEOUT		      => 120,	  // timeout on response
		CURLOPT_MAXREDIRS	      => 10,	   // stop after 10 redirects
		CURLOPT_SSL_VERIFYPEER    => false,	// Disabled SSL Cert checks
		CURLOPT_COOKIE		      => $cookie

		//post
		//https://stackoverflow.com/questions/2138527/php-curl-http-post-sample-code
		//curl_setopt($ch, CURLOPT_POST, 1);
		//CURLOPT_POSTFIELDS
	);

	$ch	  = curl_init( $url );
	curl_setopt_array( $ch, $options );
	$content = curl_exec( $ch );
	$err	 = curl_errno( $ch );
	$errmsg  = curl_error( $ch );
	$header  = curl_getinfo( $ch );
	curl_close( $ch );

	$header['errno']   = $err;
	$header['errmsg']  = $errmsg;
	$header['content'] = $content;
	return $header;
}



$jadwal_dosen=array();
$cookie="uitb=p81uFVf9ysu+eFsDBahlAg==; bahasa=id; _ga=GA1.3.390391195.1476250277; PHPSESSID=j9ovpoi1jmfkr12pqevjhjq7c6; _gat=1";
$hasil=get_web_page("https://ol.akademik.itb.ac.id/frs/displayjadwalkelas.php?ps=182", $cookie);

$temp=($hasil['content']);
$temp_array=explode('<td  class="kolom">',$temp);
//echo($temp);
//print_r($temp_array);
for($i=2; $i<sizeof($temp_array);$i+=2){
	//preg_match('/I Gusti Baskara/', $temp_array[$i], $cek, PREG_OFFSET_CAPTURE);
	//if($cek===false)continue;
	$nama=substr($temp_array[$i],0,strpos($temp_array[$i],'</td>'));
	if(!isset($jadwal_dosen[$nama]))$jadwal_dosen[$nama]=array();
	//echo $nama."\n";
	preg_match_all('/[0-9]{2,3} - .+ - [KTP]/', $temp_array[$i], $jam, PREG_OFFSET_CAPTURE);
	$jadwal=array();
	$nama_hari=array('1'=>"Senin",'2'=>"Selasa",'3'=>"Rabu",'4'=>"Kamis",'5'=>"Jumat");
	$idx_jam=array('1'=>"07.00-08.00 WIB",'2'=>"08.00-09.00 WIB",'3'=>"09.00-10.00 WIB",'4'=>"10.00-11.00 WIB",'5'=>"11.00-12.00 WIB",'6'=>"12.00-13.00 WIB",'7'=>"13.00-14.00 WIB",'8'=>"14.00-15.00 WIB",'9'=>"15.00-16.00 WIB",'10'=>"16.00-17.00 WIB",'11'=>"17.00-18.00 WIB");
	foreach($jam[0] as $value){
		$idx_hari=$value[0][0];
		$hari=$nama_hari[$idx_hari];
		//echo $hari.' ';
		$jamke=$idx_jam[substr($value[0],1,strpos($value[0],' ')-1)];
		//echo $jamke."\n";
		array_push($jadwal_dosen[$nama], $hari." ".$jamke." ruang ".explode(" - ", $value[0])[1]);
	}
}

$hasil=get_web_page("https://ol.akademik.itb.ac.id/frs/displayjadwalkelas.php?ps=132", $cookie);

$temp=($hasil['content']);
$temp_array=explode('<td  class="kolom">',$temp);
//echo($temp);
//print_r($temp_array);
for($i=2; $i<sizeof($temp_array);$i+=2){
	//preg_match('/I Gusti Baskara/', $temp_array[$i], $cek, PREG_OFFSET_CAPTURE);
	//if($cek===false)continue;
	$nama=substr($temp_array[$i],0,strpos($temp_array[$i],'</td>'));
	if(!isset($jadwal_dosen[$nama]))$jadwal_dosen[$nama]=array();
	//echo $nama."\n";
	preg_match_all('/[0-9]{2,3} - .+ - [KTP]/', $temp_array[$i], $jam, PREG_OFFSET_CAPTURE);
	$jadwal=array();
	//$nama_hari=array('1'=>"Senin",'2'=>"Selasa",'3'=>"Rabu",'4'=>"Kamis",'5'=>"Jumat");
	//$idx_jam=array('1'=>"07.00-08.00 WIB",'2'=>"08.00-09.00 WIB",'3'=>"09.00-10.00 WIB",'4'=>"10.00-11.00 WIB",'5'=>"11.00-12.00 WIB",'6'=>"12.00-13.00 WIB",'7'=>"13.00-14.00 WIB",'8'=>"14.00-15.00 WIB",'9'=>"15.00-16.00",'10'=>"16.00-17.00 WIB",'11'=>"17.00-18.00 WIB");
	foreach($jam[0] as $value){
		$idx_hari=$value[0][0];
		$hari=$nama_hari[$idx_hari];
		//echo $hari.' ';
		$jamke=$idx_jam[substr($value[0],1,strpos($value[0],' ')-1)];
		//echo $jamke."\n";
		array_push($jadwal_dosen[$nama], $hari." ".$jamke." ruang ".explode(" - ", $value[0])[1]);
	}
}

$hasil=get_web_page("https://ol.akademik.itb.ac.id/frs/displayjadwalkelas.php?ps=135", $cookie);

$temp=($hasil['content']);
$temp_array=explode('<td  class="kolom">',$temp);
//echo($temp);
//print_r($temp_array);
for($i=2; $i<sizeof($temp_array);$i+=2){
	//preg_match('/I Gusti Baskara/', $temp_array[$i], $cek, PREG_OFFSET_CAPTURE);
	//if($cek===false)continue;
	$nama=substr($temp_array[$i],0,strpos($temp_array[$i],'</td>'));
	if(!isset($jadwal_dosen[$nama]))$jadwal_dosen[$nama]=array();
	//echo $nama."\n";
	preg_match_all('/[0-9]{2,3} - .+ - [KTP]/', $temp_array[$i], $jam, PREG_OFFSET_CAPTURE);
	$jadwal=array();
	//$nama_hari=array('1'=>"Senin",'2'=>"Selasa",'3'=>"Rabu",'4'=>"Kamis",'5'=>"Jumat");
	//$idx_jam=array('1'=>"07.00-08.00 WIB",'2'=>"08.00-09.00 WIB",'3'=>"09.00-10.00 WIB",'4'=>"10.00-11.00 WIB",'5'=>"11.00-12.00 WIB",'6'=>"12.00-13.00 WIB",'7'=>"13.00-14.00 WIB",'8'=>"14.00-15.00 WIB",'9'=>"15.00-16.00",'10'=>"16.00-17.00 WIB",'11'=>"17.00-18.00 WIB");
	foreach($jam[0] as $value){
		$idx_hari=$value[0][0];
		$hari=$nama_hari[$idx_hari];
		//echo $hari.' ';
		$jamke=$idx_jam[substr($value[0],1,strpos($value[0],' ')-1)];
		//echo $jamke."\n";
		array_push($jadwal_dosen[$nama], $hari." ".$jamke." ruang ".explode(" - ", $value[0])[1]);
	}
}

$hasil=get_web_page("https://ol.akademik.itb.ac.id/frs/displayjadwalkelas.php?ps=180", $cookie);

$temp=($hasil['content']);
$temp_array=explode('<td  class="kolom">',$temp);
//echo($temp);
//print_r($temp_array);
for($i=2; $i<sizeof($temp_array);$i+=2){
	//preg_match('/I Gusti Baskara/', $temp_array[$i], $cek, PREG_OFFSET_CAPTURE);
	//if($cek===false)continue;
	$nama=substr($temp_array[$i],0,strpos($temp_array[$i],'</td>'));
	if(!isset($jadwal_dosen[$nama]))$jadwal_dosen[$nama]=array();
	//echo $nama."\n";
	preg_match_all('/[0-9]{2,3} - .+ - [KTP]/', $temp_array[$i], $jam, PREG_OFFSET_CAPTURE);
	$jadwal=array();
	//$nama_hari=array('1'=>"Senin",'2'=>"Selasa",'3'=>"Rabu",'4'=>"Kamis",'5'=>"Jumat");
	//$idx_jam=array('1'=>"07.00-08.00 WIB",'2'=>"08.00-09.00 WIB",'3'=>"09.00-10.00 WIB",'4'=>"10.00-11.00 WIB",'5'=>"11.00-12.00 WIB",'6'=>"12.00-13.00 WIB",'7'=>"13.00-14.00 WIB",'8'=>"14.00-15.00 WIB",'9'=>"15.00-16.00",'10'=>"16.00-17.00 WIB",'11'=>"17.00-18.00 WIB");
	foreach($jam[0] as $value){
		$idx_hari=$value[0][0];
		$hari=$nama_hari[$idx_hari];
		//echo $hari.' ';
		$jamke=$idx_jam[substr($value[0],1,strpos($value[0],' ')-1)];
		//echo $jamke."\n";
		array_push($jadwal_dosen[$nama], $hari." ".$jamke." ruang ".explode(" - ", $value[0])[1]);
	}
}

$hasil=get_web_page("https://ol.akademik.itb.ac.id/frs/displayjadwalkelas.php?ps=181", $cookie);

$temp=($hasil['content']);
$temp_array=explode('<td  class="kolom">',$temp);
//echo($temp);
//print_r($temp_array);
for($i=2; $i<sizeof($temp_array);$i+=2){
	//preg_match('/I Gusti Baskara/', $temp_array[$i], $cek, PREG_OFFSET_CAPTURE);
	//if($cek===false)continue;
	$nama=substr($temp_array[$i],0,strpos($temp_array[$i],'</td>'));
	if(!isset($jadwal_dosen[$nama]))$jadwal_dosen[$nama]=array();
	//echo $nama."\n";
	preg_match_all('/[0-9]{2,3} - .+ - [KTP]/', $temp_array[$i], $jam, PREG_OFFSET_CAPTURE);
	$jadwal=array();
	//$nama_hari=array('1'=>"Senin",'2'=>"Selasa",'3'=>"Rabu",'4'=>"Kamis",'5'=>"Jumat");
	//$idx_jam=array('1'=>"07.00-08.00 WIB",'2'=>"08.00-09.00 WIB",'3'=>"09.00-10.00 WIB",'4'=>"10.00-11.00 WIB",'5'=>"11.00-12.00 WIB",'6'=>"12.00-13.00 WIB",'7'=>"13.00-14.00 WIB",'8'=>"14.00-15.00 WIB",'9'=>"15.00-16.00",'10'=>"16.00-17.00 WIB",'11'=>"17.00-18.00 WIB");
	foreach($jam[0] as $value){
		$idx_hari=$value[0][0];
		$hari=$nama_hari[$idx_hari];
		//echo $hari.' ';
		$jamke=$idx_jam[substr($value[0],1,strpos($value[0],' ')-1)];
		//echo $jamke."\n";
		array_push($jadwal_dosen[$nama], $hari." ".$jamke." ruang ".explode(" - ", $value[0])[1]);
	}
}

$hasil=get_web_page("https://ol.akademik.itb.ac.id/frs/displayjadwalkelas.php?ps=183", $cookie);

$temp=($hasil['content']);
$temp_array=explode('<td  class="kolom">',$temp);
//echo($temp);
//print_r($temp_array);
for($i=2; $i<sizeof($temp_array);$i+=2){
	//preg_match('/I Gusti Baskara/', $temp_array[$i], $cek, PREG_OFFSET_CAPTURE);
	//if($cek===false)continue;
	$nama=substr($temp_array[$i],0,strpos($temp_array[$i],'</td>'));
	if(!isset($jadwal_dosen[$nama]))$jadwal_dosen[$nama]=array();
	//echo $nama."\n";
	preg_match_all('/[0-9]{2,3} - .+ - [KTP]/', $temp_array[$i], $jam, PREG_OFFSET_CAPTURE);
	$jadwal=array();
	//$nama_hari=array('1'=>"Senin",'2'=>"Selasa",'3'=>"Rabu",'4'=>"Kamis",'5'=>"Jumat");
	//$idx_jam=array('1'=>"07.00-08.00 WIB",'2'=>"08.00-09.00 WIB",'3'=>"09.00-10.00 WIB",'4'=>"10.00-11.00 WIB",'5'=>"11.00-12.00 WIB",'6'=>"12.00-13.00 WIB",'7'=>"13.00-14.00 WIB",'8'=>"14.00-15.00 WIB",'9'=>"15.00-16.00",'10'=>"16.00-17.00 WIB",'11'=>"17.00-18.00 WIB");
	foreach($jam[0] as $value){
		$idx_hari=$value[0][0];
		$hari=$nama_hari[$idx_hari];
		//echo $hari.' ';
		$jamke=$idx_jam[substr($value[0],1,strpos($value[0],' ')-1)];
		//echo $jamke."\n";
		array_push($jadwal_dosen[$nama], $hari." ".$jamke." ruang ".explode(" - ", $value[0])[1]);
	}
}

ksort($jadwal_dosen);

echo "<form method='get' action='progiff.php'>";
echo "<select name='dos'>";

foreach($jadwal_dosen as $key => $value){
	
	echo "<option value='".$key."'>".$key."</option>";
	
	
	// if(!isset($value[0])){
		// echo " Silahkan tanya ke dosen terkait.<br/>";
		// continue;
	// }
	// foreach($value as $jam){
		// echo " ".$jam."<br/>";
	// }
}

echo '<br>';
echo '<br>';
echo "</select>";
echo "<input type='submit' name='sbmt' value='Find Schedule'>";
echo "</form>";

if (isset($_GET['sbmt'])) {
	$dosen = $_GET['dos'];
	
	echo $dosen;
}

echo '<br>';
echo '<br>';
echo "Memiliki jadwal pada: <br><br>";

if(isset($_GET['dos'])){
	$value=$jadwal_dosen[$_GET['dos']];
	if(!isset($value[0])){
		echo " Silahkan tanya ke dosen terkait.<br/>";
		exit();
	}
	foreach($value as $jam){
		echo " ".$jam."<br/>";
	}
}



?>
