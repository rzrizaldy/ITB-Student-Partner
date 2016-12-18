<?php
include_once("includes/logincheck.php");
include_once("includes/language.php");

$scriptname = basename($_SERVER['PHP_SELF']);
include_once("includes/language/".$language."/".$scriptname);

$mydomain = $_SERVER['SERVER_NAME'];
if (!preg_match("/localhost/is",$mydomain)) $dilokal=false;
else $dilokal=true;

?>
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
<div class="container">
<table class="table col-sm-12 judul-grad" style="width:100%">
<tr>
<td align="right" width="45%"><img src="images/logo_gcomment.png" class="img-responsive" /></td>
<td align="left" valign="middle" width="55%" >
<h4 style="color:#2f4f4f;text-shadow: 1px 2px #d3d3d3;">
GANESHA SOCIAL MEDIA <br><img src="images/browserr.png" ><br> SEARCH ADVANCE
</h4>
</td>
</tr>
</tr>
</table>
<div class="clearfix">&nbsp;</div>
<div class="col-sm-12" align="center">
<table id="tbl-menu" class="table-responsive table-striped table-hover" style="width:270px;">
<tr>
<td align="right" valign="top"><img src="images/notebook.png" class="img-responsive" vspace="4" hspace="4"/></td>
<td align="left" nowrap="nowrap" valign="middle" ><a href="instructions.php" class="btn btn-default"><?=BTN_HOW_TO_USE?></a></td>
</tr>
<tr>
<td align="right" valign="top"><img src="images/logo_twitter2.png" class="img-responsive" vspace="4" hspace="4"/></td>
<td align="left" nowrap="nowrap" valign="middle" ><a href="twitter.php" class="btn btn-info"><?=BTN_TWITTER_ADD_COMMENT?></a></td>
</tr>
<tr>
<td align="right" valign="top"><img src="images/logo_instagram2.png" class="img-responsive" vspace="4" hspace="4"/></td>
<td align="left" nowrap="nowrap" valign="middle" ><a href="instagram.php" class="btn btn-danger"><?=BTN_INSTAGRAM_ADD_COMMENT?></a></td>
</tr>
<tr>
<td align="right" valign="top"><img src="images/logo_girl.png" class="img-responsive" vspace="4" hspace="4"/></td>
<td align="left" nowrap="nowrap" valign="middle" ><a href="allcomments.php" class="btn btn-success"><?=BTN_VIEW_ALL_COMMENT?></a></td>
</tr>
<tr>
<td align="right" valign="top"><img src="images/logo_eraser.png" class="img-responsive" vspace="4" hspace="4"/></td>
<td align="left" nowrap="nowrap" valign="middle" ><a href="clearcomments.php" class="btn btn-warning"><?=BTN_CLEAR_ALL_COMMENT?></a></td>
</tr>
<tr>
<td align="right" valign="top"><img src="images/logo_xml2.png" class="img-responsive" vspace="4" hspace="4"/></td>
<td align="left" nowrap="nowrap" valign="middle" ><a href="dataxml.php?jump=Q3JlYXRlZCBieSBTb25ueSAoWE5ZKSBTb2xlbWFu" class="btn btn-default" target="_blank"><?=BTN_VIEW_XML_CODE?></a><br>
<font size="2"><?=XML_DESC_BTN?></td>
</tr>
</table>
</div>
<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
<table class="table col-sm-12 judul-grad" style="width:100%">
<tr>
</tr>
<td align="center" colspan="2">
<form method="post" action="index.php" target=""  >
<button type="submit" class="btn btn-primary">Logout</button>
<input type="hidden" id="aksi" name="aksi" value="logout">
</form>
</td>
</tr>
</table>
<?php
include_once("includes/footer.php");
?>
</div>
</body>
</html>
