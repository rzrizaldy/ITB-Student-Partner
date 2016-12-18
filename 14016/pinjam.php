<?php
	require_once('api.php');
	include 'menu.php';

if($_SERVER['REQUEST_METHOD']=='POST')
{
$idpeminjam = $_POST['id'];
$namabarang = $_POST['barang'];
$kategori = $_POST['kategori'];
$kontak = $_POST['kontak'];
addBarang($idpeminjam,$namabarang,$kategori,$kontak);
header('location:barangsaya.php');			
} 
?>
<html>
<head>
        <link href="./css/mainstyle.css" rel="stylesheet">
        <style type="text/css">
.form-control {
	-webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    outline: 0;
    border: 1px solid rgba(255, 255, 255, 0.4);
    background-color: rgba(255, 255, 255, 1);
    width: 250px;
    border-radius: 3px;
    padding: 10px 15px;
    margin: 0 auto 10px auto;
    display: block;
    text-align: center;
    font-size: 16px;
    color: #000;
    -webkit-transition-duration: 0.25s;
    -moz-transition-duration: 0.25s;
    transition-duration: 0.25s;
    font-weight: 300;
}

.table >tr >td {
	color: #fff;
}

table {
	width:auto;
	margin-left: 10% !important;
	margin-right: 10% !important;
}
        </style>
</head>
<body>
<div class="wrapper-utama">
<div class="container-utama">
<br>
<form name="formlogin" action="pinjam.php" method="post">
<table style="position:relative; padding:10px; padding-left:10% !important; padding-right:10% !important; background-color:#50a3a2">
<h3 style="color:#000">Peminjaman Barang</h3>
<input type="hidden" name="id" value="<?php echo $idaktif ; ?>">
<tr>
<td>Nama : </td>
<td><?php echo getNama($idaktif) ?></td>
</tr>
<tr>
<td>Barang</td>
<td><input type="text" name="barang" required></td>
</tr>
<tr>
<td>Jenis : </td>
<td><select name="kategori" class="form-control" id="kategori">
	<option value="lain">Lain-lain</option>
	<option value="buku">Buku</option>	
	<option value="alat">Alat kuliah</option>
	<option value="elektronik">Elektronik</option>
</td>
<tr>
<td>Kontak</td>
<td><input type="text" name="kontak" required></td>
</tr>
<tr>
<tr colspan="2" </tr>
<td><input type="submit" name="submit" value="Pinjam"></td>
</tr>
</table>
</form>
</div>
</div>
</body>
</html>
