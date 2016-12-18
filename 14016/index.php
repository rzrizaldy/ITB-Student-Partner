<?php
  require_once('api.php');
  session_start();
  $idaktif = $_SESSION['login_user'];

?>

<style type="text/css">
  .data a {
    color:#000;
  }

  .data a:hover {
    color:#50a3a2;
  }

  .data li {
    list-style-type: none;
    display: inline-block;
    padding: 10px;
  }
</style>

<html>
<head>
        <link href="./css/mainstyle.css" rel="stylesheet">
</head>
<body>
<div class="wrapper-utama">
<div class="container-utama">
<p>Halo,<?php echo getNama($idaktif)?></p>
<br>
  <ul class="data">
    <li><h3><a href="pinjam.php">Pinjam</a></h3></li>
    <li><h3><a href="listbarang.php">List barang</a></h3></li>
    <li><h3><a href="barangsaya.php">Barang saya</a></h3></li>
    <li><h3><a href="logout.php">Log Out </a></h3></li>
</ul>
</div>
</div>
</body>
</html>

