<?php 
	require('./headnav.php');
	require('./scripts.php');

	echo "<iframe src=" . substr($_GET["nim"], -5) . " width='100%' height='100%' frameBorder='0'></iframe>";

?>