<!DOCTYPE html>
<html>
<head>
	<title>Fin-LIB</title>
	<?php
	include ('map.php');
	?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	
	<script type="text/javascript">
		 $(document).ready(function(){
		 	$("#about,#map,#list").hide();
		 	$("#ab").click(function() {
		 		$("#about").fadeIn(150);
		       $("#about").show();
		       $("#map,#list").hide();
		    });
		    
		    $("#m").click(function() {
		       $("#about,#list").hide();
		       $("#map").fadeIn(150);
		       $("#map").show();
		       initMap();
		    });
		    
		    $("#l").click(function() {
		       $("#about,#map").hide();
		       $("#map").hide();
		       $("#list").fadeIn(150);
		       $("#list").show();
		     });

		 });
	</script>
	

</head>
<body onload="initMap()">
 	<h2 style="font-family: Berlin Sans Fb;color:rgba(11,72,107,1);text-align: center; font-size: 25pt">
 	FINLIB : Temukan Taman Baca di Kota Bandung</h2>
 	<div class= "tengah">
 		<a href="#"><div id="ab" class="select">About</div></a>
 		<a href="#"><div id="m" class="select">Map</div></a>
 		<a href="#"><div id="l" class="select">List</div></a>
 	</div>
 		
 	<div id = "about">
		Finlib merupakan API untuk menampilkan informasi keberadaaan perpustakaan di Kota Bandung dengan menggunakan GMAPS API<br><br>

		Creator : 
		Santo Wijaya
		18214028
	</div>
	<div id ="map">
	</div>

	<div id ="list">
	<?php
		showlist();
	?>
	</div>

</body>
</html>