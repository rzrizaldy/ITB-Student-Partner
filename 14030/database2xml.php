<?php

//Connect ke database	
$con = mysqli_connect("sql6.freemysqlhosting.net", "sql6148416", "1gnryAU1Ik") or die("Cannot connect to host");
mysqli_select_db($con,'sql6148416') or die("Cannot connect to db");
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
  $newnode->setAttribute("name",$row['name']);
  $newnode->setAttribute("address", $row['address']);
  //$newnode->setAttribute("type", $row['type']);
  $newnode->setAttribute("lat", $row['lat']);
  $newnode->setAttribute("lng", $row['lng']);
  $newnode->setAttribute("is24hr", $row['is24hr']);
}
echo $dom->saveXML();
?>
