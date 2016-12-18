<?php
include_once("includes/logincheck.php");
include_once("includes/language.php");

$scriptname = basename($_SERVER['PHP_SELF']);

$mydomain = $_SERVER['SERVER_NAME'];
if (!preg_match("/localhost/is",$mydomain)) $dilokal=false;
else $dilokal=true;

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>Ganesha Social Media Search Advance</title>
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
.table-hover tbody tr:hover td {background-color:#FFE3D7;}
.judul-grad {
  background: -webkit-linear-gradient(#ffebcd, #cd5c5c); /* For Safari 5.1 to 6.0 */
  background: -o-linear-gradient(#ffebcd, #cd5c5c); /* For Opera 11.1 to 12.0 */
  background: -moz-linear-gradient(#ffebcd, #cd5c5c); /* For Firefox 3.6 to 15 */
  background: linear-gradient(#ffebcd, #cd5c5c); /* Standard syntax */
} 
</style>
<script language="javascript" src="js/jquery.min.js" type="text/jscript"></script>
<script language="javascript" src="js/bootstrap.min.js" type="text/javascript"></script>
</head>

<body>
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

<div class="col-sm-12" align="center" style="background-color:#a47d51; margin-bottom:4px;">
<h4 style="color:#FFFFFF;"><img src="images/notebook2.png" border="0">&nbsp;CARA PENGGUNAAN</h4>
</div>
<div class="clearfix">&nbsp;</div>
<div align="center" ><b>TWITTER SEARCH</b><br/>
1. Klik menu Twitter Search pada home<br/>
2.
</div>





<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
<?php
include_once("includes/footer.php");
?>

</div>
</body>
</html>