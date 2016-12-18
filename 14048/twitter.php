<?php
include_once("includes/logincheck.php");
include_once("includes/language.php");

$scriptname = basename($_SERVER['PHP_SELF']);

//Language declare variable
include_once("includes/language/".$language."/".$scriptname);

require_once "includes/twitteroauth.php";
require_once "includes/const.php";
include_once("includes/trendcache.php");

if (isset($_REQUEST["aksi"])) $aksi = $_REQUEST["aksi"];
else $aksi = "";

if (isset($_REQUEST["subject"])) $subject = trim($_REQUEST["subject"]);
else $subject = "";

if (isset($_REQUEST["topik"])) $topik = trim($_REQUEST["topik"]);
else $topik = "";

if (isset($_REQUEST["sub_value"])) $sub_value = trim($_REQUEST["sub_value"]);
else $sub_value = "";

if (isset($_REQUEST["hashtag_keep"])) $hashtag_keep = trim($_REQUEST["hashtag_keep"]);
else $hashtag_keep = "";

if (isset($_REQUEST["mention_keep"])) $mention_keep = trim($_REQUEST["mention_keep"]);
else $mention_keep = "";

if (isset($_REQUEST["result_type"])) $result_type = intval($_REQUEST["result_type"]);
else $result_type = 0;

if (isset($_REQUEST["t_count"])) $t_count = intval($_REQUEST["t_count"]);
else $t_count = 15;

if (isset($_REQUEST["ftarget"])) $my_target = intval($_REQUEST["ftarget"]);
else $my_target = 0;

if (isset($_POST["checkRT"])) $checkRT = "checked";
else $checkRT = "";

$list_subject = array("trending|".SUBJECT_1,"hashtag|".SUBJECT_2,"from_user|".SUBJECT_3,"to_user|".SUBJECT_4,"words|".SUBJECT_5);
$list_result = array("Newest","Popular");
$list_count = array(15,30,45,60,75,90,100);

function url_exists($url) {
	$fp = curl_init($url);
    if (!$fp) return false;
    else {
		curl_close($fp);
		return true;
	}
}


$errlog = 0;

if ($aksi=="Search") {
	
	if ( ($subject=="trending" && $topik!="") || ($subject!="trending" && $sub_value!="") ) {
	 
		if (!isset($toa)) $toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
		
		if ($result_type==0) {
			if ($subject=="trending") {
				$query = array("q" => $topik, "result_type" => "recent", "count" => $t_count);
			} elseif ($subject=="hashtag") {
				$query = array("q" => "#".$sub_value, "result_type" => "recent", "count" => $t_count);
			} elseif ($subject=="from_user") {
				$query = array("q" => "from:".$sub_value, "result_type" => "recent", "count" => $t_count);
			} elseif ($subject=="to_user") {
				$query = array("q" => "to:".$sub_value, "result_type" => "recent", "count" => $t_count);
			} elseif ($subject=="words") {
				$query = array("q" => $sub_value, "result_type" => "recent", "count" => $t_count);
			}
		} else {
			if ($subject=="trending") {

				$query = array("q" => $topik, "result_type" => "popular", "count" => $t_count);
			} elseif ($subject=="hashtag") {
				$query = array("q" => "#".$sub_value, "result_type" => "popular", "count" => $t_count);
			} elseif ($subject=="from_user") {
				$query = array("q" => "from:".$sub_value, "result_type" => "popular", "count" => $t_count);
			} elseif ($subject=="to_user") {
				$query = array("q" => "to:".$sub_value, "result_type" => "popular", "count" => $t_count);
			} elseif ($subject=="words") {
				$query = array("q" => $sub_value, "result_type" => "popular", "count" => $t_count);
			}	
		}
		 
		$twits = $toa->get('search/tweets', $query);
		 if (isset($twits)) {
			$errlog = 1;
	//		print_r($twits);
	//		exit;
		 } else $errlog = 2;
	 
	}
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>Twitter Search Tool</title>
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
.table-hover tbody tr:hover td {background-color:#FFE3D7;}
#subject {font-weight:bold; text-align:right}
#form1 {
    border: 1px #000000 solid;
    padding: 3px;
	margin-top:5px;
    border-radius: 4px;
    box-shadow: 0 0 6px #db7093;
	text-align:center;
    }
#form2 {
    border: 1px #000000 solid;
    padding: 3px;
    border-radius: 4px;
    box-shadow: 0 0 6px #db7093 ;
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
#tblhasil {table-layout:fixed;}

</style>
<script language="javascript" src="js/jquery.min.js" type="text/jscript"></script>
<script language="javascript" src="js/bootstrap.min.js" type="text/javascript"></script>
<script language="javascript">
$(document).ready( function () {

<?php
if ($subject=="trending" || $subject=="") {
?>
	$("#sub_value").hide();
<?php } else { ?>
	$("#topik").hide();
<?php } ?>
<?php
if ($subject=="" && $hashtag_keep=="") {
?>
	var topik = $("#topik").val();
	if (topik.indexOf('#') > -1) $("#hashtag_keep").attr("value",topik);
	else $("#hashtag_keep").attr("value","");
<?php } ?>

	$('.hasTooltip').tooltip();
	$('.hasTooltip').mouseenter(function(){
		var that = $(this);
		that.tooltip('show');
		setTimeout(function(){
			that.tooltip('hide');
		}, 2000);
	});
	$('.hasTooltip').mouseleave(function(){
		$(this).tooltip('hide');
	});

	$("#tblhasil tr").click(function() {
		var cstat = $(this).find('[type=checkbox]');
		cstat.click();
    });

	$('#subject').on('change', function() {
		var clue = ["", "<?=HASHTAG_SEARCHING_CLUE?>", "<?=USER_SEARCHING_CLUE?>","<?=USER_SEARCHING_CLUE?>","<?=WORD_SEARCHING_CLUE?>"];
		var subject_idx = $("#subject").prop('selectedIndex');
		$("#sub_value").attr("placeholder",clue[subject_idx]);
		var subj = $(this).val();
		if (subj=="trending") {
			$("#topik").show();
			$("#sub_value").hide();
			var topik = $("#topik").val();
			if (topik.indexOf('#') > -1) $("#hashtag_keep").attr("value",topik);
			else $("#hashtag_keep").attr("value","");
		} else {
			$("#topik").hide();
			$("#sub_value").show();
			$("#hashtag_keep").attr("value","");
		}
	});
	
	$("#topik").on('change', function() {
		var topik = $(this).val();
		if (topik.indexOf('#') > -1) $("#hashtag_keep").attr("value",topik);
		else $("#hashtag_keep").attr("value","");
	});
	
	$('#mytujuan').on('change', function() {
		var tujuan = $(this).val();
		$("#form2").attr("action",tujuan);
		if (tujuan=="pilihan.php") {
			$("#form2").attr("target","_self");
		} else $("#form2").attr("target","_blank");
	});

	$('#checkAll').click(function () {    
		$('input:checkbox').prop('checked', this.checked);
		if (!this.checked) $('#tblhasil tr').removeClass("success");
		else $('#tblhasil tr').addClass("success");
	});
	
	$('#tblhasil input:checkbox').change(function() {
       	if(this.checked)  {
		  $(this).closest('tr').addClass('success');
    	} else $(this).closest('tr').removeClass('success');
	});
	
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

<form class="form-horizontal" role="form" id="form1" name="form1" method="post" action="<?=$scriptname?>#twittersearch" target=""  >
<div class="col-sm-12" align="center" style="background-color:#66CCFF; margin-bottom:4px;">
<h4 style="color:#FFFFFF;text-shadow: 1px 2px #44AADD;"><img src="images/twitter2.png" border="0">&nbsp;Twitter Search Tools</h4>
</div>
<div class="form-group" style="margin-left:8px; margin-right:8px;">
<div class="col-sm-6" align="right">
<select class="form-control input-sm" name="subject" id="subject">
<?php
for ($i=0; $i<count($list_subject); $i++) {
	$isi_select = explode("|",$list_subject[$i]);
	echo "<option value=\"".$isi_select[0]."\" ";
	if ($subject!="") {
		if ($isi_select[0]==$subject) echo " selected=\"selected\"";
	}
	echo ">".$isi_select[1]."</option>\n";
}
?> 
</select>
</div>
<div class="col-sm-6">
<select class="form-control" name="topik" id="topik" style="margin-top:-3px;" >
<?php
for ($i=0; $i<count($trending_topic); $i++) {
	echo "<option value=\"".$trending_topic[$i]."\" ";
	if ($topik==$trending_topic[$i]) echo " selected=\"selected\"";
	echo ">".$trending_topic[$i];
	if ($trending_volume[$i]>0)	echo " <b>(".$trending_volume[$i]." posting)</b>";
	echo "</option>\n";
}
?>
</select>
<input id="sub_value" name="sub_value" type="text" class="form-control input-sm" value="<?=$sub_value?>" placeholder="<?=HASHTAG_SEARCHING_CLUE?>" >
</div>
</div>

<div class="form-group" style="margin-left:8px; margin-right:8px;">
<div class="col-sm-6" align="right" >
<label class="input-sm" style="margin-bottom:0px;text-align:right;"><?=HASHTAG_KEEPING_TITLE?></label>
</div>
<div class="col-sm-6">
<input id="hashtag_keep" name="hashtag_keep" type="text" class="form-control input-sm"  value="<?=$hashtag_keep?>" placeholder="<?=HASTAG_KEEPING_CLUE?>" >
</div>
</div>

<div class="form-group" style="margin-left:8px; margin-right:8px;">
<div class="col-sm-6" align="right" >
<label class="input-sm" style="margin-bottom:0px;text-align:right;"><?=MENTION_KEEPING_TITLE?></label>
</div>
<div class="col-sm-6">
<input id="mention_keep" name="mention_keep" type="text" class="form-control input-sm"  value="<?=$mention_keep?>" placeholder="<?=MENTION_KEEPING_CLUE?>" >
</div>
</div>

<div class="form-group" style="margin-left:8px; margin-right:8px;">
<div class="col-sm-6" align="right">
<label class="input-sm" style="margin-bottom:0px;text-align:right;"><?=RETWEET_TITLE?></label>
</div>
<div class="col-sm-6" align="left">
<p style="padding:2px; margin:0px; width:inherit; border:1px solid #CCCCCC;">
<input id="checkRT" name="checkRT" type="checkbox" <?=$checkRT?> value="oke"> <?=RETWEET_SHOW?>
</p>
</div>
</div>

<div class="form-group" style="margin-left:8px; margin-right:8px;" >
<div class="col-sm-6" align="right" >
<label class="input-sm" style="margin-bottom:0px;text-align:right;"><?=RESULT_TYPE_TITLE?></label>
</div>
<div class="col-sm-6">
<select class="form-control input-sm" name="result_type" id="result_type" style="margin-top:-3px;" >
<?php
for ($i=0; $i<count($list_result); $i++) {
	echo "<option value=\"".$i."\" ";
	if ($result_type==$i) echo " selected=\"selected\"";
	echo ">".$list_result[$i]."</option>\n";
}
?>
</select>
</div>
</div>



<div class="form-group" style="margin-left:8px; margin-right:8px;">
<div class="col-sm-6" align="right">
<label class="input-sm" style="margin-bottom:0px;text-align:right;"><?=RESULT_COUNT_TITLE?></label>
</div>
<div class="col-sm-6">
<select class="form-control input-sm" name="t_count" id="t_count" style="margin-top:-3px;">
<?php
for ($i=0; $i<count($list_count); $i++) {
	echo "<option ";
	if ($list_count[$i]==$t_count) echo " selected=\"selected\"";
	echo ">".$list_count[$i]."</option>\n";
}
?>
</select>
</div>
</div>


<div class="form-group" style="margin-left:8px; margin-right:8px;">
<div class="col-xs-12" align="center">
<button type="submit" class="btn btn-primary"><?=BTN_SEARCH?></button>
<input type="hidden" id="aksi" name="aksi" value="Search">
</div>
</div>
</form>
<div class="clearfix">&nbsp;</div>


<?php
if ($errlog == 1) {
?>
<a name="twittersearch"></a>
<?php
//print_r($twits->statuses);
?>
<form id="form2" name="form2" method="post" action="twitternewflipping.php" target="_blank">

<table id="tblhasil" class="table table-striped table-hover" style="padding:4px!important; width:100%!important;" align="center">
<?php
function cleanSpace($txt) {
	return trim(preg_replace("/[[:blank:]]+/"," ",$txt));
}

function ubahPetik($text) {
	$hasil = str_replace("\"","&rdquo;",$text);
	$hasil = str_replace("'","&rsquo;",$hasil);
	$hasil = str_replace("`","&rsquo;",$hasil);
	$hasil = str_replace(array("<",">","&lt;","&gt;"),"",$hasil);
	return $hasil;
}

function onlyTags($benar,$data) {
	$hasil = preg_match_all("/(#\w+)/is", $data, $semuatags);
	if ($hasil!==false) {
		$semuatags = $semuatags[1];
		//split semua hashtag di $benar
		$rs = preg_match_all("/(#\w+)/is", $benar, $corrects);
		$corrects = $corrects[1];
		//kecilin semua hashtag di $benar
		$lcase_tags = array();
		foreach ($corrects as &$item) {
			if (!in_array(strtolower($item),$lcase_tags)) array_push($lcase_tags,strtolower($item));
		}
		for ($i=0; $i<count($semuatags); $i++) {
			if ( !in_array( strtolower($semuatags[$i]) , $lcase_tags) ) {
				$data = preg_replace("/".$semuatags[$i]."/","",$data);
			}
		}
	}
	return $data;
}

function onlyMentions($benar,$data) {
	$hasil = preg_match_all("/(@\w+)/", $data, $semuatags);
	if ($hasil!==false) {
		$semuatags = $semuatags[1];
		$rs = preg_match_all("/(@\w+)/", $benar, $corrects);
		$corrects = $corrects[1];
		//kecilin semua hashtag di $benar
		$lcase_tags = array();
		foreach ($corrects as &$item) {
			array_push($lcase_tags,strtolower($item));
		}
		for ($i=0; $i<count($semuatags); $i++) {
			if ( !in_array( strtolower($semuatags[$i]) , $lcase_tags) ) {
				$data = preg_replace("/".$semuatags[$i]."/","",$data);
			}
		}
	}
	return $data;
}

function URLclean($txt) {
	$urlRegex1 = '~(?i)\b((?:[a-z][\w-]+:(?:/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?«»“”‘’]))~';
	$urlRegex2 = "/(http|https):\/\/(.*?)\/[0-9|a-z|A-Z]*/is";
	$urlRegex3 = "/(http|https)/s";
	$akhir = array("h...","ht...","htt...",":...","...");
	$txt = preg_replace($urlRegex2, ' ', $txt); // remove urls
	$txt = preg_replace($urlRegex1, ' ', $txt); // remove urls
	$txt = preg_replace($urlRegex3, ' ', $txt); // remove urls
	$txt = str_replace($akhir,"",$txt);
	return $txt;
}

function stripInvalidXml($value)
{
    $ret = "";
    $current;
    if (empty($value)) 
    {
        return $ret;
    }

    $length = strlen($value);
    for ($i=0; $i < $length; $i++)
    {
        $current = ord($value{$i});
        if (($current == 0x9) ||
            ($current == 0xA) ||
            ($current == 0xD) ||

            (($current >= 0x28) && ($current <= 0xD7FF)) ||
            (($current >= 0xE000) && ($current <= 0xFFFD)) ||
            (($current >= 0x10000) && ($current <= 0x10FFFF)))
        {
            $ret .= chr($current);
        }
        else
        {
            $ret .= " ";
        }
    }
    return $ret;
}

function XMLclean($txt) {
	
	//$txt = preg_replace('/[^\\x0009\\x000A\\x000D\\x0020-\\xD7FF\\xE000-\\xFFFD]/', ' ', $txt);
	$txt = preg_replace('/[\x00-\x08\x10\x0B\x0C\x0E-\x19\x7F]|[\x00-\x7F][\x80-\xBF]+'.
	 '|([\xC0\xC1]|[\xF0-\xFF])[\x80-\xBF]*|[\xC2-\xDF]((?![\x80-\xBF])|[\x80-\xBF]{2,})'.
	 '|[\xE0-\xEF](([\x80-\xBF](?![\x80-\xBF]))|(?![\x80-\xBF]{2})|[\x80-\xBF]{3,})/S',' ', $txt );
 	$txt = preg_replace('/\xE0[\x80-\x9F][\x80-\xBF]|\xED[\xA0-\xBF][\x80-\xBF]/S',' ', $txt );
	$txt = str_replace(array("\t","\n","\r"),"",$txt);
	return $txt;
}

function removeEmoji($text) {

    $clean_text = "";

    // Match Emoticons
    $regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
    $clean_text = preg_replace($regexEmoticons, '', $text);

    // Match Miscellaneous Symbols and Pictographs
    $regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
    $clean_text = preg_replace($regexSymbols, '', $clean_text);

    // Match Transport And Map Symbols
    $regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
    $clean_text = preg_replace($regexTransport, '', $clean_text);

    // Match Miscellaneous Symbols
    $regexMisc = '/[\x{2600}-\x{26FF}]/u';
    $clean_text = preg_replace($regexMisc, '', $clean_text);

    // Match Dingbats
    $regexDingbats = '/[\x{2700}-\x{27BF}]/u';
    $clean_text = preg_replace($regexDingbats, '', $clean_text);
	
	$clean_text = mb_convert_encoding($clean_text, "utf-8", "utf-8");
	
	//$clean_text = iconv("UTF-8", "UTF-8//IGNORE", $clean_text);

    return $clean_text;
}



	$brs = 0;
	foreach ($twits->statuses as $twits) {
	  if (url_exists($twits->user->profile_image_url)==true) {
	 		if (strpos($twits->text,"RT ")===false && $checkRT=="") {
			  $waktu = date("d F Y, H:i:s",strtotime($twits->created_at));
			  $datetime = "<font color=\"#777777\">".$waktu."</font>";
			  $twits->text = URLclean($twits->text);
			  if ($subject=="hashtag" || $hashtag_keep!="") {
			  	if ($hashtag_keep!="") $twits->text = onlyTags("#".trim($sub_value)." ".trim($hashtag_keep),$twits->text);
			  }
			  if ($mention_keep!="") {
				$twits->text = onlyMentions($mention_keep,$twits->text);
			  } 
			  
			  if (isset($twits->entities->media)) {
			  	$media_url = $twits->entities->media[0]->media_url;
			  } else $media_url = "";
			  
			  $twits->text = cleanSpace($twits->text);
			  $twits->text = ubahPetik($twits->text);
			  $twits->text = XMLclean($twits->text);
			  $twits->text = removeEmoji($twits->text);
			  $twits->text = URLclean($twits->text);
			  
			  
			  $twits->user->name = XMLclean($twits->user->name);
			  //$twits->user->name = removeEmoji($twits->user->name);
			  echo "<tr>\n";
			  echo "<td width=\"15%\" align=\"center\"><a href=\"https://twitter.com/".$twits->user->screen_name."\" title=\"".$twits->user->name."\"><img src=\"".$twits->user->profile_image_url."\" width=\"50\" height=\"50\" class=\"img-responsive hasTooltip\" title=\"Username = ".$twits->user->screen_name."\" ></a></td>\n";
			  echo "<td width=\"45%\" align=\"left\"><a href=\"https://twitter.com/".$twits->user->screen_name."\" class=\"hasTooltip\" title=\"Username = ".$twits->user->screen_name."\" ><b>".$twits->user->name."</b></a> (".$datetime.")<br>" .$twits->text;
			  if ($media_url!="") echo "<br><img src=\"".$media_url."\" class=\"img-responsive img-thumbnail\" width=\"60%\" height=\"60%\" />";
			  echo "</td>\n";
			 
			  echo "<td width=\"10%\">";
			  echo "<input name=\"tw[]\" id=\"pcek\" type=\"checkbox\" value=\"".$brs."\">";
			  $twits->text = str_replace("&","&amp;",$twits->text);
			  echo "<input name=\"twits[]\" type=\"hidden\" value=\"".$twits->text."\" />";
			  echo "<input name=\"twitname[]\" type=\"hidden\" value=\"".$twits->user->name."\" />";
			  if (url_exists(str_replace("normal","400x400",$twits->user->profile_image_url))==true) {
				$twits->user->profile_image_url = str_replace("normal","400x400",$twits->user->profile_image_url);
			  }
			  echo "<input name=\"twitpic[]\" type=\"hidden\" value=\"".$twits->user->profile_image_url."\" />";
			  echo "<input name=\"twitlink[]\" type=\"hidden\" value=\"https://twitter.com/".$twits->user->screen_name."\" />";
			  echo "<input name=\"twitdatetime[]\" type=\"hidden\" value=\"".$waktu."\" />";
			  echo "</td>\n";
			  echo "</tr>\n";
			  $brs++;
			} elseif ($checkRT=="checked") {
			  $waktu = date("d F Y, H:i:s",strtotime($twits->created_at));
			  $datetime = "<font color=\"#777777\">".$waktu."</font>";
			  $twits->text = URLclean($twits->text);
			  if ($hashtag_keep!="" || $subject=="hastag") {
				$twits->text = onlyTags("#".$sub_value." ".$hashtag_keep,$twits->text);
			  } elseif ($subject=="hastag") {
				$twits->text = onlyTags("#".$sub_value,$twits->text);
			  }
			  if ($mention_keep!="") {
				$twits->text = onlyMentions($mention_keep,$twits->text);
			  }
			  
			  if (isset($twits->entities->media)) {
			  	$media_url = $twits->entities->media[0]->media_url;
			  } else $media_url = "";
			  
			  $twits->text = cleanSpace($twits->text);
			  $twits->text = ubahPetik($twits->text);
			  $twits->text = XMLclean($twits->text);
			  $twits->text = removeEmoji($twits->text);
			  $twits->text = URLclean($twits->text);
			  
			  $twits->user->name = XMLclean($twits->user->name);
			  $twits->user->name = removeEmoji($twits->user->name);
			  echo "<tr>\n";
			  echo "<td><a href=\"https://twitter.com/".$twits->user->screen_name."\" title=\"".$twits->user->name."\"><img src=\"".$twits->user->profile_image_url."\" class=\"img-responsive hasTooltip\" title=\"Username = ".$twits->user->screen_name."\"></a></td>\n";
			  echo "<td><a href=\"https://twitter.com/".$twits->user->screen_name."\" class=\"hasTooltip\" title=\"Username = ".$twits->user->screen_name."\"><b>".$twits->user->name."</b></a> (".$datetime.")<br>" .$twits->text;
			  if ($media_url!="") echo "<br><img src=\"".$media_url."\" class=\"img-responsive img-thumbnail\" width=\"60%\" height=\"60%\" />";
			  echo "</td>\n";
			  echo "<td>";
			  echo "<input name=\"tw[]\" id=\"pcek\" type=\"checkbox\" value=\"".$brs."\">";
			  $twits->text = str_replace("&","&amp;",$twits->text);
			  echo "<input name=\"twits[]\" type=\"hidden\" value=\"".$twits->text."\" />";
			  echo "<input name=\"twitname[]\" type=\"hidden\" value=\"".$twits->user->name."\" />";
			  if (url_exists(str_replace("normal","400x400",$twits->user->profile_image_url))==true) {
				$twits->user->profile_image_url = str_replace("normal","400x400",$twits->user->profile_image_url);
			  }
			  echo "<input name=\"twitpic[]\" type=\"hidden\" value=\"".$twits->user->profile_image_url."\" />";
			  echo "<input name=\"twitlink[]\" type=\"hidden\" value=\"https://twitter.com/".$twits->user->screen_name."\" />";
			  echo "<input name=\"twitdatetime[]\" type=\"hidden\" value=\"".$waktu."\" />";
			  echo "</td>\n";
			  echo "</tr>\n";
			  $brs++;
			}
	  }
	}
?>
<tr>
<td>&nbsp;</td>
<td align="right"><?=CHOOSE_ALL_TITLE?> : </td>
<td><input id="checkAll" type="checkbox" value=""></td>
</tr>
</table>
<div class="col-sm-12" align="right">
<br>
<?=TARGET_SAVE_TITLE?> :&nbsp;
<select name="mytujuan" id="mytujuan">
  <option value="twitternewflipping.php"><?=TARGET_SAVE_1?></option>
   <option value="twitteraddflipping.php"><?=TARGET_SAVE_2?></option>
</select>
</div>
<div class="col-sm-12" align="center">
<button type="submit" class="btn btn-primary">Save</button>
</div>
</form>
<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
<?php
} elseif ($errlog == 2) {
	echo "<div class=\"col-sm-12\" align=\"center\">";
	echo TWITTER_FAILED_CONNECT;
	echo "</div>";
}
?>

<div class="clearfix">&nbsp;</div>
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
</div>
</body>
</html>
