<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Lokasi Gedung dan Ruangan ITB</title>

	<?php require_once('connections/connection.php'); ?>


		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!-- IcoMoon Icon Font -->
		<link rel="stylesheet" href="fonts/icomoon/icomoon.css">
		<!-- FontAwesome Icon Font -->
		<link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<!-- Owl Carousel -->
		<link href="scripts/owl-carousel/owl.carousel.css" rel="stylesheet">
		<link href="scripts/owl-carousel/owl.theme.css" rel="stylesheet">
		<link href="scripts/owl-carousel/owl.transitions.css" rel="stylesheet">
		<!-- Style.css -->
		<link href="css/style.css" rel="stylesheet">

		<link rel="shortcut icon" href="img/placeholder.png" type="image" />

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

	</head>
	<body>
		
		<!--
		
		HEADER
		
		-->
		<header class="header clearfix">
			<div class="container clearfix">
				<a href="#" class="logo"><img src="img/placeholder.png" alt="Twitch"></a>
				<a href="#" class="side-menu-open-btn"><i class="icon-menu2"></i></a>
				<nav class="main-nav">
					
					<ul>
						<li>
							<a href="#">Home <i class="fa fa-angle-down"></i></a>
							<ul>
								<li><a href="#">Gedung</a></li>
							</ul>
						</li>
						<li><a href="#">Ruangan</a></li>
					</ul>
				</nav> <!-- main-nav -->
			</div> <!-- end container -->
		</header> <!-- end header -->
		<nav class="side-menu">
			<a href="#" class="side-menu-close-btn"><i class="icon-close"></i></a>
			<ul>
				<li>
					<a href="#">Home <i class="fa fa-angle-right"></i></a>
					<ul>
						<li><a href="#">Gedung</a></li>
					</ul>
				</li>
				
				<li><a href="#">Ruangan</a></li>
			</ul>
			
		</nav> <!-- end side-menu -->



		<div class="section dark transparent page-header" style="background-image: url('img/itb.jpg');">
			<div class="section-inner">
				<div class="container clearfix">
					<div class="pull-left">
						<h1>Lokasi Gedung</h1>
						<h3 class="highlight-white">Web Service API Google Maps</h3>
					</div>
					<div class="breadcrumbs pull-right">
						Pages / <a href="#">Gedung</a>
					</div>
				</div> <!-- end container -->
			</div> <!-- end section-inner -->
		</div> <!-- end section -->

		<style>
	      #map {
	        height: 420px;
	        width: 100%;
	        background-color: grey;
	       }
	    </style>

		<div class="section white">
			<div class="section-inner">
				<div class="container">
					<h2>Search<span class="icon"><i class="icon-font"></i></span></h2>
					<div class = "col-md-12" style="padding-bottom: 12px;">
					<div class = "col-md-6" style ="border-right: 2px solid #c2c2d6">
					<input type="hidden" id="templat"/>
					<input type="hidden" id="templon"/>
					<label for="gedungid" class="required" style="display: block;">Pilih Nama Gedung</label>
					<select name="gedungid" id="gedungid" class="form-control"> 
					<?php
						$query="SELECT * FROM gedung ORDER BY id_gedung"; 
					  	$result=mysqli_query($conn, $query) or die ('Error executing statements : $query'. mysqli_error()); 
					 	if(mysqli_num_rows($result)>0) 
					 	{	
					 		echo "<option value='0' > Silahkan pilih nama gedung </option>";
					  		while($row=mysqli_fetch_object($result)) 
					  		{ 
					  			echo "<option value='".$row->id_gedung."' label='".$row->namagedung."'>".$row->namagedung."</option>";
					  		} 
					 	}else{echo "";} 
					 	mysqli_free_result($result); 
					 ?>
					</select>
					<div class ="col-md-4" style = "margin-top:12px; margin-left: 450px;">
					<a href="javascript:void(0);" id="findbtn" class = "btn btn-success"> Find! </a>
					</div>
					</div>
					
					<!-- <div style="clear:both; padding-top:12px;"></div> -->
					<div class ="col-md-2">
					<label for="txtruang" class="required" style="display: block;" >Ruangan:</label>
					<label for="txtcap" class="required" style="display: block; margin-top: 16px" >Kapasitas:</label>
					</div>
					<div class ="col-md-4"> <input type="text" id="txtruang" style="margin-bottom:12px;"/></div>
					<div class ="col-md-4"> <input type="text" id="txtcap"/></div>
					<a href="javascript:void(0);" id="searchbtn" class = "btn btn-success" style="margin-top: 8px; margin-left: 463px;"> Search! </a>
					<div id="resultmap" class ="col-md-12" style="height: 35px;"></div>
					<div id="map"> </div>
				</div> <!-- end container -->
			</div> <!-- end section-inner -->
		</div> <!-- end section -->




		

		<div class="section dark transparent" style="background-image: url('img/background04.jpg');">
			<div class="section-inner">
				
			</div> <!-- end section-inner -->
		</div> <!-- end section -->



		<div class="section white">
			<div class="section-inner">
				<div class="container">
					
					

					

				</div> <!-- end container -->
			</div> <!-- end section-inner -->
		</div> <!-- end section -->
		
		
		
		<!--
		
		FOOTER
		
		-->
		<footer class="footer">
			<div class="footer-widget-area">
				<div class="container">
					<div class="row">
						<div class="col-sm-3">
							<p><img src="img/itbtrans.png" alt="twitch" class="img-responsive"></p>
							<ul class="list-unstyled">
								<li>Address: Jalan Ganesha No.10, Bandung, West Java</li>
							</ul>
						</div> <!-- end col-sm-3 -->
						<div class="col-sm-2">
							<h5>Quick Links</h5>
							<ul class="list-unstyled">
								<li><a href="#">Gedung</a></li>
								<li><a href="#">Ruangan</a></li>
							</ul>
						</div> <!-- end col-sm-2 -->
						
					</div> <!-- end row -->
				</div> <!-- end container -->
			</div> <!-- end footer-widget-area -->
			<div class="footer-bottom">
				Developed <i class="icon-purple icon-heart2 tool-tip" title="love"></i> by <a href="#" >Tirza Fidela </a> <i class="icon-green icon-code tool-tip" title="coded"></i> 
			</div> <!-- end footer-bottom -->
		</footer> <!-- end footer -->
		
		<!-- jQuery -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<!-- Bootstrap -->
		<script src="js/bootstrap.min.js"></script>
		<!-- Backstretch -->
		<script src="js/jquery.backstretch.min.js"></script>
		<!-- Isotope -->
		<script src="js/isotope.pkgd.min.js"></script>
		<!-- Intense -->
		
		<!-- Owl Carousel -->
		<script src="scripts/owl-carousel/owl.carousel.min.js"></script>
		<!-- count to -->
		<script src="js/jquery.countTo.js"></script>
		<!-- inview -->
		<script src="js/jquery.inview.min.js"></script>
		<!-- jquery knob -->
		<script src="js/jquery.knob.min.js"></script>
		<!-- google maps -->
		
		<!-- Scripts.js -->
		<script src="js/scripts.js"></script>

		<script type="text/javascript">
		var map;
		var itb;
		var marker;
		var infowindow =null; 
		//Inisialisasi Peta
		function initMap() {
        	itb = {lat: -6.890058, lng: 107.610322};
	        map = new google.maps.Map(document.getElementById('map'), { 
	        	zoom: 16,
				center: itb
	        });
	        marker = new google.maps.Marker({
	          position: itb,
	          map: map,
	          title: ""
	        });
	        infowindow=new google.maps.InfoWindow({ content: "" });
      	}
    //Mengambil data dari gedung yang dipilih
	jQuery(function ($) { 
		
        function downloadUrl(url, callback) {
	      var request = window.ActiveXObject ?
	            new ActiveXObject('Microsoft.XMLHTTP') :
	            new XMLHttpRequest;
	      request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };
        request.open('GET', url, true);
        request.send(null);
      	}

      	function doNothing() {}

 		$("#findbtn").click(function() { 
			if($('#gedungid option:selected').val() != '0'){
				var itb = {lat: -6.892368, lng: 107.611038};
				if (window.XMLHttpRequest) {
	            // code for IE7+, Firefox, Chrome, Opera, Safari
	            xmlhttp = new XMLHttpRequest();
	        	} else {
	            // code for IE6, IE5
	            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	        	}

		        xmlhttp.onreadystatechange = function() {
		            if (this.readyState == 4 && this.status == 200) {
		                var hasil = this.responseText;
		                var arrayloc = hasil.split(";");
		                $('#templat').val(arrayloc[0]);
		                $('#templon').val(arrayloc[1]);
		                itb = {lat: parseFloat(arrayloc[0]), lng: parseFloat(arrayloc[1])};
	    			}
			};
	        xmlhttp.open("GET","getmarker.php?gid="+$('#gedungid option:selected').val(),true);
	        xmlhttp.send();

			//Mengambil data dari database ke format XML
			var infoWindow = new google.maps.InfoWindow;
		        downloadUrl('/lokasigedung/getlocation.php?gid='+$('#gedungid option:selected').val(), function(data) {
		        var xml = data.responseXML;
	            var markers = xml.documentElement.getElementsByTagName('marker');
	            Array.prototype.forEach.call(markers, function(markerElem) {
	              var name = markerElem.getAttribute('name');
	              var address = markerElem.getAttribute('address');
	              var type = markerElem.getAttribute('type');
	              var point = new google.maps.LatLng(
	                  parseFloat(markerElem.getAttribute('lat')),
	                  parseFloat(markerElem.getAttribute('lng')));

		              var infowincontent = document.createElement('div');
		              var strong = document.createElement('strong');
		              strong.textContent = name
		              infowincontent.appendChild(strong);
		              infowincontent.appendChild(document.createElement('br'));

		              var text = document.createElement('text');
		              text.textContent = address
		              infowincontent.appendChild(text);
		              //Mengganti lokasi marker
		              var latlng = new google.maps.LatLng($('#templat').val(), $('#templon').val());
		              marker.setVisible(true);
		              marker.setPosition(latlng);
		    infowindow.setContent("<h4 style='padding-bottom:1px;margin-bottom:0px;'>"+$('#gedungid option:selected').html()+"</h4>");
		              infowindow.open(map, marker);
		            });
		          });
 				} 
 				else {alert("Masukkan pilihan terlebih dahulu!")}
				}); 
		
		$("#searchbtn").click(function() { 
			if($('#txtruang').val().length==0 && $('#txtcap').val().length==0) {
				alert("Masukkan nama ruang/kapasitas!");
			} else {
				if (window.XMLHttpRequest) {
	            // code for IE7+, Firefox, Chrome, Opera, Safari
	            xmlhttp = new XMLHttpRequest();
	        	} else {
	            // code for IE6, IE5
	            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	        	}

		        xmlhttp.onreadystatechange = function() {
		            if (this.readyState == 4 && this.status == 200) {
		            	var hasil = this.responseText;
		               	var arrayloc = hasil.split(";");
		               	if(arrayloc.length>=3){
		               		infowindow.setContent("<h5 style='padding-bottom:1px;margin-bottom:0px;'>"+arrayloc[0] +"</h5> Ruangan : "+arrayloc[4]+" | Lantai : "+arrayloc[5]+" | Kapasitas "+arrayloc[6]);
			                var latlng = new google.maps.LatLng(arrayloc[1], arrayloc[2]);
				          $('#resultmap').html("Gedung : "+arrayloc[0]+" | Ruangan : "+arrayloc[4]+" | Lantai : "+arrayloc[5]+" | Kapasitas "+arrayloc[6]);  
				            marker.setAnimation(google.maps.Animation.DROP);
				            marker.setVisible(true);
				            marker.setPosition(latlng);
				            infowindow.close();
				            infowindow.open(map, marker);
			        	}else{
			        		alert("Maaf, ruangan yang anda cari tidak tersedia.");
			        	}
	    			}
				};
		        xmlhttp.open("GET","findroom.php?room="+$('#txtruang').val()+"&cap="+$('#txtcap').val(),true);
		        xmlhttp.send();
			}
		});
	
	});
		</script>

    	<script async defer
    	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHZyb7_M7M-BJJxGXCpanhOaZ6-1Zcnns&callback=initMap">
    	</script>
	</body>
</html>