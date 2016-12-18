<?php
include_once("includes/logincheck.php");
include_once("includes/language.php");

$scriptname = basename($_SERVER['PHP_SELF']);
include_once("includes/language/".$language."/".$scriptname);

if (isset($_POST["insta"])) $insta = $_POST["insta"];
else {
	echo NO_COMMENT_CHOOSE;
	exit;
}
//$tw = array_keys($tw);  //Ambil Index array saja;

$instacomment = $_POST["instacomment"];
$instaname = $_POST["instaname"];
$instapic = $_POST["instapic"];
$instalink = $_POST["instalink"];
$instadatetime = $_POST["instadatetime"];

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

$iname = array();
$ipic = array();
$icomments = array();
$ilink = array();
$idatetime = array();
foreach ($insta as $i => $value) {
	array_push($iname,$instaname[$value]);
	array_push($ipic,$instapic[$value]);
	//array_push($icomments,SensorKata($twits[$value]));
	array_push($icomments,$instacomment[$value]);
	array_push($ilink,$instalink[$value]);
	array_push($idatetime,$instadatetime[$value]);
}

$simpan = array("iname" => $iname, "ipic" => $ipic, "icomments" => $icomments, "ilink" => $ilink, "idatetime" => $idatetime);
		
$fp = fopen("json/instagram.json", 'w');
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
<div class="alert-success col-sm-12"><?=SUCCES_ADD_NEW_COMMENT?></div>
<div class="clearfix col-sm-12">&nbsp;</div>
<table class="table table-striped table-hover" >
<?php
$jml = count($iname);
$s = "";
for ($i=0; $i<$jml; $i++) {
	$s .= "<tr>\n";
	$s .= "<td>".$iname[$i]."<br>";
	$s .= "<a href=\"".$ilink[$i]."\" border=\"0\">";
	$s .= "<img src=\"".$ipic[$i]."\" >";
	$s .= "</a>";
	$s .= "</td>\n";
	$s .= "<td>".$idatetime[$i]."<br>".$icomments[$i]."</td>\n";
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
