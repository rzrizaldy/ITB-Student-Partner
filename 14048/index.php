<?php
include_once("includes/const.php");
include_once("includes/language.php");
$scriptname = basename($_SERVER['PHP_SELF']);
include_once("includes/language/".$language."/".$scriptname);

if (isset($_REQUEST["aksi"])) $aksi = $_REQUEST["aksi"];
else $aksi = "";

if (isset($_REQUEST["username"])) $username = trim($_REQUEST["username"]);
else $username = "";
if (isset($_REQUEST["password"])) $password = trim($_REQUEST["password"]);
else $password = "";

$errlog = 0;
if ($aksi=="login") {
	if ($username=="") $errlog = 1;
	if (($password=="") && ($errlog==0)) $errlog = 2;
	if ($errlog==0) {
		if ($username!=$USER_NAME) $errlog = 3;
		if (($password!=$SECURE_PASS) && ($errlog==0)) $errlog = 4;
		if ($errlog==0) {
			//Success login redirect
			session_start();
			$_SESSION['member'] = "ok";
			header("Location: frontpage.php");
			exit();
		}
	}
} elseif ($aksi=="logout") {
	if (!isset($_SESSION)) session_start();
	$_SESSION['member'] = "";
	unset($_SESSION["member"]);
	session_destroy();
}
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
        <link href="./css/mainstyle.css" rel="stylesheet">
<style type="text/css">
#form1 {
    border: 1px #000000 solid;
    padding: 3px;
	margin-top:5px;
    border-radius: 4px;
    box-shadow: 0 0 6px #db7093;
	text-align:center;
}
.vertical-center {
 /* min-height: 100%;   Fallback for browsers do NOT support vh unit 
  min-height: 100vh;*/ /* These two lines are counted as one :-)       */
  display: flex;
  align-items: center;
}
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
<div class="wrapper-utama">
<div class="container-utama">
<div class="vertical-center">
<div class="container">

<form class="form-horizontal" role="form" id="form1" name="form1" method="post" action="<?=$scriptname?>" target=""  >
<table class="table col-sm-12 judul-grad" style="width:100%">
<tr>
<td align="right" width="45%"><img src="images/logo_gcomment.png" class="img-responsive" /></td>
<td align="left" valign="middle" width="55%" >
<h4 style="color:#2f4f4f;text-shadow: 1px 2px #d3d3d3;">
GANESHA SOCIAL MEDIA <br><img src="images/browserr.png" ><br> SEARCH ADVANCE
</h4>
</td>
</tr>
</table>

<div class="clearfix">&nbsp;</div>

<?php
if ($errlog!=0) {
	switch ($errlog) {
		case 1 :
			$info_salah = ERR_1;
			break;
		case 2 :
			$info_salah = ERR_2;
			break;
		case 3 :
			$info_salah = ERR_3;
			break;
		case 4 :
			$info_salah = ERR_4;
			break;
	}
?>
<div class="col-sm-12 alert-danger" style="padding:4px;" align="center">
<label class="label" style="color:#FF0000; font-weight:bold; font-size:12px;"><?=$info_salah?></label>
</div>
<div class="clearfix">&nbsp;</div>
<?php
}
?>

<div class="form-group" style="margin-left:8px; margin-right:8px;">
<div class="col-sm-6" align="center" >
<label class="input-sm" style="margin-bottom:0px;text-align:right;">Username :</label>
</div>
<div class="col-sm-6">
<input id="username" name="username" type="text" class="form-control input-sm"  value="" placeholder="<?=USERNAME_CLUE?>" >
</div>
</div>

<div class="form-group" style="margin-left:8px; margin-right:8px;">
<div class="col-sm-6" align="center" >
<label class="input-sm" style="margin-bottom:0px;text-align:right;">Password :</label>
</div>
<div class="col-sm-6">
<input id="password" name="password" type="password" class="form-control input-sm"  value="" placeholder="<?=PASSWORD_CLUE?>" >
</div>
</div>

<div class="form-group" style="margin-left:8px; margin-right:8px;">
<div class="col-xs-12" align="center">
<button type="submit" class="btn btn-primary">Login</button>
<input type="hidden" id="aksi" name="aksi" value="login">
</div>
</div>

</form>

<div align ="center"> Username: sosmeditb | Password: sosmeditb </div>
<?php
include_once("includes/footer.php");
?>
</div>
</div>
</div>
</div>
</body>
</html>
