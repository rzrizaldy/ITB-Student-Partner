<?php
function fread_all_url($data = array()) {
	//buang data aray yang kosong
	$data = array_filter($data);
	$data = array_values($data);
	//print_r($data);
	$user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
	$ch = array();
	$jml = count($data);
	if ($jml>0) {
		$mh = curl_multi_init();
		for ($i=0; $i<$jml; $i++) {
			$ch[$i] = curl_init();
			curl_setopt( $ch[$i], CURLOPT_USERAGENT, $user_agent);
			curl_setopt( $ch[$i], CURLOPT_ENCODING,'gzip,deflate');  // for faster loading
			curl_setopt( $ch[$i], CURLOPT_HTTPGET, 1 );
			curl_setopt( $ch[$i], CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt( $ch[$i], CURLOPT_FOLLOWLOCATION , 1 );
			curl_setopt( $ch[$i], CURLOPT_URL, $data[$i] );
			curl_setopt( $ch[$i], CURLOPT_REFERER, "" );
			if (preg_match("/https/is", $data[$i])) curl_setopt( $ch[$i], CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt( $ch[$i], CURLOPT_CONNECTTIMEOUT,20);      // timeout on connect
			curl_setopt( $ch[$i], CURLOPT_MAXREDIRS,10);
			curl_multi_add_handle($mh,$ch[$i]);
		}
		$running = NULL;
		do {
			try {
				$mrc = curl_multi_exec($mh,$running);
			} catch (Exception $e) {
				if (curl_errno()) {
					$hasil = false;
					$running = false;
				}
			}
		} while($running > 0 || $mrc == CURLM_CALL_MULTI_PERFORM);
		while ($running && $mrc == CURLM_OK) {
			if (curl_multi_select($mh) != -1) {
				do {
					//usleep(10000);
					try {
						$mrc = curl_multi_exec($mh, $running);
					} catch (Exception $e) {
						if (curl_errno()) {
							$hasil = false;
						}
					}	
				} while ($mrc == CURLM_CALL_MULTI_PERFORM);
			}
		}
		if (!isset($hasil))	 {
			$hasil = array();
			for ($i=0; $i<$jml; $i++) {
				$hasil[$i] = curl_multi_getcontent($ch[$i]);
			}
		}
		
		// REMOVE single handle
		for ($i=0; $i<$jml; $i++) {
			curl_multi_remove_handle($mh, $ch[$i]);
		}
		curl_multi_close($mh);
		return $hasil;
	}
}
?>