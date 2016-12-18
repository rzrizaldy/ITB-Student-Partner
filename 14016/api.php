<?php
	include 'koneksi.php';

	
	function getNama($login_user)
	{
		$koneksi = connect1();
		$dbuser1 = mysqli_query($koneksi,"SELECT * FROM member WHERE username='$login_user' ");
		$f = mysqli_fetch_array($dbuser1);
		return $f['nama'];
	}
	
	function addBarang($login_userpeminjam,$namabarang,$kategori,$kontak)
	{
		$koneksi = connect();
		mysqli_query($koneksi,"INSERT INTO barang VALUES ('','$login_userpeminjam','$kontak','$namabarang','$kategori','','', '0')");
	}
	
	function getBarangByIDada($login_user)
	{
		$koneksi = connect();
		$dbbarang = mysqli_query($koneksi,"SELECT * FROM barang WHERE IDPeminjam='$login_user' AND Ada='1' ");		
		return $dbbarang;
	}
	
	function getBarangByIDtidak($login_user)
	{
		$koneksi = connect();
		$dbbarang = mysqli_query($koneksi,"SELECT * FROM barang WHERE IDPeminjam='$login_user' AND Ada='0' ");		
		return $dbbarang;
	}

	function getBarangTerpinjam($login_user)
	{
		$koneksi = connect();
		$dbbarang = mysqli_query($koneksi,"SELECT * FROM barang WHERE IDDipinjam='$login_user' ");		
		return $dbbarang;
	}
	
	function getAllBarang()
	{
		$koneksi = connect();
		$dbbarang = mysqli_query($koneksi,"SELECT * FROM barang WHERE Ada='0' ");		
		return $dbbarang;		
	}
	
	function ada($login_userbarang,$login_userdipinjam,$kontak)
	{
		$koneksi = connect();
		mysqli_query($koneksi,"UPDATE barang set IDDipinjam='$login_userdipinjam' , Ada='1' , KontakDipinjam='$kontak' WHERE ID='$login_userbarang'");
	}
	
	function hapusBarang($login_user)
	{
		$koneksi = connect();
		mysqli_query($koneksi,"DELETE FROM barang WHERE ID='$login_user'");
	}	
	
	function getBuku()
	{
		$koneksi = connect();
		$dbbarang = mysqli_query($koneksi,"SELECT * FROM barang WHERE Ada='0' AND Kategori='buku' ");		
		return $dbbarang;
	} 

		function getElektronik()
	{
		$koneksi = connect();
		$dbbarang = mysqli_query($koneksi,"SELECT * FROM barang WHERE Ada='0' AND Kategori='elektronik' ");		
		return $dbbarang;
	} 
	
	function getAlat()
	{
		$koneksi = connect();
		$dbbarang = mysqli_query($koneksi,"SELECT * FROM barang WHERE Ada='0' AND Kategori='alat' ");		
		return $dbbarang;
	} 
	
	function getLain()
	{
		$koneksi = connect();
		$dbbarang = mysqli_query($koneksi,"SELECT * FROM barang WHERE Ada='0' AND Kategori='lain' ");		
		return $dbbarang;
	} 
?>