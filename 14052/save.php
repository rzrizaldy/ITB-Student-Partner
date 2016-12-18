<?php
include('db.php');

session_start();

function createRandomPassword() {
	$chars = "abcdefghijkmnopqrstuvwxyz023456789";
	srand((double)microtime()*1000000);
	$i = 0;
	$pass = '' ;
	while ($i <= 7) {
		$num = rand() % 33;
		$tmp = substr($chars, $num, 1);
		$pass = $pass . $tmp;
		$i++;
	}
	return $pass;
}




$rute=$_SESSION['rute'];
$tanggal=$_SESSION['tanggal'];




$confirmation = createRandomPassword();
$setnum=$_POST['kursi'];
$nim=$_POST['nim'];
$nama=$_POST['nama'];
$email=$_POST['email'];
$telepon=$_POST['telepon'];
$alamat=$_POST['alamat'];

$setnum=substr($setnum,7);
$setnum=substr($setnum,0,-5);

$bd->query("INSERT INTO mahasiswa (NIM, Nama, Email, Telepon, Alamat, IDTransaksi)
VALUES ('$nim', '$nama', '$email', '$telepon', '$alamat','$confirmation')");
$bd->query("INSERT INTO pemesanan (NIM, Tanggal, IDRute, Seat, IDTransaksi)
VALUES ('$nim', '$tanggal', '$rute', '$setnum','$confirmation')");
header("location: print.php?id=$confirmation&nim=$nim");
?>