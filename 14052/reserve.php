<?php
	//Start session
	include('db.php');
	session_start();
	$_SESSION['rute'] = $_POST['rute'];
	$_SESSION['tanggal'] = $_POST['tanggal'];
	$rute=$_POST['rute'];
	$tanggal=$_POST['tanggal'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pesan Kursi</title>

	<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/jquery.seat-charts.css">
	<link href="css/newstyle.css" rel="stylesheet" type="text/css" media="all" />
	<script src="js/jquery-1.11.0.min.js"></script>
	<script src="js/jquery.seat-charts.js"></script>
</head>
<body>
	<div class="content">
		<h1>TRANSNANGOR</h1>
		<div class="main">
			<h2>Pesan Kursi Sekarang</h2>
			<!-- Penyimpanan variabel kursi yang telah dipesan -->
			<input type="hidden" id="notavailable" name="notavailable" value="<?php
			$result = $bd->query("SELECT Seat FROM rute, pemesanan WHERE rute.IDRute = pemesanan.IDRute AND rute.IDRute='$rute' AND Tanggal = '$tanggal'");
			$i = 0;
			$numRows = $result->num_rows;
			while($row = $result->fetch_assoc())
			{
				$i = $i + 1;
				echo $row["Seat"];
				if ($i != $numRows)
				{
					echo " ";
				}
			}
			?>"
			>

			<div class="wrapper">
				<div id="seat-map">
					<div class="front-indicator"><h3>Depan</h3></div>
				</div>
				<div class="booking-details">
					<div id="legend"></div>

					<form id="form" name="form" action="form.php" method="post">
						<input type="hidden" id="kursi" name="kursi" value="">
						<h3> Kursi yang dipilih (<span id="counter">0</span>):</h3>
						<ul id="selected-seats" ></ul>

						<button class="checkout-button" type="submit">Selanjutnya</button>
					</form>
				</div>
				<div class="clear"></div>
			</div>				
			<script>
				var firstSeatLabel = 1;

				$(document).ready(function() {
					var $cart = $('#selected-seats'),
					$counter = $('#counter'),
					sc = $('#seat-map').seatCharts({
						map: [
						'ee_ee',
						'ee_ee',
						'ee_ee',
						'ee_ee',
						'ee_ee',
						'ee_ee',
						'eeeee',
						],
						seats: {

							e: {
								price   : 0,
										classes : 'economy-class', 
										category: 'Economy Class'
									}					

								},
								naming : {
									top : false,
									getLabel : function (character, row, column) {
										return firstSeatLabel++;
									},
								},
								legend : {
									node : $('#legend'),
									items : [
									[ 'e', 'available',   'Tersedia'],
									[ 'f', 'unavailable', 'Sudah Dipesan']
									]					
								},
								click: function () {
									if (this.status() == 'available') {
										//let's create a new <li> which we'll add to the cart items
										$('<li> Kursi nomor : '+this.settings.label+'</b> <a href="#" class="cancel-cart-item">[cancel]</a></li>')

										.attr('id', 'cart-item-'+this.settings.id)
										.data('seatId', this.settings.id)
										.appendTo($cart);


										var kursi =this.settings.label;
										document.getElementById("kursi").value = JSON.stringify(kursi);

										$counter.text(sc.find('selected').length+1);

										 return 'selected';
										} else if (this.status() == 'selected') {
										
										//update counter
										$counter.text(sc.find('selected').length-1);
										

										//menghapus item dari cart
										$('#cart-item-'+this.settings.id).remove();

										//seat has been vacated
										return 'available';
									} else if (this.status() == 'unavailable') {
										
										//seat has been already booked
										return 'unavailable';
									} else {
										return this.style();
									}
								}
							});

							//thandle "[cancel]" link clicks
							$('#selected-seats').on('click', '.cancel-cart-item', function () {
								//let's just trigger Click event on the appropriate seat, so we don't have to repeat the logic here
								sc.get($(this).parents('li:first').data('seatId')).click();
							});

							//kursi yang not available
							var arraykursi = document.getElementById("notavailable").value; 
							var nakursi = arraykursi.split(" ");
							var blok= [ ];

							for (i = 0; i < nakursi.length; i++)
							{
								if (nakursi[i]=="1") {
									blok.push("1_1");
								} else if (nakursi[i]=="2") {
									blok.push("1_2");
								} else if (nakursi[i]=="3") {
									blok.push("1_4");
								} else if (nakursi[i]=="4") {
									blok.push("1_5");
								} else if (nakursi[i]=="5") {
									blok.push("2_2");
								} else if (nakursi[i]=="6") {
									blok.push("2_2");
								} else if (nakursi[i]=="7") {
									blok.push("2_4");
								} else if (nakursi[i]=="8") {
									blok.push("2_5");
								} else if (nakursi[i]=="9") {
									blok.push("3_1");
								} else if (nakursi[i]=="10") {
									blok.push("3_2");
								} else if (nakursi[i]=="11") {
									blok.push("3_4");
								} else if (nakursi[i]=="12") {
									blok.push("3_5");
								} else if (nakursi[i]=="13") {
									blok.push("4_1");
								} else if (nakursi[i]=="14") {
									blok.push("4_2");
								} else if (nakursi[i]=="15") {
									blok.push("4_4");
								} else if (nakursi[i]=="16") {
									blok.push("4_5");
								} else if (nakursi[i]=="17") {
									blok.push("5_1");
								} else if (nakursi[i]=="18") {
									blok.push("5_2");
								} else if (nakursi[i]=="19") {
									blok.push("5_4");
								} else if (nakursi[i]=="20") {
									blok.push("5_5");
								} else if (nakursi[i]=="21") {
									blok.push("6_1");
								} else if (nakursi[i]=="22") {
									blok.push("6_2");
								} else if (nakursi[i]=="23") {
									blok.push("6_4");
								} else if (nakursi[i]=="24") {
									blok.push("6_5");
								} else if (nakursi[i]=="25") {
									blok.push("7_1");
								} else if (nakursi[i]=="26") {
									blok.push("7_2");
								} else if (nakursi[i]=="27") {
									blok.push("7_3");
								} else if (nakursi[i]=="28") {
									blok.push("7_4");
								} else if (nakursi[i]=="29") {
									blok.push("7_5");
								}
							}
							console.log(blok);
							sc.get(blok).status('unavailable');
						});


					</script>
				</div>

			</div>
			<script src="js/jquery.nicescroll.js"></script>
			<script src="js/scripts.js"></script>
		</body>
		</html>
