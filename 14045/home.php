<!DOCTYPE html>

<?php
	include "/includes/getdosen.php";

	$con = openconnection();
	$userid = $_GET['userid'];

	$datas = getclass($userid, $con);
	$announcement = getclassannouncements($userid, 'ALL', $con);
	$journal = getclassjournal($userid, 'ALL', $con);
	$username = getuserdetail($userid, $con);
	closeconnection($con);
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
	<link rel="stylesheet" type="text/css" href="css/stylesheet-home.css">

	<title>Studyhawke | <?php echo $username ?></title>
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
					<h1>Welcome, <?php echo $username ?></h1>
				</div>
				<div class="col-1" style="height:55vh">
				</div>
			</div>
			<div class="bg row">
				<div class="frontbg col-10">
					<div class="upcoming col-6">
						<div class="upcomingcontents col-12">
							<h2>Upcoming Lessons</h2>
							<?php if ((mysqli_num_rows($journal)) == 0){?>
								<p><?php echo "Journal empty." ?></p>
							<?php } else { ?>
								<ul>
									<?php $r = 0;
									while ($row = mysqli_fetch_array($journal)) {
										$rows[$r] = $row;
										$r = $r + 1;
									}
									if ((mysqli_num_rows($journal)) <= 2){
										$n = mysqli_num_rows($journal);
									} else {
										$n = 3;
									}
									for ($i = 0;$i < $n;$i++){ ?>
										<li><h3><?php echo $rows[$i][ 'ClassID' ] . ": " . $rows[$i][ 'Day' ] . ", " . $rows[$i][ 'Date' ] . " " . $rows[$i][ 'Month' ] . " " . $rows[$i][ 'Year' ] ?></h3>
										<p><?php echo $rows[$i][ 'Topic' ] ?></p></li>
									<?php } ?>
								</ul>
							<?php } ?>
						</div>
					</div>
					<div class="upcoming col-6">
						<div class="upcomingcontents col-12">
							<h2>Latest Announcements</h2>
							<?php if ((mysqli_num_rows($announcement)) == 0){?>
								<p><?php echo "No announcements." ?></p>
							<?php } else { ?>
								<ul>
									<?php $r = 0;
									while ($row = mysqli_fetch_array($announcement)) {
										$rows[$r] = $row;
										$r = $r + 1;
									}
									if ((mysqli_num_rows($announcement)) <= 2){
										$n = mysqli_num_rows($announcement);
									} else {
										$n = 3;
									}
									for ($i = 0;$i < $n;$i++){ ?>
										<li><h3><?php echo $rows[$i][ 'ClassID' ] . ": " . $rows[$i][ 'Title' ] ?></h3>
										<p><?php echo $rows[$i][ 'Content' ] ?></p></li>
									<?php } ?>
								</ul>
							<?php } ?>
						</div>
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
							<a href= "<?php echo '/progif/classdetails.php?userid=' . $userid . '&classid=' . $data[1] . '&section=announcement' ?>"><div class="classes col-3">
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
</body>
</html>
