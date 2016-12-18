
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

		//post
		//https://stackoverflow.com/questions/2138527/php-curl-http-post-sample-code
		//curl_setopt($ch, CURLOPT_POST, 1);
		//CURLOPT_POSTFIELDS
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



function get_tutorial($ps){
	$coo="uitb=p81uFVhRSFGjHBgfBlXmAg==; PHPSESSID=3t9eq554dveb9opr2u7ptq9d11; bahasa=id; _ga=GA1.3.2001335151.1481721969; _gat=1";
	$isi=get_web_page("https://ol.akademik.itb.ac.id/frs/displayjadwalkelas.php?fakultas=FMIPA&ps=".$ps , $coo )['content'];

	$arr=array();

	$isi_array=explode("<tr >\n<td align=\"right\" class=\"kolom\">", $isi);
	//echo($isi_array[1]);
	foreach ($isi_array as $v) {
		preg_match_all("/[0-9]{2,3} - .+ - T/", $v, $hasil, PREG_OFFSET_CAPTURE);
		if($hasil!==false && isset($hasil[0][0])){
			$vv=explode('class="kolom">', $v);

			$kode    =substr($vv[1], 0, strpos($vv[1],  "</td>" ));
			$nama    =substr($vv[2], 0, strpos($vv[2],  "</td>" ));
			$sks     =substr($vv[3], 0, strpos($vv[3],  "</td>" ));
			$no_kls  =substr($vv[4], 0, strpos($vv[4],  "</td>" ));
			$dosen   =substr($vv[5], 0, strpos($vv[5],  "</td>" ));

			foreach ($hasil[0] as $value) {
				array_push($arr, array(
					 "kode" => $kode
					,"nama" => $nama
					,"sks" => $sks
					,"no_kls" => $no_kls
					,"dosen" => $dosen
					,"jadwal" => $value[0]
				));
			}

		}
	}

	return $arr;
}

?>
