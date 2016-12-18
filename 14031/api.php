<?php 

function get_user_by_id($id){
	$user_info = array();
	
	$con = mysqli_connect('sql6.freemysqlhosting.net','sql6149310','vQLBnzaQb6') or die ("Cannot connect to host");
	mysqli_select_db($con, 'sql6149310') or die ("Cannot connect to db");
	$result = mysqli_query($con, "SELECT * FROM eventcalendar WHERE id = $id");
	$user_info = mysqli_fetch_array($result, MYSQLI_ASSOC);
	
	
	mysqli_free_result($result);
	mysqli_close($con);
	
	return $user_info;
}

	$con = mysqli_connect('sql6.freemysqlhosting.net','sql6149310','vQLBnzaQb6') or die ("Cannot connect to host");
	mysqli_select_db($con, 'sql6149310') or die ("Cannot connect to db");
	$res = mysqli_query($con, "SELECT * FROM eventcalendar");
	$num = mysqli_num_rows($res);
	
//	if (isset($_GET["action"])){
//		switch ($_GET["action"]){
//			case "get_user";
//			if (isset($_GET["id"]))
//				$value = get_user_by_id($_GET["id"]);
//			else
//				$value = "we need an argument";
//			break;
//		}
//	}
	
	if (isset($_GET["action"])){
		$i = 1;
		while ($i < $num){
			$value = get_user_by_id($i);
			echo json_encode($value);
			echo "<br>";
			$i++;
		}
	} else{
		$value = "we need an argument";
	}
	
//	exit(json_encode($value));
?>
