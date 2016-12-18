<!DOCTYPE html>

<?php
	include "/includes/submitter.php";

	$userid = $_GET['userid'];
	$classid = $_GET['classid'];
	$type = $_GET['type'];

	$classdet = getclassdetails($classid);
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
	<link rel="stylesheet" type="text/css" href="css/stylesheet-submit.css">

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
			<div class="submitbody">
				<div class="submitbodytext">
					<h1><?php echo "New " . $type ?></h1>
					<h3><?php echo $classid . ": " . $classdet[2] ?></h3>
				</div>
				<div class="submitbodyform">
				<?php if ($type == 'announcement'){?>
					<form action="/actions.php" id="announcement">
						<input type="hidden" name="action" value="<?php echo $type ?>" />
						<input type="hidden" name="userid" value="<?php echo $userid ?>" />
						<input type="hidden" name="classid" value="<?php echo $classid ?>" />
						<p>Title <br></p>
						<input type="text" name="title" size="100"><br>
						<p>Content<br></p>
						<textarea name="content" form="announcement" style="width:733px; height: 200px">Enter text here...</textarea><br>
						<input type="submit" value="Submit">
					</form>
				<?php } elseif ($type == 'scores'){ ?>
					<form action="/actions.php" id="scores">
						<input type="hidden" name="action" value="<?php echo $type ?>" />
						<p>NIM Mahasiswa <br></p>
						<input type="number" name="userid" size="100"><br>
						<input type="hidden" name="classid" value="<?php echo $classid ?>" />
						<p>Kriteria</br></p>
						<?php $criteria = getcriteria($classid);
						if (mysqli_num_rows($criteria) == 0){
							echo "No definable criteria! Submit not allowed.";
						} else {
							while ($row = mysqli_fetch_array($criteria)) {
								echo '<input type="radio" name="criteriaid" value="' . $row[ 'CriteriaID' ] . '">' . $row[ 'Criteria' ] . '<br>';
							}
						}?>
						<p>Tanggal <br></p>
						<input type="date" name="date" size="100"><br>
						<p>Judul <br></p>
						<input type="text" name="title" size="100"><br>
						<p>Nilai <br></p>
						<input type="number" name="score" size="100"><br>
						<input type="submit">
					</form>
				<?php } elseif ($type == 'journal'){ ?>
					<form action="/actions.php" id="journal">
						<input type="hidden" name="action" value="<?php echo $type ?>" />
						<input type="hidden" name="classid" value="<?php echo $classid ?>" />
						<p>Date <br></p>
						<input type="date" name="date" size="100"><br>
						<p>Topic<br></p>
						<input type="text" name="topic" size="100"><br>
						<input type="hidden" name="status" value="0" />
						<input type="submit" value="Submit">
					</form>
				<?php } elseif ($type == 'journalstudent'){ ?>
					<form action="/actions.php" id="journalstudent">
						<input type="hidden" name="action" value="<?php echo $type ?>" />
						<input type="hidden" name="classid" value="<?php echo $classid ?>" />
						<?php $journal = getjournal($classid);
						if (mysqli_num_rows($journal) == 0){
							echo "No journal! Submit not allowed.";
						} else {
							while ($row = mysqli_fetch_array($journal)) {
								echo '<input type="radio" name="lessonid" value="' . $row[ 'LessonID' ] . '">' . $row[ 'Date' ] . '<br>';
							}
						}?>
						<p>Topic<br></p>
						<input type="text" name="topic" size="100"><br>
						<input type="submit" value="Submit">
					</form>
				<?php } elseif ($type == 'assignment'){ ?>
					<form action="/actions.php" id="assignment">
						<input type="hidden" name="action" value="<?php echo $type ?>" />
						<input type="hidden" name="classid" value="<?php echo $classid ?>" />
						<p>Title <br></p>
						<input type="text" name="title" size="100"><br>
						<p>Content<br></p>
						<textarea name="details" form="assignment" style="width:733px; height: 200px">Enter text here...</textarea><br>
						<p>Date <br></p>
						<input type="date" name="date" size="100"><br>
						<input type="submit" value="Submit">
					</form>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
</body>
