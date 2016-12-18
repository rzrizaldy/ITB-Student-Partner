<?php
	include 'koneksi.php';

	
	function getNama($id)
	{
		$koneksi = connect();
		$dbuser = mysqli_query($koneksi,"SELECT * FROM user WHERE username='$id' ");
		$f = mysqli_fetch_array($dbuser);
		return $f['nama'];
	}
	
	function addBarang($idpeminjam,$namabarang,$kategori,$kontak)
	{
		$koneksi = connect();
		mysqli_query($koneksi,"INSERT INTO barang VALUES ('','$idpeminjam','$kontak','$namabarang','$kategori','','', '0')");
	}
	
	function getBarangByIDada($id)
	{
		$koneksi = connect();
		$dbbarang = mysqli_query($koneksi,"SELECT * FROM barang WHERE IDPeminjam='$id' AND Ada='1' ");		
		return $dbbarang;
	}
	
	function getBarangByIDtidak($id)
	{
		$koneksi = connect();
		$dbbarang = mysqli_query($koneksi,"SELECT * FROM barang WHERE IDPeminjam='$id' AND Ada='0' ");		
		return $dbbarang;
	}

	function getBarangTerpinjam($id)
	{
		$koneksi = connect();
		$dbbarang = mysqli_query($koneksi,"SELECT * FROM barang WHERE IDDipinjam='$id' ");		
		return $dbbarang;
	}
	
	function getAllBarang()
	{
		$koneksi = connect();
		$dbbarang = mysqli_query($koneksi,"SELECT * FROM barang WHERE Ada='0' ");		
		return $dbbarang;		
	}
	
	function ada($idbarang,$iddipinjam,$kontak)
	{
		$koneksi = connect();
		mysqli_query($koneksi,"UPDATE barang set IDDipinjam='$iddipinjam' , Ada='1' , KontakDipinjam='$kontak' WHERE ID='$idbarang'");
	}
	
	function hapusBarang($id)
	{
		$koneksi = connect();
		mysqli_query($koneksi,"DELETE FROM barang WHERE ID='$id'");
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