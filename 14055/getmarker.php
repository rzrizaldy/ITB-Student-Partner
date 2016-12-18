<?php
	require_once('connections/connection.php');

	// Start XML file, echo parent node
	$gedungid = $_GET["gid"];
	$query="SELECT namagedung,lat,lon FROM gedung WHERE id_gedung=$gedungid"; 
  	$result=mysqli_query($conn, $query) or die (mysqli_error($conn)); 
 	if(mysqli_num_rows($result)>0) 
 	{	
 		$arr = "";
 		while($row=mysqli_fetch_object($result)) 
  		{
  		 $arr=$row->lat. ";" . $row->lon.";" ;
  		}
  		echo $arr; 
 	}else{echo "";} 
 	mysqli_free_result($result);
?>