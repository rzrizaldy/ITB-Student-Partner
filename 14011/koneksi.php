<?php
	$host="sql6.freemysqlhosting.net";
	$user="sql6148424";
	$passwd="Zj3HzPqsPn";
	$db="sql6148424";
	
	//- UPDATE ----//
	$host="server424.cloudhost.id";
	$user="rnateami_progif";
	$passwd="14046";
	$db="rnateami_14011";
	
	$table="peta_icon";
	 
	$koneksi=mysqli_connect($host,$user,$passwd, $db) or die (mysqli_error());
	$res=mysqli_query($koneksi, "SELECT * FROM peta_icon");
	
	$xml = new XMLWriter();

	$xml -> openURI("php://output");
	$xml -> startDocument();
	$xml -> setIndent(true);

	$xml -> startElement('markers');
	while ($row = mysqli_fetch_assoc($res)){
		$xml -> startElement("marker");
		$xml -> writeAttribute('nomor', $row['nomor']);
		$xml -> writeAttribute('nama', $row['nama']);
		$xml -> writeAttribute('jenis', $row['jenis']);
		$xml -> writeAttribute('deskripsi', $row['deskripsi']);
		$xml -> writeAttribute('lat', $row['lat']);
		$xml -> writeAttribute('lng', $row['lng']);
		$xml -> writeAttribute('img', $row['img']);
		$xml -> endElement();
	}
	$xml -> endElement();

	header('Content-type: text/xml');
	$xml -> flush();
?>