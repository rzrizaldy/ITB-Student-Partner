<?php
include_once("includes/logincheck.php");
include_once("includes/language.php");

$scriptname = basename($_SERVER['PHP_SELF']);
include_once("includes/language/".$language."/".$scriptname);

if (file_exists("json/instagram.json"))  {
	$json = json_decode(file_get_contents("json/instagram.json"), true);
	//$simpan = array("iname" => $iname, "ipic" => $ipic, "icomments" => $icomments, "ilink" => $ilink, "idatetime" => $idatetime);
	$old_iname = $json["iname"];
	$old_ipic = $json["ipic"];
	$old_icomments = $json["icomments"];
	$old_ilink = $json["ilink"];
	$old_idatetime = $json["idatetime"];
	unset($json);
} else {
	echo NO_COMMENT_EXIST;
	exit;
}

if (isset($_POST["insta"])) $insta = $_POST["insta"];
else {
	echo NO_COMMENT_CHOOSE;
	exit;
}
$instacomment = $_POST["instacomment"];
$instaname = $_POST["instaname"];
$instapic = $_POST["instapic"];
$instalink = $_POST["instalink"];
$instadatetime = $_POST["instadatetime"];

$iname = array();
$ipic = array();
$icomments = array();
$ilink = array();
$idatetime = array();
foreach ($insta as $i => $value) {
	array_push($iname,$instaname[$value]);
	array_push($ipic,$instapic[$value]);
	array_push($icomments,$instacomment[$value]);
	array_push($ilink,$instalink[$value]);
	array_push($idatetime,$instadatetime[$value]);
}


for ($i=0; $i<count($icomments); $i++) {
	$key = array_search($icomments[$i],$old_icomments);
	if ($key!==false) {
		if ($old_iname[$key]!=$iname[$i]) {
			array_push($old_iname,$iname[$i]);
			array_push($old_ipic,$ipic[$i]);
			array_push($old_icomments,$icomments[$i]);
			array_push($old_ilink,$ilink[$i]);
			array_push($old_idatetime,$idatetime[$i]);
		}
	} else {
		array_push($old_iname,$iname[$i]);
		array_push($old_ipic,$ipic[$i]);
		array_push($old_icomments,$icomments[$i]);
		array_push($old_ilink,$ilink[$i]);
		array_push($old_idatetime,$idatetime[$i]);
	}
}

$simpan = array("iname" => $old_iname, "ipic" => $old_ipic, "icomments" => $old_icomments, "ilink" => $old_ilink, "idatetime" => $old_idatetime);
		
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
<div class="alert-success col-sm-12"><?=SUCCESS_ADD_COMMENT?></div>
<div class="clearfix col-sm-12">&nbsp;</div>
<table class="table table-striped table-hover" >
<?php
$jml = count($old_iname);
$s = "";
for ($i=0; $i<$jml; $i++) {
	$s .= "<tr>\n";
	$s .= "<td>".$old_iname[$i]."<br>";
	$s .= "<a href=\"".$old_ilink[$i]."\" border=\"0\">";
	$s .= "<img src=\"".$old_ipic[$i]."\" border=\"0\">";
	$s .= "</a>";
	$s .= "</td>\n";
	$s .= "<td>".$old_idatetime[$i]."<br>".$old_icomments[$i]."</td>\n";
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