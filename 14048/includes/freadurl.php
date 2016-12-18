<?php
if (!function_exists("fread_url")) {
	function fread_url($url, $postfield=array(), $ref=""){
			$user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
			$ch = curl_init();
			curl_setopt( $ch, CURLOPT_USERAGENT, $user_agent);
			curl_setopt( $ch, CURLOPT_ENCODING,'gzip,deflate');  // for faster loading
			curl_setopt( $ch, CURLOPT_HTTPGET, 1 );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt( $ch, CURLOPT_FOLLOWLOCATION , 1 );
			if (count($postfield)>0) curl_setopt( $ch, CURLOPT_POSTFIELDS, $postfield);
			if (preg_match("/https/is", $url)) curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt( $ch, CURLOPT_URL, $url );
			curl_setopt( $ch, CURLOPT_REFERER, $ref );
			curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT,20);      // timeout on connect
			curl_setopt( $ch, CURLOPT_MAXREDIRS,10);
			//curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie'.date('YmdHis').'.txt');
			try {
				$html = @curl_exec($ch);
			} catch (Exception $e) {
				if (curl_errno()) $html = false;
			}
			curl_close($ch);
		return $html;
	}
}
?>