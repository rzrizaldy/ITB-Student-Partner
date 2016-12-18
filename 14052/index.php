<?php
	session_start();
	include "db.php";

?>
<!DOCTYPE html>
<html>
	<head>
		<title>TRANSNANGOR</title>

			<!-- HEADER -->
			<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
			<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- 			<link rel="stylesheet" type="text/css" href="css/jquery.seat-charts.css">
 -->			<link href="css/newstyle.css" rel="stylesheet" type="text/css" media="all" />
<!-- 			<script src="js/jquery-1.11.0.min.js"></script>
 --><!-- 			<script src="js/jquery.seat-charts.js"></script>
 -->			
			<link rel="icon" type="image/png" href="alamat favicon" />


			<script src="js/jquery-1.5.min.js" type="text/javascript" charset="utf-8"></script>
			<!-- <script src="vallenato/vallenato.js" type="text/javascript" charset="utf-8"></script> -->
			<!-- <link rel="stylesheet" href="vallenato/vallenato.css" type="text/css" media="screen" charset="utf-8"> -->

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
				<!--sa calendar-->	
					<script type="text/javascript" src="js/datepicker.js"></script>
					<link href="css/demo.css"       rel="stylesheet" type="text/css" />
					<link href="css/datepicker.css" rel="stylesheet" type="text/css" />
					<script type="text/javascript">


					function makeTwoChars(inp) {
							return String(inp).length < 2 ? "0" + inp : inp;
					}

					function initialiseInputs() {
							// Clear any old values from the inputs (that might be cached by the browser after a page reload)
							document.getElementById("sd").value = "";
							document.getElementById("ed").value = "";

							// Add the onchange event handler to the start date input
							datePickerController.addEvent(document.getElementById("sd"), "change", setReservationDates);
					}

					var initAttempts = 0;

					function setReservationDates(e) {
				

							try {
									var sd = datePickerController.getDatePicker("sd");
									var ed = datePickerController.getDatePicker("ed");
							} catch (err) {
									if(initAttempts++ < 10) setTimeout("setReservationDates()", 50);
									return;
							}

							
							var dt = datePickerController.dateFormat(this.value, sd.format.charAt(0) == "m");

							// If the input's value cannot be parsed as a valid date then return
							if(dt == 0) return;

							
							// Grab the value set within the endDate input and parse it using the dateFormat method
							// N.B: The second parameter to the dateFormat function, if TRUE, tells the function to favour the m-d-y date format
							var edv = datePickerController.dateFormat(document.getElementById("ed").value, ed.format.charAt(0) == "m");

							// Set the low range of the second datePicker to be the date parsed from the first
							ed.setRangeLow( dt );
							
							// If theres a value already present within the end date input and it's smaller than the start date
							// then clear the end date value
							if(edv < dt) {
									document.getElementById("ed").value = "";
							}
					}

					function removeInputEvents() {
							// Remove the onchange event handler set within the function initialiseInputs
							datePickerController.removeEvent(document.getElementById("sd"), "change", setReservationDates);
					}

					datePickerController.addEvent(window, 'load', initialiseInputs);
					datePickerController.addEvent(window, 'unload', removeInputEvents);

					//]]>
					</script> 

	</head>
	<body>
	<div class="content" style="padding-top:7% !important">
		<h1>TRANSNANGOR</h1>
		<div class="main">
			
							
			<h2>Pemesanan Tiket</h2>
			<div class="accordion-content" style="margin-bottom: 0px;">
				<form action="reserve.php" method="post" style="margin-bottom:none;">
				<center>						
				<span>Tanggal Keberangkatan</span> <br>
				<span><input type="text" class="w8em format-d-m-y highlight-days-67 range-low-today" name="tanggal" id="tanggal" value="" maxlength="10" readonly="readonly" style="width: 200px; padding:5px 10px;"/>
				</span><br><br>
				
				<span>Waktu</span><br>
				<span>
				<select name="rute" style="width: 191px; margin-left: 15px; border: 3px double #CCCCCC; padding:5px 10px;"/>
			<?php
			include('db.php');
			$result = $bd->query("SELECT * FROM rute");
			while($row = $result->fetch_assoc())
				{
					echo '<option value="'.$row['IDRute'].'">';
					echo $row['NamaRute'].' : '.$row['berangkat'].' - '.$row['sampai'];
					echo '</option>';
				}
			?>
			
				</select>
				</span><br>

				<br>
				<input type="submit" id="submit" value="Pesan" style="height: 34px; margin-left: 15px; width: 191px; padding: 5px; border: 3px double rgb(204, 204, 204);" />
				</form>
				</center>
			</div>
		</div>
	</div>
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	</body>
</html>