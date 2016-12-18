<?php
include_once("includes/logincheck.php");
include_once("includes/language.php");

$scriptname = basename($_SERVER['PHP_SELF']);
include_once("includes/language/".$language."/".$scriptname);

if (isset($_POST["tw"])) $tw = $_POST["tw"];
else {
	echo NO_TWEET_CHOOSE;
	exit;
}
//$tw = array_keys($tw);  //Ambil Index array saja;

$twits = $_POST["twits"];
$twitname = $_POST["twitname"];
$twitpic = $_POST["twitpic"];
$twitlink = $_POST["twitlink"];
$twitdatetime = $_POST["twitdatetime"];

//function SensorKata($mytext) {
//	include("word_cencors.php");
//	foreach ($censors as $word) {
//		if (preg_match("/".$word."/is",$mytext)) {
//			$wtext = strlen($word);
//			$pengganti = substr($word,0,1);
//			$pengganti .= str_repeat("*",($wtext-2));
//			$pengganti .= substr($word,($wtext - 1), 1);
//			$mytext = preg_replace("/".$word."/is",$pengganti,$mytext);
//		}
//	}
//	return $mytext;
//}

$tname = array();
$tpic = array();
$tcomments = array();
$tlink = array();
$tdatetime = array();
foreach ($tw as $i => $value) {
	array_push($tname,$twitname[$value]);
	array_push($tpic,$twitpic[$value]);
	array_push($tcomments,$twits[$value]);
	array_push($tlink,$twitlink[$value]);
	array_push($tdatetime,$twitdatetime[$value]);
}

$simpan = array("tname" => $tname, "tpic" => $tpic, "tcomments" => $tcomments, "tlink" => $tlink, "tdatetime" => $tdatetime);
		
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
<title>Komentar Yang Dipilih</title>
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
<div class="alert-success col-sm-12"><?=SUCCES_NEW_COMMENT_ADD?></div>
<div class="clearfix col-sm-12">&nbsp;</div>
<table class="table table-striped table-hover" >
<?php
$jml = count($tname);
$s = "";
for ($i=0; $i<$jml; $i++) {
	$s .= "<tr>\n";
	$s .= "<td>".$tname[$i]."<br>";
	$s .= "<a href=\"".$tlink[$i]."\" border=\"0\">";
	$s .= "<img src=\"".$tpic[$i]."\" width=\"50\" height=\"50\">";
	$s .= "</a>";
	$s .= "</td>\n";
	$s .= "<td>".$tdatetime[$i]."<br>".$tcomments[$i]."</td>\n";
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
