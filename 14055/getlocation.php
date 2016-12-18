<?php
	require_once('connections/connection.php');
	header("Content-type: text/xml");

	// Start XML file, echo parent node
	
	echo '<markers>';
	$gedungid = $_GET["gid"];
	$query="SELECT namagedung,lat,lon FROM gedung WHERE id_gedung=$gedungid"; 
  	$result=mysqli_query($conn, $query) or die (mysqli_error($conn)); 
 	if(mysqli_num_rows($result)>0) 
 	{	
 		$arr = "";
 		while($row=mysqli_fetch_object($result)) 
  		{
		  echo '<marker ';
		  echo 'name="' . $row->namagedung . '" ';
		  echo 'address="Jl.Ganesha No.10, Bandung, Jawa Barat" ';
		  echo 'lat="' . $row->lat . '" ';
		  echo 'lng="' . $row->lon. '" ';
		  echo 'type="university" ';
		  echo '/>';
  		} 
 	}else{echo "";} 
 	mysqli_free_result($result);
 	echo '</markers>'; 
?>