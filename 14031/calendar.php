<?php
	$dbhost = 'sql6.freemysqlhosting.net';
	$dbuser = 'sql6149310';
	$dbpassword = 'vQLBnzaQb6';
	$dbname = 'sql6149310';
	
	$con = mysqli_connect($dbhost,$dbuser,$dbpassword);
	
	if(!$con){
		echo "Failed to connect to MySQL: " . mysqli_error();
	} else {
		echo "Connected to db";
	}
	mysqli_select_db($con, $dbname);
?>

<html>
	<head>
		<script>
			function goLastMonth(month, year){	
				if (month == 1){
					--year;
					month = 13;
				}
				--month
				var monthstring = ""+month+"";
				var monthlength = monthstring.length;
				if (monthlength <= 1){
					monthstring = "0"+monthstring;
				}
				document.location.href = "<?php $_SERVER['PHP_SELF'];?>?month="+monthstring+"&year="+year;
			}
			
			function goNextMonth(month, year){
				if (month == 12){
					++year;
					month = 0;
				}
				++month
				var monthstring = ""+month+"";
				var monthlength = monthstring.length;
				if (monthlength <= 1){
					monthstring = "0"+monthstring;
				}
				document.location.href = "<?php $_SERVER['PHP_SELF'];?>?month="+monthstring+"&year="+year;
			}
		</script>
		<style>
			.today {
				background-color: #00ff00;
			}
			.event {
				background-color: #f0ff00;
			}
		</style>
	</head>
	
	<body align = 'center'>
		<?php
			if (isset($_GET['day'])){
				$day = $_GET['day'];
			} else {
				$day = date("j");
			}
			
			if (isset($_GET['month'])){
				$month = $_GET['month'];
			} else {
				$month = date("n");
			}
			
			if (isset($_GET['year'])){
				$year = $_GET['year'];
			} else {
				$year = date("Y");
			}
			
			//calendar variable
			$currentTimeStamp = strtotime("$year-$month-$day");
			$monthName = date("F", $currentTimeStamp);
			$numDays = date("t", $currentTimeStamp);
			$counter = 0;
			?>
			
			<?php
			if (isset($_GET['add'])){
				$title = $_POST['txttitle'];
				$detail = $_POST['txtdetail'];
				
				$eventdate = $month."/".$day."/".$year;
				
				$sqlinsert = "insert into eventcalendar (title, detail, eventDate, dateAdded) values ('".$title."','".$detail."','".$eventdate."',now())";
				$resultinsert = mysqli_query($con,$sqlinsert);
				if ($resultinsert){
					echo "Event was successfully Added...";
				} else {
					echo "Event failed to be Added...";
				}
			}
		?>
		
		<table border = '1' align = 'center'>
			<tr>
				<td><input style='width:50px' type = 'button' value = '<' name = 'previousbutton' onclick="goLastMonth(<?php echo $month.",".$year; ?>)"></td>
				<td colspan = '5'> <?php echo $monthName." ".$year; ?> </td>
				<td><input style='width:50px' type = 'button' value = '>' name = 'nextbutton' onclick="goNextMonth(<?php echo $month.",".$year; ?>)"></td>
			</tr>
			<tr>
				<td width = '50px'>Sun</td>
				<td width = '50px'>Mon</td>
				<td width = '50px'>Tue</td>
				<td width = '50px'>Wed</td>
				<td width = '50px'>Thu</td>
				<td width = '50px'>Fri</td>
				<td width = '50px'>Sat</td>
			</tr>
			
			<?php
				echo "<tr>";
				
				for ($i = 1; $i < $numDays+1; $i++, $counter++){
					$timeStamp = strtotime("$year-$month-$i");
					if($i == 1){
						$firstDay = date("w", $timeStamp);
						for ( $j = 0; $j< $firstDay; $j++, $counter++){
							//blank space
							echo "<td>&nbsp;</td>";
						}
					}
					if ($counter % 7 == 0){
						echo "</tr><tr>";
					}
					$monthstring = $month;
					$monthlength = strlen($monthstring);
					$daystring = $i;
					$daylength = strlen($daystring);
					if ($monthlength <= 1){
						$monthstring = "0".$monthstring;
					}
					if ($daylength <= 1){
						$daystring = "0".$daystring;
					}
					$todaysDate = date("m/d/Y");
					$dateToCompare = $monthstring.'/'.$daystring.'/'.$year;

					echo "<td align = 'center' ";
					if ($todaysDate == $dateToCompare){
						echo "class='today'";
					} else{
						$sqlCount = "select * from eventcalendar where eventDate='".$dateToCompare."'";
						$noOfEvent = mysqli_num_rows(mysqli_query($con,$sqlCount));
						if ($noOfEvent >= 1){
							echo "class='event'";
						}
					}
					echo "><a href='".$_SERVER['PHP_SELF']."?month=".$monthstring."&day=".$daystring."&year=".$year."&v=true'>".$i."</a></td>";
				}
				
				echo "</tr>";
			?>
			
		</table>
		<?php
			if (isset($_GET['v'])){
				echo "<hr>";
				echo "<a href='".$_SERVER['PHP_SELF']."?month=".$month."&day=".$day."&year=".$year."&v=true&f=true'>Add Event</a>";
				if (isset($_GET['f'])){
					include("eventform.php");
				}
				$sqlEvent = "select * from eventcalendar where eventDate='".$month."/".$day."/".$year."'";
				$resultEvents = mysqli_query($con,$sqlEvent);
				echo "<hr>";
				if ($events = mysqli_fetch_array($resultEvents)){
					echo "Title : ".$events['title']."<br>";
					echo "Detail : ".$events['detail']."<br>";
				}
			}
			
			//include('harilibur.php');
		?>
		
	</body>

</html>
