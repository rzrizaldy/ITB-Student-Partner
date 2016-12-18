<?php


//Database connect
require_once('bdd.php');

//Delete unnecessary data recorded
$sql = "DELETE FROM rawdata WHERE (id>71)";
	$query = $bdd->prepare( $sql );
	$sth = $query->execute();

//Change some unseparated data
$sql ="UPDATE rawdata SET tglawal = '11 Januari 2016', tglakhir = '14 Januari 2016' WHERE rawdata.id = 3";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '9 Februari 2016', tglakhir = '11 Februari 2016' WHERE rawdata.id = 8";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '14 Maret 2016', tglakhir = '18 Maret 2016' WHERE rawdata.id = 11";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '21 Maret 2016', tglakhir = '7 April 2016' WHERE rawdata.id = 13";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '1 April 2016', tglakhir = '2 April 2016' WHERE rawdata.id = 14";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '2 Mei 2016', tglakhir = '19 Mei 2016' WHERE rawdata.id = 17";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '25 Mei 2016', tglakhir = '27 Mei 2016' WHERE rawdata.id = 18";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '30 Mei 2016', tglakhir = '5 Agustus 2016' WHERE rawdata.id = 19";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '31 Mei 2016', tglakhir = '1 Juni 2016' WHERE rawdata.id = 21";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '4 Juli 2016', tglakhir = '15 Juli 2016' WHERE rawdata.id = 25";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '29 Juli 2016', tglakhir = '30 Juli 2016' WHERE rawdata.id = 27";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '2 Agustus 2016', tglakhir = '5 Agustus 2016' WHERE rawdata.id = 28";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '8 Agustus 2016', tglakhir = '10 Agustus 2016' WHERE rawdata.id = 30";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '11 Agustus 2016', tglakhir = '18 Agustus 2016' WHERE rawdata.id = 33";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '13 September 2016', tglakhir = '15 September 2016' WHERE rawdata.id = 37";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '10 Oktober 2016', tglakhir = '14 Oktober 2016' WHERE rawdata.id = 40";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '17 Oktober 2016', tglakhir = '10 November 2016' WHERE rawdata.id = 41";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '21 Oktober 2016', tglakhir = '22 Oktober 2016' WHERE rawdata.id = 42";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '5 Desember 2016', tglakhir = '20 Desember 2016' WHERE rawdata.id = 44";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '9 Januari 2017', tglakhir = '12 Januari 2017' WHERE rawdata.id = 47";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '7 Februari 2017', tglakhir = '9 Februari 2017' WHERE rawdata.id = 52";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '6 Maret 2017', tglakhir = '10 Maret 2017' WHERE rawdata.id = 55";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '13 Maret 2017', tglakhir = '6 April 2017' WHERE rawdata.id = 56";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '31 Maret 2017', tglakhir = '1 April 2017' WHERE rawdata.id = 58";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '2 Mei 2017', tglakhir = '17 Mei 2017' WHERE rawdata.id = 61";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '24 Mei 2017', tglakhir = '26 Mei 2017' WHERE rawdata.id = 62";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '29 Mei 2017', tglakhir = '4 Agustus 2017' WHERE rawdata.id = 64";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '19 Juni 2017', tglakhir = '30 Juni 2017' WHERE rawdata.id = 67";
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = '21 Juli 2017', tglakhir = '22 Juli 2017' WHERE rawdata.id = 69";
$query = $bdd->prepare( $sql );
$sth = $query->execute();

//Change month format	
$sql ="UPDATE rawdata SET tglawal = REPLACE(tglawal,'Januari','January')";	
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = REPLACE(tglawal,'Februari','February')";	
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = REPLACE(tglawal,'Maret','March')";	
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = REPLACE(tglawal,'Mei','May')";	
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = REPLACE(tglawal,'Juni','June')";	
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = REPLACE(tglawal,'Juli','July')";	
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = REPLACE(tglawal,'Agustus','August')";	
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = REPLACE(tglawal,'Oktober','October')";	
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglawal = REPLACE(tglawal,'Desember','December')";	
$query = $bdd->prepare( $sql );
$sth = $query->execute();	
$sql ="UPDATE rawdata SET tglakhir = REPLACE(tglakhir,'Januari','January')";	
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglakhir = REPLACE(tglakhir,'Februari','February')";	
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglakhir = REPLACE(tglakhir,'Maret','March')";	
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglakhir = REPLACE(tglakhir,'Mei','May')";	
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglakhir = REPLACE(tglakhir,'Juni','June')";	
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglakhir = REPLACE(tglakhir,'Juli','July')";	
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglakhir = REPLACE(tglakhir,'Agustus','August')";	
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglakhir = REPLACE(tglakhir,'Oktober','October')";	
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglakhir = REPLACE(tglakhir,'Desember','December')";	
$query = $bdd->prepare( $sql );
$sth = $query->execute();

//Set date format
$sql ="UPDATE rawdata SET tglawal = DATE_FORMAT(STR_TO_DATE(tglawal, '%d %M %Y'), '%Y-%m-%d')";	
$query = $bdd->prepare( $sql );
$sth = $query->execute();
$sql ="UPDATE rawdata SET tglakhir = DATE_FORMAT(STR_TO_DATE(tglakhir, '%d %M %Y'), '%Y-%m-%d')";	
$query = $bdd->prepare( $sql );
$sth = $query->execute();


//Import to referred table 'events'
$sql = "INSERT INTO  events(title, start, end) SELECT agenda,tglawal,tglakhir FROM rawdata ";

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
?>
