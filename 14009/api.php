<?php
 
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);
 
include('config.php');

mysqli_set_charset($link,'utf8');
 
// JSON dari data komplain
	$data = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
	$id = array_shift($request)+0;

	if (strcmp($data, 'data') ==0) {
	 switch ($method) {
		 case 'GET':
				$sql = "select * from dataKomplain".($id?" WHERE id=$id":''); break;
		 }
		 $result = mysqli_query($conn,$sql);
		 
	 if (!$result) {
			http_response_code(404);
	 die(mysqli_error());
	 }
	 
	 if ($method == 'GET') {
			$hasil=array();
	 while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	 {
			$hasil[]=$row;
	 } 
	 $hasil1 = array('status' => true, 'message' => 'Data show succes', 'data' => $hasil);
	 echo json_encode($hasil1);
	 
	 } elseif ($method == 'POST') {
			echo mysqli_insert_id($conn);
	 } else {
			echo mysqli_affected_rows($conn);
	 }
	}else{
			$hasil1 = array('status' => false, 'message' => 'Access Denied');
			echo json_encode($hasil1);
	}

mysqli_close($conn);

?>
