<?php
    session_start();
    if(!$_SESSION['isLogged']) {
        header("location:login.php"); 
        die(); 
    }
?>
<html>
    <head>
		<title>HOME</title>
    	<?php
			require('./headnav.php');
			require('./scripts.php');
		?>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./css/bootstrap.min.css" rel="stylesheet">
        <link href="./css/mainstyle.css" rel="stylesheet">
    </head>
    <body>
	    <div class="wrapper-utama" align = "center">
	    	<div class='container-utama-index'>
            <h1 style="color:#fff; margin-top:30%">SELAMAT DATANG DI ITB STUDENT PARTNER</h1>
        </div>
	</body>
</html>

