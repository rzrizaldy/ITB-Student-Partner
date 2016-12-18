<?php
	include('config.php');

	// Start XML file, create parent node
	$doc = new DOMDocument("1.0");
	$node = $doc->createElement("markers");
	$parnode = $doc->appendChild($node);

	// Select all the rows in the markers table
	$query = "SELECT * FROM markers";
	$result = mysqli_query($conn,$query);
	if (!$result) {
	  die('Invalid query: ' . mysqli_error());
	}

	header("Content-type: text/xml");

	// Iterate through the rows, adding XML nodes for each
	while ($row = $result->fetch_assoc()){
	  // ADD TO XML DOCUMENT NODE
	  $node = $doc->createElement("marker");
	  $newnode = $parnode->appendChild($node);
	  $newnode->setAttribute("nama", $row['nama']);
	  $newnode->setAttribute("lat", $row['lat']);
	  $newnode->setAttribute("lng", $row['lng']);
	   $newnode->setAttribute("tipe", $row['tipe']);
}

echo $doc->saveXML();

?>
