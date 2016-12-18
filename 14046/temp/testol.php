
<?php
//referensi :
//http://stackoverflow.com/questions/6382539/call-to-undefined-function-curl-init
//http://stackoverflow.com/questions/12885538/php-curl-and-cookies
//http://stackoverflow.com/questions/4372710/php-curl-https

error_reporting(1);

function get_web_page( $url, $cookie )
{
	$options = array(
		CURLOPT_RETURNTRANSFER    => true,	 // return web page
		CURLOPT_HEADER            => false,	// don't return headers
		CURLOPT_FOLLOWLOCATION    => true,	 // follow redirects
		CURLOPT_ENCODING	      => "",	   // handle all encodings
		CURLOPT_USERAGENT	      => "spider", // who am i
		CURLOPT_AUTOREFERER	      => true,	 // set referer on redirect
		CURLOPT_CONNECTTIMEOUT    => 120,	  // timeout on connect
		CURLOPT_TIMEOUT		      => 120,	  // timeout on response
		CURLOPT_MAXREDIRS	      => 10,	   // stop after 10 redirects
		CURLOPT_SSL_VERIFYPEER    => false,	// Disabled SSL Cert checks
		CURLOPT_COOKIE		      => $cookie
	);

	$ch	  = curl_init( $url );
	curl_setopt_array( $ch, $options );
	$content = curl_exec( $ch );
	$err	 = curl_errno( $ch );
	$errmsg  = curl_error( $ch );
	$header  = curl_getinfo( $ch );
	curl_close( $ch );

	$header['errno']   = $err;
	$header['errmsg']  = $errmsg;
	$header['content'] = $content;
	return $header;
}

$fak=isset($_GET["fakultas"])?$_GET["fakultas"]:"";
$ps=isset($_GET["ps"])?$_GET["ps"]:"";

//$isi=get_web_page("https://ol.akademik.itb.ac.id/frs/displayjadwalkelas.php?fakultas=".$fak."&ps=".$ps , "uitb=p81uFVgoQWG+XlsCFdC7Ag==; bahasa=id; PHPSESSID=g8f17hvkrka6jjd8dp77lp0ia7")['content'];
$isi=get_web_page("https://ol.akademik.itb.ac.id/frs/displayjadwalkelas.php?ps=".$ps , "uitb=p81uFVgoQWG+XlsCFdC7Ag==; bahasa=id; PHPSESSID=g8f17hvkrka6jjd8dp77lp0ia7")['content'];

$isi=explode('<table border="1',$isi)[1];
$isi=explode('</table>',$isi)[0];
echo('<table border="1'.$isi."</table>");

?>