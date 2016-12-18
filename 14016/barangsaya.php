<?php
	require_once('api.php');
	include 'menu.php';
?>

<html>
<body>
<br>
<p>Barang Meminjam (sudah ada respon) </p>

<?php 
	$dbbarangada = getBarangByIDada($idaktif);
	if (mysqli_num_rows($dbbarangada))
	{ ?>
<table border = "1">
<tr>
<th>Nama barang</th>
<th>Kategori</th>
<th>Nama pemilik</th>
</tr>
<?php
	while($listbarang = mysqli_fetch_array($dbbarangada)){?>
<tr>
<td><?php echo $listbarang['Nama']?></td>
<td><?php echo $listbarang['Kategori']?></td>
<td><?php echo getNama($listbarang['IDDipinjam'])?></td>
</tr>
<?php } ?>
</table>
	<?php } else { ?>
	<p> Tidak ada barang </p>
	<?php } ?>

<br><br>
<p>Barang Meminjam (belum ada respon) </p>

<?php 
	$dbbarangtidak = getBarangByIDtidak($idaktif);
	if (mysqli_num_rows($dbbarangtidak)>0)
	{ ?>
<table border = "1">
<tr>
<th>Nama barang</th>
<th>Kategori</th>
<th></th>
</tr>
<?php
	while($listbarang = mysqli_fetch_array($dbbarangtidak)){?>
<tr>
<td><?php echo $listbarang['Nama']?></td>
<td><?php echo $listbarang['Kategori']?></td>
<td><a href="hapus.php?id=<?php echo $listbarang['ID'] ?>">Hapus</a></td>
</tr>
<?php } ?>
</table>
	<?php } else { ?>
	<p> Tidak ada barang </p>
	<?php } ?>
	
<br><br>
<p>Barang dipinjam </p>

<?php 
	$dbbarangpinjam = getBarangTerpinjam($idaktif);
	if (mysqli_num_rows($dbbarangpinjam)>0)
	{ ?>
<table border = "1">
<tr>
<th>Nama barang</th>
<th>Kategori</th>
<th>Nama peminjam</th>
<th></th>
</tr>
<?php
	while($listbarang = mysqli_fetch_array($dbbarangpinjam)){?>
<tr>
<td><?php echo $listbarang['Nama']?></td>
<td><?php echo $listbarang['Kategori']?></td>
<td><?php echo getNama($listbarang['IDPeminjam']) ?></td>
<td><a href="hapus.php?id=<?php echo $listbarang['ID'] ?>">Selesai</td>
</tr>
<?php } ?>
</table>
	<?php } else { ?>
	<p> Tidak ada barang </p>
	<?php } ?>
</body>
</html>