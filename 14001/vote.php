<?php
	//Database connection
	include 'config.php';
	
	//Add vote
	if (isset($_GET['no']))
	{
		$nmr = $_GET['no'];
		if (isset($_GET['vote']))
		{
			$v = $_GET['vote'];
			$t = 1;
			$w = $v + $t;
			
			//Update vote query
			$q = "UPDATE Review SET vote='$w' WHERE r_id='$nmr'";
			$qr = mysqli_query($conn, $q);
			if ($qr) 
			{
				echo '<script type="text/javascript">'; 
				echo 'alert("Vote berhasil ditambahkan!");'; 
				echo 'window.location=document.referrer;';
				echo '</script>';
			} else 
			{
				$msg='Error :'.mysql_error();
			}
		}
	}
?>