<?php
$homepage = file_get_contents('http://rsborromeus.com/components/com_jadwalpraktek/views/jadwalpraktek/tmpl/new/gabung.php');

//mencari tag select dokter
preg_match_all('/<select[^>]+?dokter[^>]+?>(.*?)<\/select>/s', $homepage, $matches);
$options = $matches[1];
foreach ($options as $select) {
    //mencari tag option value dan memasukannya pada variabel $matches
	preg_match_all('/<option value="(.*?)"\s*>(.*?)<\/option>/', $select, $matches, PREG_SET_ORDER);
}   


//mencari tag select spesialis
preg_match_all('/<select[^>]+?spesialis[^>]+?>(.*?)<\/select>/s', $homepage, $cocok);
$options = $cocok[1];
foreach ($options as $select) {
    //mencari tag option value dan memasukannya pada variabel $cocok
	preg_match_all('/<option value="(.*?)"\s*>(.*?)<\/option>/', $select, $cocok, PREG_SET_ORDER);
}
?>

<!DOCTYPE html>
<html>
   
   <head>
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pendaftaran Antrean Dokter di RS Borromeus</title>
        <link href="./css/bootstrap.min.css" rel="stylesheet">
        <link href="./css/stylelogin.css" rel="stylesheet">
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

				// Check the value of the input is a date of the correct format
				var dt = datePickerController.dateFormat(this.value, sd.format.charAt(0) == "m");

				// If the input's value cannot be parsed as a valid date then return
				if(dt == 0) return;

				// At this stage we have a valid YYYYMMDD date

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
	  <div class="wrapperlogin" align = "center">
        <div class='containerlogin'>
            <h3 style="color:#fff"> Kini daftar antrean di RS Borromeus lebih mudah!</h5>
    <form action="connect.php" method = "POST">
       <input type="hidden" name="formID" value="63319183295461" />
		<div class="form-all">
			<input type = "text" name = "fullname" style="width: 250px; border: 3px double #CCCCCC; padding:15px 10px;" class = "box" placeholder="Nama Lengkap "/><br />
			<input type = "text" name = "phone"  style="width: 250px; border: 3px double #CCCCCC; padding:15px 10px;" class = "box" placeholder="Telepon "/>
			<label style="color:#fff" align = "center">Spesialis</label></br>	
				<select class="box" align = "center" style="width: 250px; border: 3px double #CCCCCC; padding:5px 10px;" name ="specialty"> 
				<?php		
				//memanggil variabel cocok untuk ditampilkan
					foreach ($cocok as $val) {
						echo "<option value='$val[1]'>$val[1]</option>".'<br>'; //menampilkan semua value
					}
				?>
				</select></br>
			<label style="color:#fff" align = "center">Nama Dokter</label></br>	
				<select class="box" align = "center" style="width: 250px; border: 3px double #CCCCCC; padding:5px 10px;" name ="doctorname"> 
				<?php		
				//memanggil variabel cocok untuk ditampilkan
					foreach ($matches as $val) {
						echo "<option value='$val[1]'>$val[1]</option>".'<br>'; //menampilkan semua value
					}
				?>
				</select></br>
				<label style="color:#fff" align = "center">Pilihan Hari</label></br>	
					<input type="text" align = "center" class="w8em format-d-m-y highlight-days-67 range-low-today" name="date" id="sd" value="" maxlength="10" readonly="readonly" style="width: 250px; border: 3px double #CCCCCC; padding:15px 10px;"/>
				<br>
				<label style="color:#fff" align = "center">Pilihan Jadwal</label></br>		
				<select class="box" align = "center" style="width: 250px; border: 3px double #CCCCCC; padding:5px 10px;" name ="schedule"> 
				 <option>  </option>
				<option value="pagi"> Pagi (08:00 - 11:00)</option>
				<option value="siang"> Siang (13:00 - 16:00)</option>
				</select></br></br>
				<button id = "submit" type = "submit" onclick = "return showAntrean();" style="width: 150px; border: 3px double #CCCCCC; padding:5px 10px;" name="submit" >Daftar</button>
        
		</div>
		</div>
    </form>
				<ul class='bg-bubbles'>
                  <li/>
                  <li/>
                  <li/>
                  <li/>
                  <li/>
                  <li/>
                  <li/>
                  <li/>
                  <li/>
                  <li/>
               </ul>
         </div>
			
      </div>
   </body>
</html>