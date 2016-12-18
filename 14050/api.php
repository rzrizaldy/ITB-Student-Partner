<?php

//Connect to database (tempat makan di ITB)	
$con = mysqli_connect("sql6.freemysqlhosting.net", "sql6148394", "Q4SByMvFaG") or die("Cannot connect to host");
mysqli_select_db($con,'sql6148394') or die("Cannot connect to db");
$result = mysqli_query($con,"SELECT * FROM markers");

	
//Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement('markers');
$parnode = $dom->appendChild($node);


header("Content-type: text/xml");
// Iterate through the rows, adding XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("nama",$row['nama']);
  $newnode->setAttribute("letak", $row['letak']);
  $newnode->setAttribute("deskripsi", $row['deskripsi']);
  $newnode->setAttribute("lat", $row['lat']);
  $newnode->setAttribute("lng", $row['lng']);
}
echo $dom->saveXML();
mysqli_close($con);	

?>
