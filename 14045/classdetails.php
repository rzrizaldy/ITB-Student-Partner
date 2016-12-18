<!DOCTYPE html>

<?php
	include "/includes/getdosen.php";

	$userid = $_GET['userid'];
	$classid = $_GET['classid'];

	$con = openconnection();
	$datas = getclass($userid, $con);
	$journal = getclassjournal($userid, $classid, $con);
	$username = getuserdetail($userid, $con);
	$classdetails = getclassdetails($classid, $con);


	if ($_GET['section'] == 'announcement'){
		$option1 = 'Announcement'; $dir1 = 'announcement';
		$option2 = 'Scores'; $dir2 = 'scores';
		$option3 = 'Class Journal'; $dir3 = 'journal';
		$option4 = 'Assignments'; $dir4 = 'assignment';
	} elseif ($_GET['section'] == 'scores'){
		$option2 = 'Announcement'; $dir2 = 'announcement';
		$option1 = 'Scores'; $dir1 = 'scores';
		$option3 = 'Class Journal'; $dir3 = 'journal';
		$option4 = 'Assignments'; $dir4 = 'assignment';
	} elseif ($_GET['section'] == 'journal'){
		$option2 = 'Announcement'; $dir2 = 'announcement';
		$option3 = 'Scores'; $dir3 = 'scores';
		$option1 = 'Class Journal'; $dir1 = 'journal';
		$option4 = 'Assignments'; $dir4 = 'assignment';
	} elseif ($_GET['section'] == 'assignment'){
		$option2 = 'Announcement'; $dir2 = 'announcement';
		$option3 = 'Scores'; $dir3 = 'scores';
		$option4 = 'Class Journal'; $dir4 = 'journal';
		$option1 = 'Assignments'; $dir1 = 'assignment';
	}
?>

<html>
<head>
	<meta charset="UTF-8">
	<meta name="description" content="Organize your studying life">
	<meta name="keywords" content="HTML,CSS,XML,JavaScript">
	<meta name="author" content="Sydha Septifika Puteri Rohima">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700|Raleway:300,400,600" rel="stylesheet">

	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/stylesheet-details.css">

	<title>Studyhawke | <?php echo $classid ?></title>
</head>

<body>
	<ul class="menubar" style="width:75px">
		<li class="menu"><i class="fa fa-home fa-2x" aria-hidden="true"></i></li>
		<li class="menu"><i class="fa fa-comment fa-2x" aria-hidden="true"></i></li>
		<li class="menu"><i class="fa fa-tasks fa-2x" aria-hidden="true"></i></li>
		<li class="menu"><i class="fa fa-graduation-cap fa-2x" aria-hidden="true"></i></li>
	</ul>
	<div class="container">
		<div class="mainbody">
			<div class="header row">
				<div class="col-1" style="height:55vh">
				</div>
				<div class="welcome col-10"  style="height:55vh">
					<h1><?php echo $classid . ": " . $classdetails[1]?></h1>
					<p><br>Latest announcement</p>
				</div>
				<div class="col-1" style="height:55vh">
				</div>
			</div>
			<div class="bg row">
				<div class="frontbg col-10">
					<div class="upcoming row">
						<div class="upcomingcontents col-12">
							<h2><?php echo $option1 ?></h2>
							<?php if ($option1 == 'Announcement'){
								showclassannouncements($userid, $classid, $con);
							} elseif ($option1 == 'Scores'){
								showscorecriteria($classid, $con);
							} elseif ($option1 == 'Class Journal'){
								showclassjournal($userid, $classid, $con);
							} elseif ($option1 == 'Assignments'){
								showclassassignments($classid, $con);
							}
							echo "<a href='/progif/submit.php?userid=" . $userid . "&classid=" . $classid . "&type=" . $dir1 . "'>(New...)</a>";
							?>
						</div>
					</div>
				</div>
				<div class="downbgcon col-10">
					<div class="downbg left">
						<a href="<?php echo '/progif/classdetails.php?userid=' . $userid . '&classid=' . $classid . '&section=' . $dir2?>"><h2><?php echo $option2 ?></h2></a>
					</div>
					<div class="downbg left right">
						<a href="<?php echo '/progif/classdetails.php?userid=' . $userid . '&classid=' . $classid . '&section=' . $dir3?>"><h2><?php echo $option3 ?></h2></a>
					</div>
					<div class="downbg right">
						<a href="<?php echo '/progif/classdetails.php?userid=' . $userid . '&classid=' . $classid . '&section=' . $dir4?>"><h2><?php echo $option4 ?></h2></a>
					</div>
				</div>
			</div>
			<div class="class row">
				<div class="classcontents col-12">
					<div class="classtitle col-12">
						<p>Classes</p>
					</div>
					<div class="col-12">
						<?php
							foreach ($datas as $data){
						?>
							<a href= "<?php echo '/progif/classdetails.php?userid=' . $userid . '&classid=' . $data[1] . '&section=' . $dir1 ?>"><div class="classes col-3">
								<?php $i = 0;?>
								<div class="classinitials hovering">
									<p><?php echo $data[$i]; ?></p>
								</div>
								<?php $i = $i + 1; ?>
								<p class = "classcode hovering"><?php echo $data[$i]; ?></p>
								<?php $i = $i + 1; ?>
								<p class = "classname hovering"><?php echo $data[$i]; ?></p>
							</div></a>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="footer">
				<p>Studyhawke | Designed and created by Sydha Septifika Puteri Rohima (18214045) | Insert credits here</p>
			</div>
		</div>
	</div>
	<?php closeconnection($con); ?>
</body>
</html>
