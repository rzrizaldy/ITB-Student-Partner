<?php
include_once("includes/logincheck.php");
include_once("includes/language.php");

$scriptname = basename($_SERVER['PHP_SELF']);
include_once("includes/language/".$language."/".$scriptname);

if (file_exists("json/twitter.json"))  {
	$json = json_decode(file_get_contents("json/twitter.json"), true);
	$old_tname = $json["tname"];
	$old_tpic = $json["tpic"];
	$old_tcomments = $json["tcomments"];
	$old_tlink = $json["tlink"];
	$old_tdatetime = $json["tdatetime"];
	unset($json);
} else {
	echo NO_COMMENT_EXIST;
	exit;
}

if (isset($_POST["tw"])) $tw = $_POST["tw"];
else {
	echo NO_COMMENT_CHOOSE;
	exit;
}
$twits = $_POST["twits"];
$twitname = $_POST["twitname"];
$twitpic = $_POST["twitpic"];
$twitlink = $_POST["twitlink"];
$twitdatetime = $_POST["twitdatetime"];

$tname = array();
$tpic = array();
$tcomments = array();
$tlink = array();
$tdatetime = array();
foreach ($tw as $i => $value) {
	array_push($tname,$twitname[$value]);
	array_push($tpic,$twitpic[$value]);
	//array_push($tcomments,SensorKata($twits[$value]));
	array_push($tcomments,$twits[$value]);
	array_push($tlink,$twitlink[$value]);
	array_push($tdatetime,$twitdatetime[$value]);
}


for ($i=0; $i<count($tcomments); $i++) {
	$key = array_search($tcomments[$i],$old_tcomments);
	if ($key!==false) {
		if ($old_tname[$key]!=$tname[$i]) {
			array_push($old_tname,$tname[$i]);
			array_push($old_tpic,$tpic[$i]);
			array_push($old_tcomments,$tcomments[$i]);
			array_push($old_tlink,$tlink[$i]);
			array_push($old_tdatetime,$tdatetime[$i]);
		}
	} else {
		array_push($old_tname,$tname[$i]);
		array_push($old_tpic,$tpic[$i]);
		array_push($old_tcomments,$tcomments[$i]);
		array_push($old_tlink,$tlink[$i]);
		array_push($old_tdatetime,$tdatetime[$i]);
	}
}

$simpan = array("tname" => $old_tname, "tpic" => $old_tpic, "tcomments" => $old_tcomments, "tlink" => $old_tlink, "tdatetime" => $old_tdatetime);
		
$fp = fopen("json/twitter.json", 'w');
fwrite($fp, json_encode($simpan));
fclose($fp);
unset($simpan);

$fp = fopen("json/reload.txt","w");
fwrite($fp, " ");
fclose($fp);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>Tambah Komentar ke Data Lama</title>
<link rel="shortcut icon" href="images/elephant.png">
<link rel="icon" href="images/elephant.png">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css" />
<style type="text/css">
body {
    padding-top: 0px;
	background-color:#FFFFFF; 
	padding-top:0px;
}
.container {
  width: 99.7%;
  padding:0px;
  overflow-x: hidden;
  overflow-y: hidden;
}
</style>
<script language="javascript" src="js/jquery.min.js" type="text/jscript"></script>
<script language="javascript" src="js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
<div class="container">
<div class="clearfix col-sm-12">&nbsp;</div>
<div class="alert-success col-sm-12"><?=SUCCES_ADD_COMMENT?></div>
<div class="clearfix col-sm-12">&nbsp;</div>
<table class="table table-striped table-hover" >
<?php
$jml = count($old_tname);
$s = "";
for ($i=0; $i<$jml; $i++) {
	$s .= "<tr>\n";
	$s .= "<td>".$old_tname[$i]."<br>";
	$s .= "<a href=\"".$old_tlink[$i]."\" border=\"0\">";
	$s .= "<img src=\"".$old_tpic[$i]."\" width=\"50\" height=\"50\">";
	$s .= "</a>";
	$s .= "</td>\n";
	$s .= "<td>".$old_tdatetime[$i]."<br>".$old_tcomments[$i]."</td>\n";
	$s .= "</tr>\n";
}
echo $s;
unset($s);
?>
</table>
<script language="javascript" type="text/javascript">
setTimeout(function() {
         window.top.close();
       }, 10000);
</script>
</div>
</body>
</html>