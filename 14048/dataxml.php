<?php
//otomatis men-generate file XML;
if (isset($_REQUEST["jump"])) $jump = trim($_REQUEST["jump"]);
else $jump = "";

if ($jump!="Q3JlYXRlZCBieSBTb25ueSAoWE5ZKSBTb2xlbWFu") include_once("includes/prevent_ipaddress.php");

if (isset($_REQUEST["split"])) $split = intval($_REQUEST["split"]);
else $split = 0;

$cek_fb = file_exists("json/facebook.json");
$cek_twit = file_exists("json/twitter.json");
$cek_insta = file_exists("json/instagram.json");

if ($cek_insta==true) {
	$json = json_decode(file_get_contents("json/instagram.json"), true);
	$iname = $json["iname"];
	$ipic = $json["ipic"];
	$icomments = $json["icomments"];
	$ilink = $json["ilink"];
	$idatetime = $json["idatetime"];
	unset($json);
	$instacount = count($icomments);
} else $instacount = 0;

if ($cek_fb==true)  {
	$json = json_decode(file_get_contents("json/facebook.json"), true);
	$fbname = $json["fname"];
	$fbpic = $json["fpic"];
	$fbcomments = $json["fcomments"];
	$fblink = $json["flink"];
	$fbdatetime = $json["fdatetime"];
	unset($json);
	$fbcount = count($fbcomments);
} else $fbcount = 0;

if ($cek_twit==true)  {
	$json = json_decode(file_get_contents("json/twitter.json"), true);
	$tname = $json["tname"];
	$tpic = $json["tpic"];
	$tcomments = $json["tcomments"];
	$tlink = $json["tlink"];
	$tdatetime = $json["tdatetime"];
	unset($json);
	$twitcount = count($tcomments);
} else $twitcount = 0;

if (($cek_twit==false) && ($cek_fb==false) && ($cek_insta==false)) {
	echo "Komentar Twitter / Instagram belum ditentukan, silahkan ditentukan dahulu.";
	exit;
}

function MyDomain() {
	$dirname = dirname($_SERVER['PHP_SELF']);
	$dirname = str_replace("\\","/",$dirname);
	$domainname = $_SERVER['SERVER_NAME'];
	$domainname = str_replace("localhost","127.0.0.1",$domainname);
	return "http://".$domainname.$dirname;
}

function SplitChars($txt, $maxCount) {
	$txt = str_replace(array("\n","\r","\t"),"",$txt);
	$txt = trim(preg_replace("/[[:blank:]]+/"," ",$txt));
	if (strlen($txt) > $maxCount) {
		$words = explode(" ",$txt);
		$hasil = array();
		$jml_kata = count($words);
		$kalimat = $words[0];
		for ($i=1; $i<$jml_kata; $i++) {
			$lebar = strlen($kalimat." ".$words[$i]);
			if ($lebar<$maxCount) $kalimat .= " ".$words[$i];
			else {
				array_push($hasil,$kalimat);
				$kalimat = $words[$i];
			}
		}
		if (!in_array($kalimat,$hasil)) array_push($hasil,$kalimat);
	} else $hasil = $txt;
	return $hasil;
}

function Array_mixing($a,$b,$index_merge = 0) {
	if (!is_array($a) && !is_array($b)) return false;
	else {
		$count_a = count($a);
		$count_b = count($b);
		$result = array();
		if ($count_a>0 && $count_b>0) {
			if ($count_a>$count_b || $count_a==$count_b) {
				$b_idx = 0;
				for ($i=0; $i<$count_a; $i++) {
					array_push($result,$a[$i]);
					if ($index_merge==0 && $i<$count_b) {
						if ($b_idx<$count_b) {
							array_push($result,$b[$b_idx]);
							$b_idx++;
						}
					} elseif ($index_merge>0) {
						if ($i % $index_merge == 0) {
							if ($b_idx<$count_b) {
								array_push($result,$b[$b_idx]);
								$b_idx++;
							}
						}
					}
				}
				return $result;
			} elseif ($count_b>$count_a) {
				$a_idx = 0;
				for ($i=0; $i<$count_b; $i++) {
					array_push($result,$b[$i]);
					if ($index_merge==0 && $i<$count_a) {
						if ($a_idx<$count_a) {
							array_push($result,$a[$a_idx]);
							$a_idx++;
						}
					} elseif ($index_merge>0) {
						if ($i % $index_merge = 0) {
							if ($a_idx<$count_a) {
								array_push($result,$a[$a_idx]);
								$a_idx++;
							}
						}
					}
				}
				return $result;
			} 
		
		} elseif ($count_a>0) {
			return $a;
		} elseif ($count_b>0) {
			return $b;
		} else return false;
	}
}

function cleanSpace($txt) {
	return trim(preg_replace("/[[:blank:]]+/"," ",$txt));
}

function ubahPetik($text) {
	$hasil = str_replace("\"","&rdquo;",$text);
	$hasil = str_replace("'","&rsquo;",$hasil);
	$hasil = str_replace("`","&rsquo;",$hasil);

//	$hasil = str_replace("&rdquo;","",$text);
//	$hasil = str_replace("&rsquo;","",$hasil);
//	$hasil = str_replace("\"","",$hasil);
//	$hasil = str_replace("'","",$hasil);
//	$hasil = str_replace("`","",$hasil);
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
	$txt = preg_replace($urlRegex2, ' ', $txt); // remove urls
	$txt = preg_replace($urlRegex1, ' ', $txt); // remove urls
	$txt = preg_replace($urlRegex3, ' ', $txt); // remove urls
	return $txt;
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

function noBR($text) {
	return str_replace(array("\n","\r","\t"),"",$text);
}

function limit_chars($string, $limit) {
	if (strlen($string)>$limit) return substr($string,0,$limit)."...";
	else return $string;
}

function limit_words($string, $word_limit) {
	$words = explode(" ",$string);
	return implode(" ",array_splice($words,0,$word_limit));
}

for ($i=0; $i<$fbcount; $i++) {
	$fbname[$i] = noBR($fbname[$i]);
	$fbname[$i] = cleanSpace($fbname[$i]);
	//$fbname[$i] = ubahPetik($fbname[$i]);
	$fbname[$i] = XMLclean($fbname[$i]);
	$fbname[$i] = removeEmoji($fbname[$i]);
	$fbcomments[$i] = noBR($fbcomments[$i]);
	$fbcomments[$i] = cleanSpace($fbcomments[$i]);
	$fbcomments[$i] = ubahPetik($fbcomments[$i]);
	$fbcomments[$i] = XMLclean($fbcomments[$i]);
	$fbcomments[$i] = removeEmoji($fbcomments[$i]);
}

for ($i=0; $i<$twitcount; $i++) {
	$tname[$i] = noBR($tname[$i]);
	$tname[$i] = cleanSpace($tname[$i]);
	//$tname[$i] = ubahPetik($tname[$i]);
	$tname[$i] = XMLclean($tname[$i]);
	$tname[$i] = removeEmoji($tname[$i]);
	
	$tcomments[$i] = noBR($tcomments[$i]);
	$tcomments[$i] = cleanSpace($tcomments[$i]);
	$tcomments[$i] = ubahPetik($tcomments[$i]);
	$tcomments[$i] = XMLclean($tcomments[$i]);
	$tcomments[$i] = removeEmoji($tcomments[$i]);
}

for ($i=0; $i<$instacount; $i++) {
	$iname[$i] = noBR($iname[$i]);
	$iname[$i] = cleanSpace($iname[$i]);
	//$tname[$i] = ubahPetik($tname[$i]);
	$iname[$i] = XMLclean($iname[$i]);
	$iname[$i] = removeEmoji($iname[$i]);
	
	$icomments[$i] = noBR($icomments[$i]);
	$icomments[$i] = cleanSpace($icomments[$i]);
	$icomments[$i] = ubahPetik($icomments[$i]);
	$icomments[$i] = XMLclean($icomments[$i]);
	$icomments[$i] = removeEmoji($icomments[$i]);
}

$myhost_path = MyDomain();

//Mixing all social media comments
if ($twitcount>0 && $instacount>0) {
	$array_nama = Array_mixing($tname,$iname);
	$array_pic = Array_mixing($tpic,$ipic);
	$array_link = Array_mixing($tlink,$ilink);
	$array_comments = Array_mixing($tcomments,$icomments);
	$array_datetime = Array_mixing($tdatetime,$idatetime);
} elseif ($twitcount>0) {
	$array_nama = $tname;
	$array_pic = $tpic;
	$array_link = $tlink;
	$array_comments = $tcomments;
	$array_datetime = $tdatetime;
} elseif ($instacount>0) {
	$array_nama = $iname;
	$array_pic = $ipic;
	$array_link = $ilink;
	$array_comments = $icomments;
	$array_datetime = $idatetime;
}
if (!isset($array_nama) && $fbcount>0) {
	$array_nama = $fbname;
	$array_pic = $fbpic;
	$array_link = $fblink;
	$array_comments = $fbcomments;
	$array_datetime = $fbdatetime;
} elseif ($fbcount>0) {
	$jml = count($array_nama);
	if ($jml==($twitcount+$instacount)) {
		$array_nama = Array_mixing($array_nama,$fbname,2);
		$array_pic = Array_mixing($array_pic,$fbpic,2);
		$array_link = Array_mixing($array_link,$fblink,2);
		$array_comments = Array_mixing($array_comments,$fbcomments,2);
		$array_datetime = Array_mixing($array_datetime,$fbdatetime,2);
	} else {
		$array_nama = Array_mixing($array_nama,$fbname);
		$array_pic = Array_mixing($array_pic,$fbpic);
		$array_link = Array_mixing($array_link,$fblink);
		$array_comments = Array_mixing($array_comments,$fbcomments);
		$array_datetime = Array_mixing($array_datetime,$fbdatetime);
	}
}

$s = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n\r";
$s .= "<socialmedia>\n";

$jml = count($array_nama);

for ($i=0; $i<$jml; $i++) {
	if ($split==0) {
		$s .= "\t<rowdata>\n";
		if (preg_match("/facebook/s",$array_link[$i])) {
			$s .= "\t\t<picsource>".urlencode($myhost_path."/images/facebook.png")."</picsource>\n";
		} elseif (preg_match("/twitter/s",$array_link[$i])) {
			$s .= "\t\t<picsource>".urlencode($myhost_path."/images/twitter2.png")."</picsource>\n";
		} elseif (preg_match("/instagram/s",$array_link[$i])) {
			$s .= "\t\t<picsource>".urlencode($myhost_path."/images/instagram3.png")."</picsource>\n";
		}
		$s .= "\t\t<image>".urlencode($array_pic[$i])."</image>\n";
		$s .= "\t\t<username>".$array_nama[$i]."</username>\n";
		$s .= "\t\t<usercomment>".$array_comments[$i]."</usercomment>\n";
		$s .= "\t</rowdata>\n";
	} else {
		$komentar = SplitChars($array_comments[$i],$split);
		if (!is_array($komentar)) {
			$s .= "\t<rowdata>\n";
			if (preg_match("/facebook/s",$array_link[$i])) {
				$s .= "\t\t<picsource>".urlencode($myhost_path."/images/facebook.png")."</picsource>\n";
			} elseif (preg_match("/twitter/s",$array_link[$i])) {
				$s .= "\t\t<picsource>".urlencode($myhost_path."/images/twitter2.png")."</picsource>\n";
			} elseif (preg_match("/instagram/s",$array_link[$i])) {
				$s .= "\t\t<picsource>".urlencode($myhost_path."/images/instagram3.png")."</picsource>\n";
			}
			$s .= "\t\t<image>".urlencode($array_pic[$i])."</image>\n";
			$s .= "\t\t<username>".$array_nama[$i]."</username>\n";
			$s .= "\t\t<usercomment>".$array_comments[$i]."</usercomment>\n";
			$s .= "\t</rowdata>\n";
		} else {
			$jml_c = count($komentar);
			for ($j=0; $j<$jml_c; $j++) {
				$s .= "\t<rowdata>\n";
				if (preg_match("/facebook/s",$array_link[$i])) {
					$s .= "\t\t<picsource>".urlencode($myhost_path."/images/facebook.png")."</picsource>\n";
				} elseif (preg_match("/twitter/s",$array_link[$i])) {
					$s .= "\t\t<picsource>".urlencode($myhost_path."/images/twitter2.png")."</picsource>\n";
				} elseif (preg_match("/instagram/s",$array_link[$i])) {
					$s .= "\t\t<picsource>".urlencode($myhost_path."/images/instagram3.png")."</picsource>\n";
				}
				$s .= "\t\t<image>".urlencode($array_pic[$i])."</image>\n";
				$s .= "\t\t<username>".$array_nama[$i]."</username>\n";
				$s .= "\t\t<usercomment>".$komentar[$j]."</usercomment>\n";
				$s .= "\t</rowdata>\n";
			}
		}
		
	}
}

$s .= "</socialmedia>";
//$s .= "</SLIDESHOW>\n";
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-type: text/xml');
//header('Content-Disposition: attachment; filename="dataxml.xml"');
echo $s;
unset($s);
?>