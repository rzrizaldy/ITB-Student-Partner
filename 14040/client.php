<?php
  //Accessing the function 
  include("hmj_ukm_api.php");

?>

<!DOCTYPE html>
<html>
<head>
<title>Organisasi Mahasiswa ITB</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <meta charset="utf-8">
        <style>
          #map {
            height: 400px;
            width: 100%;
        
           }
        </style>
</head>
<body id="top">
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- Top Background Image Wrapper -->
<div class="bgded overlay" style="background-image:url('images/bg1.png'); padding-top:7% !important"> 
  <!-- ################################################################################################ -->
  <div class="wrapper row1">
    <header id="header" class="hoc clear"> 
      <!-- ################################################################################################ -->
      <div id="logo" class="fl_left">
        <h1><a href="index.html">Communicare</a></h1>
      </div>
      <!-- ################################################################################################ -->
    </header>
  </div>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <div class="wrapper row2">
    <div id="breadcrumb" class="hoc clear"> 
      <!-- ################################################################################################ -->
      <ul>
        <li><a href="../final/index.html">Home</a></li>
        <li>Organisasi Mahasiswa ITB</li>
        <li><?php echo $value['type'] ?></li>
        <li><?php echo $value['id'] ?></li>
      </ul>
      <!-- ################################################################################################ -->
    </div>
  </div>
  <!-- ################################################################################################ -->
</div>
<!-- End Top Background Image Wrapper -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
    <div class="content"> 
      <!-- ################################################################################################ -->
      <h1 style="font-weight: bold"><?php echo $value['id']; ?></h1>
      <hr>
      <p><strong>Profil</strong></p>
      <img id="hmif" class="imgr borderedbox inspace-5" src=<?php echo $value['logo']; ?>>
      <p><?php echo $value['deskripsi'] ?></p>
      <p></p>
      <p><strong>Ketua Himpunan : </strong> <?php echo $value['ketua'] ?></p>
      <hr>
        <p><strong>Lokasi Sekretariat Himpunan</strong></p>
    	<?php echo $value['lokasi'] ?>
      <hr>
      <div id="comments">
        <h2>Kirim Aspirasimu!</h2>
        <form name="aspirasi" action="kirim_aspirasi.php" method="POST">
          <div class="one_quarter first">
            <label for="name">Nama<span>*</span></label>
            <input type="text" name="nama" id="nama" value="" size="22" required>
          </div>
          <div class="one_quarter">
            <label for="email">Alamat Email<span>*</span></label>
            <input type="text" name="email" id="email" value="" size="22" required>
          </div>
          <div class="one_quarter">
            <label for="subject">Himpunan</label>
            <input type="text" name="himpunan" id="himpunan" value=<?php echo $value['id'] ?> size="50">
          </div>
          <div class="one_quarter">
            <label for="subject">Subjek</label>
            <input type="text" name="subject" id="subject" value="" size="50">
          </div>
          <div class="block clear">
            <label for="comment">Aspirasi</label>
            <textarea name="aspirasi" id="aspirasi" cols="25" rows="10"></textarea>
          </div>
          <div>
            <input type="submit" name="submit" value="Kirim Aspirasi">
            &nbsp;
            <input type="reset" name="reset" value="Reset">
          </div>
        </form>
      </div>
      <!-- ################################################################################################ -->
    </div>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row4" style="background-color: #ccae52">
  <footer id="footer" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <div class="one_third first">
      <h3 class="heading">Communicare</h3>
      <ul class="faico clear">
        <li><a class="faicon-facebook" href="#" style="color: white"><i class="fa fa-facebook"></i></a></li>
        <li><a class="faicon-twitter" href="#" style="color: white"><i class="fa fa-twitter"></i></a></li>
        <li><a class="faicon-linkedin" href="#" style="color: white"><i class="fa fa-linkedin"></i></a></li>
        <li><a class="faicon-google-plus" href="#" style="color: white"><i class="fa fa-google-plus"></i></a></li>
      </ul>
    </div>
    <div class="one_third">
      &nbsp
    </div>
    <div class="one_third">
      <ul class="nospace meta" style="color: white">
        <li class="btmspace-15"><i class="fa fa-phone"></i> +62 857 744X XXXX</li>
        <li><i class="fa fa-envelope-o" style="color: white"></i> 18214040@std.stei.itb.ac.id</li>
      </ul>
    </div>
    <!-- ################################################################################################ -->
  </footer>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>