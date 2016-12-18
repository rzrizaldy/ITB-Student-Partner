<?php
	require_once('connections/connection.php');

	// Start XML file, echo parent node
	$room = "";
	$cap = 0;
	if(isset($_GET["room"])){
		if(strlen($_GET["room"])>0) {
			$room = $_GET["room"];
		}
	}
	if(isset($_GET["cap"])){
		if(strlen($_GET["cap"])>0) {
			$cap = $_GET["cap"];
		}
	}
	$query= "SELECT gg.*, rr.nama_ruangan,rr.lantai,rr.kapasitas FROM ruangan AS rr 
			 INNER JOIN gedung AS gg ON rr.id_gedung=gg.id_gedung";
	if(strlen($room)>0 && $cap==0) {
		$query=$query." WHERE nama_ruangan = '".$room."'";
	} else if(strlen($room)>0 && $cap>0) {
		$query=$query." WHERE nama_ruangan = '".$room."' AND kapasitas>=".$cap." ORDER BY kapasitas";
	} else if(strlen($room)==0 && $cap>0) {
		$query=$query." WHERE kapasitas >= ".$cap." ORDER BY kapasitas";
	}

	$result=mysqli_query($conn, $query) or die (mysqli_error($conn)); 
 	if(mysqli_num_rows($result)>0) 
 	{	
 		$arr = "";
 		while($row=mysqli_fetch_object($result)) 
  		{
  		 	$arr=$row->namagedung. ";" . $row->lat.";". $row->lon.";". $row->wilayah.";". $row->nama_ruangan.";". $row->lantai.";". $row->kapasitas.";" ;
  		 	break;
  		}
  		echo $arr; 
 	}else{echo "";} 
 	mysqli_free_result($result);
?>