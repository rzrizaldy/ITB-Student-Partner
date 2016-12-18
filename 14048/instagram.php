<?php
include_once("includes/logincheck.php");
include_once("includes/const.php");
include_once("includes/language.php");
include_once("includes/freadurl.php");
include_once("includes/fread_array.php");
include_once("includes/fnewinstagram.php");

$scriptname = basename($_SERVER['PHP_SELF']);

//Language declare variable
include_once("includes/language/".$language."/".$scriptname);

if (isset($_REQUEST["aksi"])) $aksi = $_REQUEST["aksi"];
else $aksi = "";

if (isset($_REQUEST["subject"])) $subject = $_REQUEST["subject"];
else $subject = "";

if (isset($_REQUEST["hashtag"])) $hashtag = $_REQUEST["hashtag"];
else $hashtag = "";

if (isset($_REQUEST["hashtag_keep"])) $hashtag_keep = trim($_REQUEST["hashtag_keep"]);
else $hashtag_keep = "";

if (isset($_REQUEST["mention_keep"])) $mention_keep = trim($_REQUEST["mention_keep"]);
else $mention_keep = "";

if (isset($_REQUEST["picchoose"])) $picchoose = trim($_REQUEST["picchoose"]);
else $picchoose = "";

if (isset($_REQUEST["t_count"])) $t_count = intval($_REQUEST["t_count"]);
else $t_count = 10;

$list_subject = array("hashtag|".SUBJECT_1,"username|".SUBJECT_2,"popular|".SUBJECT_3);
$list_picture = array("posting|Posting Picture","profile|User Profile Picture");
$list_count = array("0|".LIST_COUNT_1,"5|".LIST_COUNT_2,"10|".LIST_COUNT_3,"15|".LIST_COUNT_4,"20|".LIST_COUNT_5);




?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>Instagram Search Tool</title>
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
<script language="javascript" type="text/javascript">
$(document).ready( function () {
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
	
	$('#mytujuan').on('change', function() {
		var tujuan = $(this).val();
		$("#form2").attr("action",tujuan);
		if (tujuan=="pilihan.php") {
			$("#form2").attr("target","_self");
		} else $("#form2").attr("target","_blank");
	});
	
	$('#subject').on('change', function() {
		var clue = ["<?=HASHTAG_CLUE?>","<?=USERNAME_CLUE?>","<?=HASHTAG_CLUE?>"];
		var subject_idx = $("#subject").prop('selectedIndex');
		$("#hashtag").attr("placeholder",clue[subject_idx]);
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

<form class="form-horizontal" role="form" id="form1" name="form1" method="post" action="<?=$scriptname?>#instasearch" target=""  >

<div class="col-sm-12" align="center" style="background-color:#a47d51; margin-bottom:4px;">
<h4 style="color:#FFFFFF;"><img src="images/instagram3.png" border="0">&nbsp;Instagram Search Tools</h4>
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
<div class="col-sm-6" align="left">
<input id="hashtag" name="hashtag" type="text" class="form-control input-sm"   value="<?=$hashtag?>" placeholder="<?=HASHTAG_CLUE?>" >
</div>
</div>

<div class="form-group" style="margin-left:8px; margin-right:8px;">
<div class="col-sm-6" align="right" >
<label class="input-sm" style="margin-bottom:0px;text-align:right;"><?=HASHTAG_KEEPING_TITLE?></label>
</div>
<div class="col-sm-6">
<input id="hashtag_keep" name="hashtag_keep" type="text" class="form-control input-sm"  value="<?=$hashtag_keep?>" placeholder="<?=HASHTAG_KEEPING_CLUE?>" >
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
<label class="input-sm" style="margin-bottom:0px;text-align:right;">Gambar yang ditampilkan :</label>
</div>
<div class="col-sm-6">
<select class="form-control input-sm" name="picchoose" id="picchoose" style="margin-top:-3px;">
<?php
for ($i=0; $i<count($list_picture); $i++) {
	$pilihan_gambar = explode("|",$list_picture[$i]);
	echo "<option ";
	echo "value=\"".$pilihan_gambar[0]."\" ";
	if ($picchoose==$pilihan_gambar[0]) echo " selected=\"selected\"";
	echo ">".$pilihan_gambar[1]."</option>\n";
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
	$isi = explode("|",$list_count[$i]);
	echo "<option ";
	echo "value=\"".$isi[0]."\" ";
	if ($list_count[$i]==$t_count) echo " selected=\"selected\"";
	echo ">".$isi[1]."</option>\n";
}
?>
</select>
</div>
</div>

<div class="form-group" style="margin-left:8px; margin-right:8px;">
<div class="col-xs-12" align="center">
<button type="submit" class="btn btn-primary"><?=BTN_SEARCH?></button>
<input type="hidden" id="aksi" name="aksi" value="search">
</div>
</div>

</form>
<div class="clearfix">&nbsp;</div>
<?php
function cleanSpace($txt) {
	$txt = trim(preg_replace("/[[:blank:]]+/"," ",$txt));
	$txt = trim(preg_replace("/[-]+/","-",$txt));
	$txt = trim(preg_replace("/[_]+/","_",$txt));
	$txt = trim(preg_replace("/[=]+/","=",$txt));
	$txt = trim(preg_replace("/[*]+/","*",$txt));
	return $txt;
}

function ubahPetik($text) {
	$hasil = str_replace("\"","&rdquo;",$text);
	$hasil = str_replace("'","&rsquo;",$hasil);
	$hasil = str_replace("`","&rsquo;",$hasil);
	$hasil = str_replace(array("<",">","&lt;","&gt;"),"",$hasil);
	return $hasil;
}

function onlyTags($benar,$data) {
	$hasil = preg_match_all("/(#\w+)/", $data, $semuatags);
	if ($hasil!==false) {
		$semuatags = $semuatags[1];
		//split semua hashtag di $benar
		$rs = preg_match_all("/(#\w+)/", $benar, $corrects);
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

function cleanBR($txt) {
	$txt = str_replace(array("\n","\r","\t"),"", $txt);
	return str_replace("<br>","",$txt);
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


$errlog = 0;
if ($aksi=="search") {
	if ($subject=="hashtag" && $hashtag!="") {
		$photos = GetInstaPhotoHashtag(str_replace(array("#"," "),"",$hashtag));
		if ($photos!=false) $errlog = 1;
	} elseif ($subject=="username" && $hashtag!="") {
		$photos = GetInstaPhotoUser(str_replace(array("#"," "),"",$hashtag));
		if ($photos!=false) $errlog = 1;
	} elseif ($subject=="popular" && $hashtag!="") {
		$photos = GetInstaPhotoHashtag(str_replace(array("#"," "),"",$hashtag),"topmost");
		if ($photos!=false) $errlog = 1;
	} else $errlog = 2;
}

if ($errlog==1) {
?>
<a name="instasearch"></a>
<form id="form2" name="form2" method="post" action="instagramnewflipping.php" target="_blank">
<table id="tblhasil" class="table table-striped table-hover" style="padding:4px!important; width:100%!important;" align="center">
<?php
if ($t_count==0) $jml = count($photos);
else $jml = $t_count;
$s = "";
for ($i=0;$i<$jml;$i++) {
	$myphoto = json_decode($photos[$i]);

	$myphoto->pic_title = cleanBR($myphoto->pic_title);
	$myphoto->pic_title = onlyTags(trim("#".$hashtag." ".$hashtag_keep),$myphoto->pic_title);
	if ($mention_keep!="") $myphoto->pic_title = onlyMentions($mention_keep,$myphoto->pic_title);
	$myphoto->pic_title = XMLclean($myphoto->pic_title);
	$myphoto->pic_title = removeEmoji($myphoto->pic_title);
	$myphoto->pic_title = cleanSpace($myphoto->pic_title);
	$myphoto->pic_title = ubahPetik($myphoto->pic_title);
	
	$myphoto->owner_fullname = XMLclean($myphoto->owner_fullname);
	$myphoto->owner_fullname = removeEmoji($myphoto->owner_fullname);
	
	$waktu = date("d F Y, H:i:s",$myphoto->pic_date);
    $datetime = "<font color=\"#777777\">".$waktu."</font>";
	
	if (trim($myphoto->owner_fullname)!="") {
		$myname = $myphoto->owner_fullname;
	} else $myname = $myphoto->owner_username;
	
	$s .= "<tr>";
	$s .= "<td width=\"15%\" align=\"center\">";
	$s .= "<a href=\"https://www.instagram.com/p/".$myphoto->pic_code."\" target=\"_blank\">";

	if ($picchoose=="posting")	$s .= "<img src=\"".$myphoto->pic_thumbnail."\" class=\"img-responsive\">";
	else $s .= "<img src=\"".$myphoto->owner_picprofile."\" class=\"img-responsive hasTooltip\" title=\"Username = ".$myphoto->owner_username."\">";
	
	$s .= "</a>";
	$s .= "</td>";
	$s .= "<td width=\"45%\" align=\"left\">";
	$s .= "<a href=\"https://www.instagram.com/p/".$myphoto->pic_code."\" target=\"_blank\" class=\"hasTooltip\" title=\"Username = ".$myphoto->owner_username."\"><b>".$myname."</b></a>&nbsp;";
	$s .= "(".$datetime.")<br>";
	$s .= $myphoto->pic_title;
	$s .= "</td>";
	$s .= "<td width=\"10%\">";
	$s .= "<input name=\"insta[]\" id=\"pcek\" type=\"checkbox\" value=\"".$i."\">";
	$myphoto->pic_title = str_replace("&","&amp;",$myphoto->pic_title);
	$s .= "<input name=\"instacomment[]\" type=\"hidden\" value=\"".$myphoto->pic_title."\" />";
	$s .= "<input name=\"instaname[]\" type=\"hidden\" value=\"".$myname."\" />";

	if ($picchoose=="posting")	$s .= "<input name=\"instapic[]\" type=\"hidden\" value=\"".$myphoto->pic_thumbnail."\" />";
	else $s .= "<input name=\"instapic[]\" type=\"hidden\" value=\"".$myphoto->owner_picprofile."\" />";

	$s .= "<input name=\"instalink[]\" type=\"hidden\" value=\"https://instagram.com/".$myphoto->owner_username."\" />";
	$s .= "<input name=\"instadatetime[]\" type=\"hidden\" value=\"".$myphoto->pic_date."\" />";
	$s .= "</td>\n";
	$s .= "</tr>\n";
}
echo $s;
unset($s);
?>
<tr>
<td>&nbsp;</td>
<td align="right"><b><?=CHOOSE_ALL?></b></td>
<td><input id="checkAll" type="checkbox" value=""></td>
</tr>
</table>
<div class="col-xs-12" align="right">
<br><b><?=TARGET_SAVE_TITLE?> :</b>&nbsp;
<select name="mytujuan" id="mytujuan">
  <option value="instagramnewflipping.php"><?=TARGET_SAVE_1?></option>
   <option value="instagramaddflipping.php"><?=TARGET_SAVE_2?></option>
</select>
</div>
<div class="col-sm-12" align="center">
<button type="submit" class="btn btn-primary"><?=BTN_SAVE?></button>
</div>
</form>
<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
</form>
<?php
}
?>

<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
<div class="clearfix col-sm-12" align="right" style="border-top:1px dashed #333333;">
<div class="clearfix">&nbsp;</div>
<div class="col-sm-6 col-xs-6" align="left"><a href="frontpage.php" class="btn btn-primary">Home</a></div>
<div class="col-sm-6 col-xs-6" align="right"><label id="goTop" class="lnk-button" style="height:auto!important;"><?=BTN_SCROLL_UP?></label></div>
<div class="clearfix">&nbsp;</div>

<?php
include_once("includes/footer.php");
?>

</div>
</body>
</html>
