<?php
	// data server mysql
$db_host = '167.205.67.249'; // --> sever mysql
$db_user = '18214042';      // --> username
$db_pass = '42yuuwiw';          // --> password
$db_name = 'db18214042';     // --> nama database
 
// Fungsi untuk koneksi ke mysqli
$connect = new mysqli($db_host,$db_user,$db_pass,$db_name);
 
// cek koneksi
if ($connect->connect_error) {
   // jika salah. Bisa juga menggunakan exit();
   die('Koneksi Gagal : '. $connect->connect_error).'';
}
?>
