<?php

function getlastolurl($url){

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$a = curl_exec($ch);
	curl_close( $ch );
	// the returned headers
	$headers = explode("\n",$a);
	// if there is no redirection this will be the final url
	$redir = $url;
	// loop through the headers and check for a Location: str
	$j = count($headers);
	for($i = 0; $i < $j; $i++){
		// if we find the Location header strip it and fill the redir var
		if(strpos($headers[$i],"Location:") !== false){
        	$redir = trim(str_replace("Location:","",$headers[$i]));
        	break;
    	}
	}
	// do whatever you want with the result
	return $redir;
}

//getlastolurl();
?>
