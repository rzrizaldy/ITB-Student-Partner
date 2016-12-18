<?php

	function connect()
	{
		$db_user = 'sql6148449';
		$db_pass = 'rHGTDz882H';
		$db_host = 'sql6.freemysqlhosting.net';
		$db_name = 'sql6148449';
		$con = mysqli_connect( $db_host, $db_user, $db_pass, $db_name );
		return $con;
	}

?>


<?php

	function connect1()
	{
		$db_user1 = 'sql6149046';
		$db_pass1 = '93MzwGAiU6';
		$db_host1 = 'sql6.freemysqlhosting.net';
		$db_name1 = 'sql6149046';
		$con1 = mysqli_connect( $db_host1, $db_user1, $db_pass1, $db_name1);
		return $con1;
	}

?>