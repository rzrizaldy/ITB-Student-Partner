<?php
require_once __DIR__ . '\php-graph-sdk\src\Facebook\autoload.php';

function pictureAttachment($fb,$id)
{

	$request = $fb->request('GET', '/'.$id.'/attachments');
	try {
	  $response = $fb->getClient()->sendRequest($request);;
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
	  // When Graph returns an error
	  echo 'Graph returned an error: ' . $e->getMessage();
	  exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
	  // When validation fails or other local issues
	  echo 'Facebook SDK returned an error: ' . $e->getMessage();
	  exit;
	}

	$graphObject = $response->getGraphEdge()->asArray();

	foreach ($graphObject as $value)
	{
		if (($value['type'])=='photo') {
		$coba = $value['media'];
		$coba2 = $coba['image'];
		$coba3 = $coba2['src'];
		return($coba3);
		}
	}
}

function delete_all_between($beginning, $end, $string) 
{
	  $beginningPos = strpos($string, $beginning);
	  $endPos = strpos($string, $end);
	  if ($beginningPos === false || $endPos === false) {
		return $string;
	  }

	  $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);

	  return str_replace($textToDelete, '', $string);
}

function getFacebookData($limit)
{
	session_start();

	$fb = new Facebook\Facebook([
	  'app_id' => '1103484983038755',
	  'app_secret' => '68e5f47945b1337b66f4012bf8be0a18',
	  'default_graph_version' => 'v2.8',
	]);

	// Sets the default fallback access token so we don't have to pass it to each request
	$fb->setDefaultAccessToken('1103484983038755|V32vVNT20-IqTeAgdBS7Vpq273c');

	$request = $fb->request('GET', '/208476365953052/feed?limit='.$limit);
	try {
	  $response = $fb->getClient()->sendRequest($request);;
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
	  // When Graph returns an error
	  echo 'Graph returned an error: ' . $e->getMessage();
	  exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
	  // When validation fails or other local issues
	  echo 'Facebook SDK returned an error: ' . $e->getMessage();
	  exit;
	}
	
	$graphEdge = $response->getGraphEdge()->asArray();
	usort($graphEdge, function($a, $b) {
	  $ad = ($a['updated_time']);
	  $bd = ($b['updated_time']);

	  if ($ad == $bd) {
		return 0;
	  }

	  return $ad < $bd ? -1 : 1;
	});


	$lostfound = array();
	foreach ($graphEdge as $value)
	{
		if ($value['message'] !== null)
		{
			$message = $value['message'];
			$link='https://www.facebook.com/'.$value['id'];
			$attach=pictureAttachment($fb,$value['id']);
			$info = delete_all_between('[', ']', $message);
			$date = $value['updated_time'];
			$time = $date->format('Y-m-d H:i:s');
			if ((strpos($message, 'LOST') !== false) or (strpos($message, 'menemukan') !== false)){
				$status = 'LOST';
				$lostfound[]= array(
							'Status' => $status,
							'Date' => $time,
							'Information' => $info,
							'Link' => $link,
							'Attachment' => $attach);
			} else
			if ((strpos($message, 'FOUND') !== false) or (strpos($message, 'Found') !== false) or (strpos($message, 'found') !== false) or (strpos($message, 'Ditemukan') !== false) or (strpos($message, 'DITEMUKAN') !== false)) {
				$status = 'FOUND';
				$lostfound[]= array(
							'Status' => $status,
							'Date' => $time,
							'Information' => $info,
							'Link' => $link,
							'Attachment' => $attach);
			} else { $status = 'null';}
		}
	}
	return $lostfound;
}

function searchData($info,$array)
{
	$result = array();
	foreach ($array as $row) {
		$information = $row['Information'];
		$date = $row['Date'];
		if ((strpos($information, $info) !== false) or (strpos($date, $info) !== false)) {
			$result[] = $row;
		}
	}
	return $result;
}

function combineFbDB($graphEdge)
{
	$con = mysqli_connect("sql6.freemysqlhosting.net","sql6148241","ae4Pdl8VFh") or die("Cannot connect to host");
	mysqli_select_db($con,'sql6148241') or die("Cannot connect to db");
	$result = mysqli_query($con,"SELECT * FROM data");
	
	while($row=mysqli_fetch_array($result)){
		$graphEdge[] = $row;
	}
	
	return $graphEdge;
}

function addtosql()
{
	if(! get_magic_quotes_gpc() )
	{
	   $status = addslashes ($_POST['Status']);
	   $info = addslashes ($_POST['Information']);
	}
	else
	{
	   $status = $_POST['Status'];
	   $info = $_POST['Information'];
	}

	$sql = "INSERT INTO data ".
		   "(Status,Information) ".
		   "VALUES ".
		   "('$status','$info')";
	$con = mysqli_connect("sql6.freemysqlhosting.net","sql6148241","ae4Pdl8VFh") or die("Cannot connect to host");
	mysqli_select_db($con,'sql6148241') or die("Cannot connect to db");
	$retval = mysqli_query($con,$sql);
	if(! $retval )
	{
	  die('Could not enter data: ');
	}
	echo 'Data inserted successfully!';
	mysqli_close($con);
}

function deletesql()
{
	   $id = $_POST['Id'];

	$sql = "DELETE FROM data ".
		   "WHERE ".
		   "Id='$id'";
	$con = mysqli_connect("sql6.freemysqlhosting.net","sql6148241","ae4Pdl8VFh") or die("Cannot connect to host");
	mysqli_select_db($con,'sql6148241') or die("Cannot connect to db");
	$retval = mysqli_query($con,$sql);
	if(! $retval )
	{
	  die('Could not enter data: ');
	}
	echo 'Data deleted successfully!';
	mysqli_close($con);
}
error_reporting (E_ALL ^ E_NOTICE); 
?>
