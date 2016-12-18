<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css" />
<script type="text/javascript" src="jquery-3.1.0.js"></script>
<script type="text/javascript" src="fjb.js"></script>
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<script type="text/javascript" src="bootstrap-3.3.7-dist/js/bootstrap.js"></script>
<title>Forum Jual Beli</title>
</head>

<!-- Javascript -->
<script>
	function openNav() {
		document.getElementById("mySidenav").style.width="250px";
	}
	function closeNav() {
		document.getElementById("mySidenav").style.width="0";
	}
	function isNumberKey(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}
	$(document).ready(function() {
		$(".upload").on('change', function() {
		  //Get count of selected files
		  var countFiles = $(this)[0].files.length;
		  var imgPath = $(this)[0].value;
		  var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
		  var image_holder = $("#image-holder");
		  image_holder.empty();
		  if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
			if (typeof(FileReader) != "undefined") {
			  //loop for each file selected for uploaded.
			  for (var i = 0; i < countFiles; i++) 
			  {
				var reader = new FileReader();
				reader.onload = function(e) {
				  $("<img />", {
					"src": e.target.result,
					"class": "thumb-image"
				  }).appendTo(image_holder);
				}
				image_holder.show();
				reader.readAsDataURL($(this)[0].files[i]);
			  }
			} else {
			  alert("This browser does not support FileReader.");
			}
		  } else {
			alert("Pls select only images");
		  }
		});
	});
	$(document).ready(function(){
		$(".filter").change(function(){
			$(this).find("option:selected").each(function(){
				if($(this).attr("value")=="Elektronik"){
					$(".box").not(".elektronik").hide();
					$(".elektronik").show();
				}
				else if($(this).attr("value")=="Handphone"){
					$(".box").not(".handphone").hide();
					$(".handphone").show();
				}
				else if($(this).attr("value")=="Komputer"){
					$(".box").not(".komputer").hide();
					$(".komputer").show();
				}
				else if($(this).attr("value")=="Fashion"){
					$(".box").not(".fashion").hide();
					$(".fashion").show();
				}
				else if($(this).attr("value")=="Buku"){
					$(".box").not(".buku").hide();
					$(".buku").show();
				}
				else if($(this).attr("value")=="All"){
					$(".box").not(".all").hide();
					$(".all").show();
				}
				else{
					$(".box").hide();
				}
			});
		}).change();
	});
</script>
					
<!-- CSS -->
<style>
	#listmenu {
		padding-top:30px;
	}
	.sidenav {
		height:100%;
		width:0;
		position:fixed;
		z-index:1;
		top:0;
		left:0;
		background-color:#F5F5F5;
		overflow-x:hidden;
		padding-top:60px;
		transition:0.5s;
	}
	.sidenav a {
		padding:8px 8px 8px 32px;
		text-decoration:none;
		font-size:20px;
		color:#3C3C3C;
		display:block;
		transition:0.3s;
	}
	.sidenav a:hover, .offcanvas a:focus {
		color:#FF5A5F;
	}
	.sidenav .closebtn {
		position:absolute;
		top:0;
		right:25px;
		font-size:36px;
		margin-left:50px;
	}
	.sidenav h2 {
		position:absolute;
		top:0;
		left:20px;
		font-size:28px;
		margin-left:10px;
		padding-top:13px;
		font-family:Trebuchet MS, Helvetica, sans-serif;
	}
	#main {
		transition:margin-left .5s;
		padding:5px;
	}
	@media screen and (max-height:450px) {
		.sidenav {padding-top:15px;}
		.sidenav a {font-size:18px;}
	}
	.fileUpload {
		position:relative;
		overflow:hidden;
		margin:10px;
	}
	.fileUpload input.upload{
		position:absolute;
		top:0;
		right:0;
		margin:0;
		padding:0;
		font-size:20px;
		cursor:pointer;
		opacity:0;
		filter:alpha(opacity=0);
	}
	.thumb-image{ 
		float:center;
		width:100px;
		position:relative;
		padding:5px;
	}
	#search:focus{outline:none;}
	input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button {
		-webkit-appearance:none;
		margin:0;
	}
	#title:focus{outline:none;}
	#price:focus{outline:none;}
	.modalDialog{
		position: fixed;
		font-family: Arial, Helvetica, sans-serif;
		top: -70px;
		right: 0;
		bottom: 0;
		left: 0;
		background: rgba(0,0,0,0.8);
		z-index: 99999;
		opacity:0;
		-webkit-transition: opacity 400ms ease-in;
		-moz-transition: opacity 400ms ease-in;
		transition: opacity 400ms ease-in;
		pointer-events: none;
	}
	.modalDialog:target{
		opacity:1;
		pointer-events:auto;
	}
	.modalDialog > div {
		width: 700px;
		height: 500px;
		position: relative;
		margin: 10% auto;
		padding: 5px 20px 13px 20px;
		border-radius: 10px;
		background: #fff;
		background: -moz-linear-gradient(#fff, #999);
		background: -webkit-linear-gradient(#fff, #999);
		background: -o-linear-gradient(#fff, #999);
	}
	.close{
		background: #606061;
		color: #FFFFFF;
		line-height: 25px;
		position: absolute;
		right: -12px;
		text-align: center;
		top: -10px;
		width: 24px;
		opacity:1;
		text-decoration: none;
		font-weight: bold;
		-webkit-border-radius: 12px;
		-moz-border-radius: 12px;
		border-radius: 12px;
		-moz-box-shadow: 1px 1px 3px #000;
		-webkit-box-shadow: 1px 1px 3px #000;
		box-shadow: 1px 1px 3px #000;
		font-size:14px;
	}
	.close:hover{
		background:#00d9ff;
		opacity:1;
	}
	.galleryItem {
		color:black;
		font:10px/1.5 Verdana, Helvetica, sans-serif;
		float:left;
		width:16%;
		margin:2% 2% 50px 2%;
		background-color:white;
		opacity:0.6;
		padding:10px;
		-webkit-border-radius:5px;
		-moz-border-radius:5px;
		border-radius:5px;
	}
	.galleryItem h3 {
		text-transform:uppercase;
	}
	.galleryItem img {
		max-width:100%;
		-webkit-border-radius:5px;
		-moz-border-radius:5px;
		border-radius:5px;
		opacity:1;
		height:200px;
	}
	@media only screen and (max-width : 940px), only screen and (max-device-width : 940px){
		.galleryItem {width: 21%;}
	}
	@media only screen and (max-width : 720px), only screen and (max-device-width : 720px){
		.galleryItem {width: 29.33333%;}
	}
	@media only screen and (max-width : 530px), only screen and (max-device-width : 530px){
		.galleryItem {width: 46%;}
	}
	@media only screen and (max-width : 320px), only screen and (max-device-width : 320px){
		.galleryItem {width: 96%;}
		.galleryItem img {width: 96%;}
		.galleryItem h3 {font-size: 18px;}
		.galleryItem p, {font-size: 18px;}
	}
	.select {
		text-align:right;
		padding-top:60px;
		float:left;
	}
</style>

<!-- HTML -->
<body style="background-image:url(campusstore.png);height:100%;">
	<div class="slidingmenu">
		<div id="mySidenav" class="sidenav">
			<h2 style="color:black;padding-top:-10px;">Kategori</h2>
			<div id="listmenu">
				<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			</div>
		</div>
	</div>
	
	<div id="main" style="left:0;right:0;">
	
		<header class="container" style="padding-top:-10;">
			<img src="burger.png" onclick="openNav()" style="cursor:pointer;width:30px;height:30px;padding:-400px 20px;margin-left:-270px;margin-top:18px;">
			<a href="index.php" style="text-decoration:none;color:white;"><h2 style="margin-right:40px;padding-top:10px;font-family:Trebuchet MS, Helvetica, sans-serif;font-size:23px;color:white;display:inline;float:left;">FORUM JUAL BELI</h2></a>
			<form style="margin-top:-30px;margin-left:335px;" action="search.php" method="get">
				<input id="search" type="search" placeholder="Search" name="search" id="search" style="font-size:18px;color:white;background-color:transparent;border-bottom: 2px solid white;border-left:0px solid;border-right:0px solid;border-top:0px solid;width:500px;">
			</form>
			<ul id="navbar" style="margin:-47px -60px;font-family:Trebuchet MS, Helvetica, sans-serif;font-size:23px;list-style-type:none;float:right;display:inline">
				<li style="display:inline;float:left;margin-right:40px;margin-top:20px;"><a href="#" style="color:white;text-decoration:none;">HOME</a></li>
				<li style="display:inline;float:left;margin-right:40px;margin-top:20px;"><a href="#" style="color:white;text-decoration:none;">LOGIN</a></li>
			</ul>
		</header>
		
		<div class="buku box" style="width:80%;margin:30px auto;overflow:hidden;">
			<?php

				include 'koneksi.php';
				$search=$_GET['search'];
				$sql = "SELECT ID_Barang,Nama, Harga, Deskripsi, Kategori, Gambar FROM barang WHERE Nama like '%$search%' or Deskripsi like '%$search%' or Harga like '%$search%' or Kategori like '%$search%'";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						echo '
						<div class="galleryItem">
							<a href="deskripsi.php?ID_Barang='.$row['ID_Barang'].'"><img src="imageview.php?ID_Barang='.$row['ID_Barang'].'"></a>
							<h3>'.$row["Nama"]."<br></h3>
							<p><b>".$row["Kategori"]."</b><br></p>
							<p><b>Rp ".$row["Harga"].'</b><br></p>
						</div> ';
					}
				}
				mysqli_close($conn);
	
			?>
		</div>
		
    </div>
	
</body>
</html>