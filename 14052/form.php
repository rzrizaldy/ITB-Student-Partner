<?php
include('db.php');
session_start();

$setnum = json_decode($_POST['kursi']);


?>

<!DOCTYPE html>

<html >
	<head>
		<!-- for-mobile-apps -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
		
		<!-- HEADER -->
		<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
		<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
		<link href="css/newstyle.css" rel="stylesheet" type="text/css" media="all" />
		
		<link rel="icon" type="image/png" href="alamat favicon" />

			<script type="text/javascript">
				$("#slideshow > div:gt(0)").hide();

				setInterval(function() { 
				  $('#slideshow > div:first')
					.fadeOut(1000)
					.next()
					.fadeIn(1000)
					.end()
					.appendTo('#slideshow');
				},  3000);
			</script>
	  <meta charset="UTF-8">
	  
	  <title>Data Mahasiswa</title>
	  <script src="http://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>


	  
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="bootstrap-theme.min.css">
		<link rel="stylesheet" href="bootstrapValidator.min.css">
		<link rel="stylesheet" href="css/form.css">

	  
	</head>

<body>
<div class="content">
	<h1>TRANSNANGOR</h1>
	<div class="main">
		<h2>Data Mahasiswa</h2>
		<div class="accordion-content" style="margin-bottom: 30px;">
		<form class="form-horizontal" id="form" name="form" action="save.php" method="post">
			<fieldset>


			
			<!-- Pengisisan NIM -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="nim">NIM</label>  
			  <div class="col-md-4">
			  <input id="nim" name="nim" type="text" placeholder="NIM" class="form-control input-md" required="">
				
			  </div>
			</div>

			<!-- Nama mahasiswa -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="nama">Nama</label>  
			  <div class="col-md-4">
			  <input id="nama" name="nama" type="text" placeholder="Nama" class="form-control input-md" required="">
				
			  </div>
			</div>


			<!-- Email mahasiswa -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="email">Email</label>  
			  <div class="col-md-4">
			  <input id="email" name="email" type="text" placeholder="Email" class="form-control input-md" required="">
				
			  </div>
			</div>

			<!-- Telepon -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="telepon">Telepon</label>  
			  <div class="col-md-4">
			  <input id="telepon" name="telepon" type="text" placeholder="Telepon" class="form-control input-md">
				
			  </div>
			</div>

			<!-- Alamat -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="alamat">Alamat</label>  
			  <div class="col-md-4">
			  <input id="alamat" name="alamat" type="text" placeholder="Alamat" class="form-control input-md">
				
			  </div>
			</div>

			
			  <input id="kursi" name="kursi" type="hidden" value="
			  <?php
			  	echo $setnum
			  ?>
			  " >


			<?php
			?>
			<br>
			
			<!-- Button -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="singlebutton"></label>
			  <div class="col-md-4">
				<button id="singlebutton" name="singlebutton" class="btn btn-primary">Pesan</button>
			  </div>
			</div>

			</fieldset>
			</form>

	</div>
</div>
</div>

</body>
</html>

