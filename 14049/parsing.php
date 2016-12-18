<?php
error_reporting(0);
//Database connect
require_once('bdd.php');

// Include the library
include('simple_html_dom.php');
  
// Retrieve the DOM from a given URL
$html = file_get_html('https://www.itb.ac.id/agenda/academic');

foreach($html ->find('tr') as $tr) {     // Foreach row in the table!
	$tanggal = $tr->find('td', 0)->plaintext; // Find the first TD (starts with 0)
	$agenda = $tr->find('td', 1)->plaintext; // Find the second TD (which will be 1)

	//Create your SQL query
	$sql = "INSERT INTO  rawdata(agenda, tglawal, tglakhir) VALUES ('$agenda','$tanggal','$tanggal') ";
	
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Error prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Error execute');
	}
	  
}
?>
