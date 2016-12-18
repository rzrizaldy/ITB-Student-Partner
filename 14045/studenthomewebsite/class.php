<!DOCTYPE html>

<?php
	include "/includes/getclass.php";

	$con = openconnection();

	$userid = $_GET['userid'];
	$classid = $_GET['classid'];

	$class = getclassdetails($classid, $con);
	$otherclass = getotherclass($userid, $classid, $con);
	$announcements = getclassannouncements($userid, $classid, $con);
	$assignments = getclassassignments($userid, $classid, $con);
	$scores = getscore($userid, $classid, $con);
	$journal = getclassjournal($userid, $classid, $con);
	$isadmin = isadmin($userid, $classid, $con);

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
	<link rel="stylesheet" type="text/css" href="css/stylesheet-class.css">

	<title>Studyhawke | <?php echo $class[2] ?></title>
</head>

<body>
	<ul class="menubar" style="width:75px">
		<li class="menu"><i class="fa fa-home fa-2x" aria-hidden="true"></i></li>
		<li class="menu"><i class="fa fa-comment fa-2x" aria-hidden="true"></i></li>
		<li class="menu"><i class="fa fa-tasks fa-2x" aria-hidden="true"></i></li>
		<li class="menu"><i class="fa fa-graduation-cap fa-2x" aria-hidden="true"></i></li>
	</ul>
	<div class="navigator">
		<div class="navigatorhead row">
			<div class="navigatortitle col-12">
				<h2><?php echo $class[1] ?></h2>
				<p><?php echo $class[2] ?></p>
			</div>
		</div>
		<div class="navigatorlist row">
			<?php if ($classid != 'ALL'){
			echo "<div class='navigatorelement row'>
				<a href='/class.php?userid=" . $userid . "&classid=ALL'><table><tr><td class='tableclass'>ALL</td></a>
				<td class='tablename'>All Classes</td></tr></table>
			</div> ";
			}
			foreach ($otherclass as $class){
			?>
			<div class="navigatorelement row">
				<?php $i = 1;?>
				<?php echo "<a href='/class.php?userid=" . $userid . "&classid=" . $class[$i] . "'><table><tr><td class='tableclass'>" . $class[$i] . "</td></a>";
				$i = $i + 1;
				echo "<td class='tablename'>" . $class[$i] . "</td></tr></table>"; ?>
			</div>
		<?php } ?>
		</div>
	</div>
	<div class="container">
		<div class="mainbody">
			<div class="bodycontents col-12">
				<div class="bodybar col-12">
					<ul class="bodymenu col-12">
						<li><a href="#announcements">Announcements</a></li>
						<li><a href="#assignments">Assignments</a></li>
						<li><a href="#scores">Scores</a></li>
						<li><a href="#journal">Class Journal</a></li>
					</ul>
				</div>
				<div id="announcements" class="bodyelements col-12">
					<h1>Announcements</h1>
					<?php if ((mysqli_num_rows($announcements)) == 0){?>
						<p><?php echo "No announcements..." ?></p>
					<?php } else {
						while ($row = mysqli_fetch_array($announcements)) { ?>
							<div class="bodysubelement col-12">
								<?php if ($classid == 'ALL'){?>
									<h3><?php echo $row[ 'ClassID' ] . ": " . $row[ 'Title' ] ?></h3>
								<?php } else { ?>
									<h3><?php echo $row[ 'Title' ] ?></h3>
								<?php } ?>
								<p><?php echo $row[ 'Content' ] ?></p>
							</div>
						<?php } ?>
					<?php }
					if ($isadmin){
						echo "<a href='/progif/submit.php?userid=" . $userid . "&classid=" . $classid . "&type=announcement'>(New...)</a>";
					} ?>
				</div>
				<div id="assignments" class="bodyelements col-12">
					<h1>Assignments</h1>
					<?php if ((mysqli_num_rows($assignments)) == 0){?>
						<p><?php echo "No assignments..." ?></p>
					<?php } else {
						while ($row = mysqli_fetch_array($assignments)) { ?>
							<div class="bodysubelement col-12">
								<?php if ($classid == 'ALL'){?>
									<h3><?php echo $row[ 'ClassID' ] . ": " . $row[ 'Title' ] ?></h3>
								<?php } else { ?>
									<h3><?php echo $row[ 'Title' ] ?></h3>
								<?php } ?>
								<p><?php echo $row[ 'Details' ] ?></p>
							</div>
						<?php } ?>
					<?php }
					if ($isadmin){
						echo "<a href='/progif/submit.php?userid=" . $userid . "&classid=" . $classid . "&type=assignment'>(New...)</a>";
					} ?>
				</div>
				<div id="scores" class="bodyelements col-12">
					<h1>Scores</h1>
					<table>
						<?php foreach ($scores as $score){ ?>
						<tr>
							<td style='width: 120px;'> <?php echo $score[0];?> </td>
							<td> <?php echo $score[1];?> </td>
						</tr>
						<?php } ?>
					</table>
				</div>
				<div id="journal" class="bodyelements col-12">
					<h1>Class Journal</h1>
					<?php if ((mysqli_num_rows($journal)) == 0){?>
						<p><?php echo "Journal empty." ?></p>
					<?php } else {
						while ($row = mysqli_fetch_array($journal)) { ?>
							<div class="bodysubelement col-12" <?php if (!$row[ 'Status' ]){echo " style='border-left: 3px solid #fff'";} ?>>
								<h3><?php if ($classid == 'ALL'){
									echo $row[ 'ClassID' ] . ": ";
								}
								echo $row[ 'Topic' ] ?></h3>
								<p><?php echo $row[ 'DAYNAME(Date)' ] . ", " . $row[ "DATE_FORMAT(Date, '%D')" ] . " " . $row[ 'MONTHNAME(Date)' ] . " " . $row[ 'YEAR(Date)' ] ?></p>
							</div>
						<?php } ?>
					<?php }
					if ($isadmin){
						echo "<a href='/progif/submit.php?userid=" . $userid . "&classid=" . $classid . "&type=journalstudent'>(Edit...)</a>";
					} ?>
				</div>
			</div>
		</div>
	</div>
</body>
