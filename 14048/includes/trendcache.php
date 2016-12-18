<?php
$trending_topic = array();
$trending_volume = array();
$tanggal_trending = "";

$cache_page_expired = 5*60;  //tiap dua menit direfresh ulang halaman data HTML-nya
$cachefile = "json/trends.json";
$bedahari = true;
if (file_exists($cachefile)) {
   if (intval(date("d",time())) == intval(date("d",filemtime($cachefile)))) $bedahari = false;
}
if ( file_exists($cachefile) && ((time()-$cache_page_expired ) < filemtime($cachefile))  && $bedahari==false  )  {
	$json = json_decode(file_get_contents($cachefile), true);
	$trending_topic = $json["trending_topic"];
	$trending_volume = $json["trending_volume"];
	$tanggal_trending = $json["tanggal_trending"];
	unset($json);
} else {
	$errlog = 0;
	$toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
	$query = array("id" => TRENDING_LOCATION_ID);
	$trending = $toa->get('trends/place', $query);
	if (!isset($trending)) $errlog = 3;
	//print_r($trending);
	if (isset($trending->errors)) $errlog = 3;
	//elseif (!is_object($trending)) $errlog = 3;
	if ($errlog==0) {
		$trends = $trending[0];
	//	$tanggal_trending = date("d F Y, H:i:s",strtotime($trends->created_at)); //as_of
		$tanggal_trending = date("d F Y, H:i:s",strtotime($trends->as_of));
		foreach ($trends->trends as $t) {
			array_push($trending_topic,$t->name);
			if (isset($t->tweet_volume)) {
				if (intval($t->tweet_volume)>0) array_push($trending_volume,$t->tweet_volume);
				else array_push($trending_volume,0);
			} else array_push($trending_volume,0);
		}
		$simpan = array("tanggal_trending" => $tanggal_trending, "trending_topic" => $trending_topic, "trending_volume" => $trending_volume);
		//print_r($simpan);
		
		$fp = fopen($cachefile, 'w');
		fwrite($fp, json_encode($simpan));
		fclose($fp);
		//print_r(json_encode($simpan));
		unset($simpan);
	}
}
?>