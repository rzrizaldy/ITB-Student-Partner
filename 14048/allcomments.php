<?php
include_once("includes/logincheck.php");
include_once("includes/language.php");
$scriptname = basename($_SERVER['PHP_SELF']);

$cek_twit = file_exists("json/twitter.json");
$cek_insta = file_exists("json/instagram.json");


if ($cek_twit==true)  {
	//$simpan = array("tname" => $tname, "tpic" => $tpic, "ttwit" => $ttwit);
	$json = json_decode(file_get_contents("json/twitter.json"), true);
	$tname = $json["tname"];
	$tpic = $json["tpic"];
	$tcomments = $json["tcomments"];
	$tlink = $json["tlink"];
	$tdatetime = $json["tdatetime"];
	unset($json);
}

if ($cek_insta==true)  {
	//$simpan = array("iname" => $iname, "ipic" => $ipic, "icomments" => $icomments, "ilink" => $ilink, "idatetime" => $idatetime);
	$json = json_decode(file_get_contents("json/instagram.json"), true);
	$iname = $json["iname"];
	$ipic = $json["ipic"];
	$icomments = $json["icomments"];
	$ilink = $json["ilink"];
	$idatetime = $json["idatetime"];
	unset($json);
}

//Language declare variable
include_once("includes/language/".$language."/".$scriptname);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>All Comments</title>
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
.judul-grad {
  background: -webkit-linear-gradient(#ffebcd, #cd5c5c); /* For Safari 5.1 to 6.0 */
  background: -o-linear-gradient(#ffebcd, #cd5c5c); /* For Opera 11.1 to 12.0 */
  background: -moz-linear-gradient(#ffebcd, #cd5c5c); /* For Firefox 3.6 to 15 */
  background: linear-gradient(#ffebcd, #cd5c5c); /* Standard syntax */
}
.lnk-button {
	display: block;
	width: 170px;
	height: 40px;
	background: #3b5998;
	padding: 10px;
	text-align: center;
	border-radius: 5px;
	color: white;
	font-weight: bold; 
	cursor:pointer;
}

.lnk-button:visited {text-decoration:none; color:#FFFFFF; background:#3b5998;}
.lnk-button:hover {text-decoration:underline; color:#FFFFFF; background: #3b5998;}
</style>
<script language="javascript" src="js/jquery.min.js" type="text/jscript"></script>
<script language="javascript" src="js/bootstrap.min.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function() {
	$("#goTop").click(function () {
		$("html, body").animate({ scrollTop: 0 }, "slow");
	});
});
</script>
</head>

<body>
<div class="container">

<table class="table table-responsive col-sm-12 judul-grad" style="width:100%; border:none;">
<tr>
<td align="right" width="45%"><img src="images/logo_gcomment.png" class="img-responsive" /></td>
<td align="left" valign="middle" width="55%" >
<h4 style="color:#2f4f4f;text-shadow: 1px 2px #d3d3d3;">
GANESHA SOCIAL MEDIA <br><img src="images/browserr.png" ><br> SEARCH ADVANCE
</h4>
</td>
</tr>
<tr>
<td align="center"><a href="frontpage.php" class="btn btn-primary">Home</a></td>
<td align="center">
<form method="post" action="index.php" target=""  >
<button type="submit" class="btn btn-primary">Logout</button>
<input type="hidden" id="aksi" name="aksi" value="logout">
</form>
</td>
</tr>
</table>

<?php
if ($cek_twit==true)  {
?>
<div class="clearfix col-sm-12">&nbsp;</div>
<div class="alert-success col-sm-12" style="padding:4px;"><img src="images/twitter2.png"  /> <?=VIEW_TWITTER_COMMENTS?></div>
<div class="clearfix col-sm-12">&nbsp;</div>
<table class="table table-striped table-hover" >
<?php
$jml = count($tname);
$s = "";
for ($i=0; $i<$jml; $i++) {
	$s .= "<tr>\n";
	$s .= "<td  width=\"30%\" align=\"center\" >".$tname[$i]."<br>";
	$s .= "<a href=\"".$tlink[$i]."\" border=\"0\">";
	$s .= "<img src=\"".$tpic[$i]."\" class=\"img-responsive\" width=\"60\" height=\"60\">";
	$s .= "</a>";
	$s .= "</td  width=\"70%\">\n";
	$s .= "<td><img src=\"images/twitter2.png\">&nbsp;".$tdatetime[$i]."<br>".$tcomments[$i]."</td>\n";
	$s .= "</tr>\n";
}
echo $s;
unset($s);
?>
</table>
<?php
}
if ($cek_insta==true) {
?>
<div class="clearfix col-sm-12">&nbsp;</div>
<div class="alert-danger col-sm-12" style="padding:4px;"><img src="images/instagram3.png"  /> <?=VIEW_INSTAGRAM_COMMENTS?></div>
<div class="clearfix col-sm-12">&nbsp;</div>
<table class="table table-striped table-hover" style="width:100%!important;" >
<?php
$jml = count($iname);
$s = "";
for ($i=0; $i<$jml; $i++) {
	$s .= "<tr>\n";
	$s .= "<td width=\"30%\"align=\"center\" >".$iname[$i]."<br>";
	$s .= "<a href=\"".$ilink[$i]."\" border=\"0\">";
	$s .= "<img src=\"".$ipic[$i]."\" class=\"img-responsive\" width=\"60\" height=\"60\">";
	$s .= "</a>";
	$s .= "</td>\n";
	$s .= "<td width=\"70%\"><img src=\"images/instagram3.png\">&nbsp;".$idatetime[$i]."<br>".$icomments[$i]."</td>\n";
	$s .= "</tr>\n";
}
echo $s;
unset($s);
?>
</table>


<?php
}
if (($cek_twit==false) && ($cek_insta==false)) {
	echo "<div class=\"alert-danger col-sm-12\" style=\"padding:4px;\" align=\"center\">";
	echo "<b>".COMMENTS_NOT_FOUND."</b>";
	echo "</div>\n";
?>
<script language="javascript" type="text/javascript">
setTimeout(function() {
         window.location = "frontpage.php";
       }, 10000);
</script>
<?php
}
?>
<div class="clearfix">&nbsp;</div>
<div class="clearfix col-sm-12" align="center" style="border-top:1px dashed #333333;">
<div class="clearfix">&nbsp;</div>
<div class="col-sm-6 col-xs-6" align="left"><a href="frontpage.php" class="btn btn-primary">Home</a></div>
<div class="col-sm-6 col-xs-6" align="right"><label id="goTop" class="lnk-button" style="height:auto!important;"><?=BTN_SCROLL_UP?><br></label></div>
<div class="clearfix">&nbsp;</div>

<?php
include_once("includes/footer.php");
?>

</div>
</body>
</html>
