<?php
$scriptname = basename($_SERVER['PHP_SELF']);

if (!file_exists("includes/const.php")) {
	echo "Letakkan '".$scriptname."' di root folder Ganesha Sosmed Search Advance Web Application";
	exit;
}

if (isset($_REQUEST["aksi"])) $aksi = $_REQUEST["aksi"];
else $aksi = "";

$errlog = 0;

if ($aksi=="Save") {
	if (isset($_REQUEST["username"])) $username = trim($_REQUEST["username"]);
	else $username = "";
	
	if (isset($_REQUEST["password"])) $password = trim($_REQUEST["password"]);
	else $password = "";
	
	if ($username=="" || $password=="") $errlog = 1;
	
	if ($errlog==0) {
		if (isset($_REQUEST["woeid"])) $woeid = $_REQUEST["woeid"];
		else $woeid = "1";
		
		if (file_exists("json/trends.json")) unlink("json/trends.json");
		
		if (isset($_REQUEST["twit_consumer_key"])) $twit_consumer_key = $_REQUEST["twit_consumer_key"];
		else $twit_consumer_key = "replace this";
		if (isset($_REQUEST["twit_consumer_secret"])) $twit_consumer_secret = $_REQUEST["twit_consumer_secret"];
		else $twit_consumer_secret = "replace this";
		if (isset($_REQUEST["twit_access_token"])) $twit_access_token = $_REQUEST["twit_access_token"];
		else $twit_access_token = "replace this";
		if (isset($_REQUEST["twit_access_token_secret"])) $twit_access_token_secret = $_REQUEST["twit_access_token_secret"];
		else $twit_access_token_secret = "replace this";
		
		if (isset($_REQUEST["insta_client_id"])) $insta_client_id = $_REQUEST["insta_client_id"];
		else $insta_client_id = "replace this";
		if (isset($_REQUEST["insta_client_secret"])) $insta_client_secret = $_REQUEST["insta_client_secret"];
		else $insta_client_secret = "replace this";
		if (isset($_REQUEST["insta_access_token"])) $insta_access_token = $_REQUEST["insta_access_token"];
		else $insta_access_token = "replace this";
		
		if (isset($_REQUEST["fb_client_id"])) $fb_client_id = $_REQUEST["fb_client_id"];
		else $fb_client_id = "replace this";
		if (isset($_REQUEST["fb_client_secret"])) $fb_client_secret = $_REQUEST["fb_client_secret"];
		else $fb_client_secret = "replace this";
		if (isset($_REQUEST["fb_auth_endpoint"])) $fb_auth_endpoint = $_REQUEST["fb_auth_endpoint"];
		else $fb_auth_endpoint = "https://graph.facebook.com/oauth/authorize";
		if (isset($_REQUEST["fb_token_endpoint"])) $fb_token_endpoint = $_REQUEST["fb_token_endpoint"];
		else $fb_token_endpoint = "https://graph.facebook.com/oauth/access_token";
		if (isset($_REQUEST["fb_domain_name"])) $fb_domain_name = $_REQUEST["fb_domain_name"];
		else $fb_domain_name = "http://yourdomain.com/livecomment";
		if (isset($_REQUEST["fb_def_timeline"])) $fb_def_timeline = $_REQUEST["fb_def_timeline"];
		else $fb_def_timeline = "";
		if (isset($_REQUEST["f_count"])) $f_count = $_REQUEST["f_count"];
		else $f_count = 15;
		
		$fp = fopen("includes/const.php","w");
		fwrite($fp,"<?php".PHP_EOL);
		fwrite($fp,"$"."USER_NAME = \"".$username."\";".PHP_EOL);
		fwrite($fp,"$"."SECURE_PASS = \"".$password."\";".PHP_EOL.PHP_EOL);
		
		fwrite($fp,"//TWITTER KEY & TOKEN SECRET".PHP_EOL);
		fwrite($fp,"const CONSUMER_KEY = \"".$twit_consumer_key."\";".PHP_EOL);
		fwrite($fp,"const CONSUMER_SECRET = \"".$twit_consumer_secret."\";".PHP_EOL);
		fwrite($fp,"const ACCESS_TOKEN = \"".$twit_access_token."\";".PHP_EOL);
		fwrite($fp,"const ACCESS_TOKEN_SECRET = \"".$twit_access_token_secret."\";".PHP_EOL);
		fwrite($fp,"const TRENDING_LOCATION_ID = ".$woeid.";".PHP_EOL.PHP_EOL);
		
		
		fwrite($fp,"//INSTAGRAM ID SECRET".PHP_EOL);
		fwrite($fp,"const INSTA_CLIENT_ID = \"".$insta_client_id."\";".PHP_EOL);
		fwrite($fp,"const INSTA_CLIENT_SECRET = \"".$insta_client_secret."\";".PHP_EOL);
		fwrite($fp,"const INSTA_ACCESS_TOKEN = \"".$insta_access_token."\";".PHP_EOL.PHP_EOL);
		
		
		fwrite($fp,"//Facebook ID Secret".PHP_EOL);
		fwrite($fp,"const CLIENT_ID = \"".$fb_client_id."\";".PHP_EOL);
		fwrite($fp,"const CLIENT_SECRET = \"".$fb_client_secret."\";".PHP_EOL);
		fwrite($fp,"const AUTHORIZATION_ENDPOINT = \"".$fb_auth_endpoint."\";".PHP_EOL);
		fwrite($fp,"const TOKEN_ENDPOINT = \"".$fb_token_endpoint."\";".PHP_EOL);
		fwrite($fp,"const DOMAIN_NAME_FACEBOOK = \"".$fb_domain_name."\";".PHP_EOL.PHP_EOL);
		
		
		fwrite($fp,"//Facebook User Timeline Page".PHP_EOL);
		fwrite($fp,"const DEFAULT_FACEBOOK_USER_TIMELINE = \"".$fb_def_timeline."\";".PHP_EOL);
		fwrite($fp,"const DEFAULT_FEEDS_COUNT = ".$f_count.";".PHP_EOL.PHP_EOL);
		
		fwrite($fp,"?>".PHP_EOL);
		fclose($fp);
		
		$errlog = 2;
	}
}

include_once("includes/const.php");

//http://zourbuth.com/tools/woeid/
//http://woeid.rosselliot.co.nz/
$negara = array("World",
"Argentina","&#8212;&#8250; Argentina (Buenos Aires)",
"Australia","&#8212;&#8250; Australia (Canberra)",
"Austria","&#8212;&#8250; Austria (Vienna)",
"Bahrain",
"Belarus","&#8212;&#8250; Belarus (Minsk)",
"Belgium",
"Brazil","&#8212;&#8250; Brazil (Brasilia)",
"Canada","&#8212;&#8250; Canada (Ottawa)",
"Denmark",
"Egypt","&#8212;&#8250; Egypt (Kairo)",
"France","&#8212;&#8250; France (Paris)",
"Germany","&#8212;&#8250; Germany (Berlin)",
"Greece","&#8212;&#8250; Greece (Athens)",
"India",
"Indonesia","&#8212;&#8250; Indonesia (Jakarta)","&#8212;&#8250; Indonesia (Bandung)","&#8212;&#8250; Indonesia (Semarang)","&#8212;&#8250; Indonesia (Surabaya)",
"Ireland","&#8212;&#8250; Ireland (Dublin)",
"Italy","&#8212;&#8250; Italy (Rome)","&#8212;&#8250; Italy (Milan)",
"Japan","&#8212;&#8250; Japan (Tokyo)","&#8212;&#8250; Japan (Kyoto)","&#8212;&#8250; Japan (Osaka)",
"Kuwait",
"Malaysia","&#8212;&#8250; Malaysia (Kuala Lumpur)",
"Mexico","&#8212;&#8250; Mexico (Mexico City)",
"Netherlands","&#8212;&#8250; Netherlands (Amsterdam)",
"New Zealand",
"Norway","&#8212;&#8250; Norway (Oslo)",
"Pakistan",
"Panama",
"Peru","&#8212;&#8250; Peru (Lima)",
"Philippines","&#8212;&#8250; Philippines (Manila)",
"Poland","&#8212;&#8250; Poland (Warsaw)",
"Portugal",
"Qatar",
"Russia","&#8212;&#8250; Rusia (Moscow)","&#8212;&#8250; Rusia (Saint Petersburg)",
"Saudi Arabia","&#8212;&#8250; Saudi Arabia (Riyadh)",
"Singapore",
"South Africa",
"South Korea","&#8212;&#8250; South Korea (Seoul)",
"Spain", "&#8212;&#8250; Spain (Madrid)",
"Sweden","&#8212;&#8250; Sweden (Stockholm)","&#8212;&#8250; Sweden (Gothenburg)",
"Switzerland",
"Thailand","&#8212;&#8250; Thailand (Bangkok)",
"Turkey","&#8212;&#8250; Turkey (Ankara)",
"Ukraine","&#8212;&#8250; Ukraine (Kiev)",
"United Arab Emirates","&#8212;&#8250; United Arab Emirates (Abu Dabhi)",
"United Kingdom","&#8212;&#8250; United Kingdom (London)","&#8212;&#8250; United Kingdom (Manchester)","&#8212;&#8250; United Kingdom (Liverpool)",
"United States of America","&#8212;&#8250; USA (New York)","&#8212;&#8250; USA (Las Vegas)","&#8212;&#8250; USA (Los Angeles)","&#8212;&#8250; USA (New Orleans)","&#8212;&#8250; USA (Honolulu Hawaii)",
"Venezuela","&#8212;&#8250; Venezuela (Caracas)");

$woid = array(1,
23424747,468739,
23424748,1100968,
23424750,551801,
23424753,
23424765,834463,
23424757,
23424768,455819,
23424775,91982014,
23424796,
23424802,1521894,
23424819,615702,
23424829,638242,
23424833,946738,
23424848,
23424846,1047378,1047180,1048324,1044316,


23424803,560743,
23424853,721943,718345,
23424856,1118370,15015372,15015370,
23424870,
23424901,1154781,
23424900,116545,
23424909,727232,
23424916,
23424910,862592,
23424922,
23424924,
23424919,418440,
23424934,1199477,
23424923,523920,
23424925,
23424930,
23424936,2122265,2123260,
23424938,1939753,
23424948,
23424942,
23424868,1132599,
23424950,766273,
23424954,906057,890869,
23424957,
23424960,1225448,
23424969,2343732,
23424976,924938,
23424738,1940330,
23424975,44418,28218,26734,
23424977,2459115,2436704,2442047,2458833,2423945,
23424982,395269);

if (defined("TRENDING_LOCATION_ID")) {
	if (TRENDING_LOCATION_ID>0) $idx_woid = array_search(TRENDING_LOCATION_ID,$woid);
	else $idx_woid = 0;
}

$facebook_count = array(15,30,45,50);


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>Configuration Set-Up</title>
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
  border:none;
}
</style>
<script language="javascript" src="js/jquery.min.js" type="text/jscript"></script>
<script language="javascript" src="js/bootstrap.min.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function() {
	$("#showpass").on("change",function() {
		if (!this.checked) $("#password").attr("type","password");
		else $("#password").attr("type","text");
	});
	
	function blink(selector){
	$(selector).fadeOut('slow', function(){
		$(this).fadeIn('slow', function(){
			blink(this);
		});
	});
	}
	
	blink('.blink');
});
</script>
</head>
<body>
<div class="container">
<form class="form-horizontal" role="form" id="form1" name="form1" method="post" action="<?=$scriptname?>" target=""  >
<table class="table col-sm-12 judul-grad" style="width:100%">
<tr>
<td align="right" width="45%"><img src="images/logo_gcomment.png" class="img-responsive" /></td>
<td align="left" valign="middle" width="55%" >
<h4 style="color:#2f4f4f;text-shadow: 1px 2px #d3d3d3;">
GANESHA SOCIAL MEDIA <br><img src="images/browserr.png" ><br> SEARCH ADVANCE CONFIGURATION
</h4>
</td>
</tr>
</table>

<?php if ($errlog>0) { ?>
<div id="hasilsave" class="col-sm-12">
<div class="clearfix col-sm-12">&nbsp;</div>
<?php 
switch ($errlog) {
	case 1 :
		echo "<div class=\"col-sm-12 alert-danger\" align=\"center\">Username &amp; Password tidak boleh kosong</div>";
		break;
	case 2 :
		echo "<div class=\"col-sm-12 alert-success\" align=\"center\">Sukses menyimpan data ke '<b>includes/const.php</b>'</div>";
		break;
}
?>
<div class="clearfix col-sm-12">&nbsp;</div>
<script language="javascript" type="text/javascript">
setTimeout(function() {
         $("#hasilsave").remove();
       }, 3500);
</script>
</div>
<div class="clearfix col-sm-12">&nbsp;</div>
<div class="col-sm-12" align="center"><b class="blink" style="color:#FF0000">PENTING :</b> Segera hapus atau pindahkan file &quot;<b><?=$scriptname?></b>&quot; dari root folder ini jika semua telah di set up!!!</div>
<div class="clearfix col-sm-12">&nbsp;</div>
<?php } ?>

<div class="clearfix col-sm-12">&nbsp;</div>
<div class="col-sm-12 alert-warning"><b>User Account GANESHA SOSMED SEARCH ADVANCE</b> SETUP</div>
<div class="clearfix col-sm-12">&nbsp;</div>

<div class="form-group" style="margin-left:8px; margin-right:8px;">
<div class="col-sm-6" align="right" >
<label class="input-sm" style="margin-bottom:0px;text-align:right;">USER NAME LOGIN :</label>
</div>
<div class="col-sm-6">
<input id="username" name="username" type="text" class="form-control input-sm"  value="<?=$USER_NAME?>" placeholder="type an unique username" >
</div>
</div>

<div class="form-group" style="margin-left:8px; margin-right:8px;">
<div class="col-sm-6" align="right" >
<label class="input-sm" style="margin-bottom:0px;text-align:right;">PASSWORD LOGIN :</label>
</div>
<div class="col-sm-6">
<input id="password" name="password" type="password" class="form-control input-sm"  value="<?=$SECURE_PASS?>" placeholder="type an unique password" ><br>
<input type="checkbox" id="showpass" name="showpass" value="">&nbsp;Show Password text
</div>
</div>

<div class="col-sm-12" style="border-top:3px solid #faf3d1;">&nbsp;</div>


<div class="clearfix col-sm-12">&nbsp;</div>
<div class="col-sm-12" style="padding:4px; background-color:#66CCFF;"><img src="images/twitter2.png"  /> <b>TWITTER TOOLS</b> SETUP&nbsp;&nbsp;(<a href="https://www.slickremix.com/docs/how-to-get-api-keys-and-tokens-for-twitter/" target="_blank">How to create Twitter Credential</a> ??)</div>
<div class="clearfix col-sm-12">&nbsp;</div>

<div class="form-group" style="margin-left:8px; margin-right:8px;" >
<div class="col-sm-6" align="right" >
<label class="input-sm" style="margin-bottom:0px;text-align:right;">Your TRENDING TOPIC Location :</label>
</div>
<div class="col-sm-6">
<select class="form-control" name="woeid" id="woeid" style="margin-top:-3px;" style="display: none;" >
<?php
for ($i=0; $i<count($negara); $i++) {
	echo "<option value=\"".$woid[$i]."\" ";
	if ($i==$idx_woid) echo " selected=\"selected\"";
	echo ">".$negara[$i];
	echo "</option>\n";
}
?>
</select>
{note : Kamu bisa menyesuaikan lokasi Trending Topic berdasarkan kota di negaramu dengan menggunakan <a href="http://woeid.rosselliot.co.nz/" target="_blank">this tools</a>, copy &amp; paste WOEID number ke TRENDING_LOCATION_ID pada file &quot;includes/const.php&quot;}
</div>
</div>

<div class="form-group" style="margin-left:8px; margin-right:8px;">
<div class="col-sm-6" align="right" >
<label class="input-sm" style="margin-bottom:0px;text-align:right;">Twitter CONSUMER KEY :</label>
</div>
<div class="col-sm-6">
<input id="twit_consumer_key" name="twit_consumer_key" type="text" class="form-control input-sm"  value="<?=CONSUMER_KEY?>" placeholder="type an unique key" >
</div>
</div>

<div class="form-group" style="margin-left:8px; margin-right:8px;">
<div class="col-sm-6" align="right" >
<label class="input-sm" style="margin-bottom:0px;text-align:right;">Twitter CONSUMER SECRET :</label>
</div>
<div class="col-sm-6">
<input id="twit_consumer_secret" name="twit_consumer_secret" type="text" class="form-control input-sm"  value="<?=CONSUMER_SECRET?>" placeholder="type an unique secret key" >
</div>
</div>

<div class="form-group" style="margin-left:8px; margin-right:8px;">
<div class="col-sm-6" align="right" >
<label class="input-sm" style="margin-bottom:0px;text-align:right;">Twitter ACCESS TOKEN :</label>
</div>
<div class="col-sm-6">
<input id="twit_access_token" name="twit_access_token" type="text" class="form-control input-sm"  value="<?=ACCESS_TOKEN?>" placeholder="type an unique access token" >
</div>
</div>

<div class="form-group" style="margin-left:8px; margin-right:8px;">
<div class="col-sm-6" align="right" >
<label class="input-sm" style="margin-bottom:0px;text-align:right;">Twitter ACCESS TOKEN SECRET :</label>
</div>
<div class="col-sm-6">
<input id="twit_access_token_secret" name="twit_access_token_secret" type="text" class="form-control input-sm"  value="<?=ACCESS_TOKEN_SECRET?>" placeholder="type an unique access token secret" >
</div>
</div>



<div class="col-sm-12" style="border-top:3px solid #96c3d9;">&nbsp;</div>

<div class="clearfix col-sm-12">&nbsp;</div>

<div class="form-group" style="margin-left:8px; margin-right:8px;">
<div class="col-xs-12" align="center">
<button type="submit" class="btn btn-primary">SIMPAN</button>
<input type="hidden" id="aksi" name="aksi" value="Save">
</div>
</div>

</form>
</div>
</body>
</html>