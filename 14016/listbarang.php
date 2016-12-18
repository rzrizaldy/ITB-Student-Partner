<?php
	require_once('api.php');
	include 'menu.php';
?>

<p> List Peminjaman </p>
<br>
<table>
<tr>
<td><a href="listbarang.php">Semua barang</a></td>
<td><a href="listbarang.php?kategori=1">Buku</a></td>
<td><a href="listbarang.php?kategori=2">Alat Kuliah</a></td>
<td><a href="listbarang.php?kategori=3">Elektronik</a></td>
<td><a href="listbarang.php?kategori=4">Lain-lain</a></td>
</tr>
</table>
<br>
<?php 
	if ($_GET)
	{
	if ($_GET['kategori']==1)
	{
		$dbbarang = getBuku();
	}
	else if ($_GET['kategori']==2)
	{
		$dbbarang = getAlat();
	}
	else if ($_GET['kategori']==3)
	{
		$dbbarang = getElektronik();
	}
	else if ($_GET['kategori']==4)
	{
		$dbbarang = getLain();
	}
	}
	else
	{
		$dbbarang = getAllBarang();
	}
	if (mysqli_num_rows($dbbarang))
	{ ?>
<table border = "1">
<tr>
<th>Nama peminjam</th>
<th>Nama barang</th>
<th>Kategori</th>
<th></th>
</tr>
<?php
	while($listbarang = mysqli_fetch_array($dbbarang)){?>
<tr>
<td><?php echo getNama($listbarang['IDPeminjam']) ?></td>
<td><?php echo $listbarang['Nama']?></td>
<td><?php 
if ($listbarang['Kategori']=='alat')
{
	echo "alat kuliah";
}
else if ($listbarang['Kategori']=='lain')
{
	echo "lain-lain";
}
else
{
	echo $listbarang['Kategori'];
}?>
</td>
<td><a href="ada.php?peminjam=<?php echo $idaktif ?>&idbarang=<?php echo $listbarang['ID'] ?>">Ada</a></td>
</tr>
<?php } ?>
</table>
	<?php } else { ?>
	<p> Tidak ada barang </p>
	<?php } ?>