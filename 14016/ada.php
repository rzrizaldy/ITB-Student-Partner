<?php
	include 'api.php';
	include 'menu.php';
	$idbarang = $_GET['idbarang'];
	$idpeminjam = $_GET['peminjam'];


if($_SERVER['REQUEST_METHOD']=='POST')
{
	$kontak = $_POST['kontak'];
	ada($idbarang,$idpeminjam,$kontak);
	header('location:menu.php');
}

?>

<form name="formlogin" action="ada.php?peminjam=<?php echo $idpeminjam ?>&idbarang=<?php echo $idbarang ?>" method="post">
<table>
<tr>
<td>Kontak :</td>
<td><input type="text" name="kontak" required></td>
<td><input type="submit" name="submit" value="OK"></td>
</tr>
</table>
</form>