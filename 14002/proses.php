<?php
	
	$db = new PDO('mysql:host=sql6.freemysqlhosting.net;dbname=sql6148414;charset=utf8mb4', 'sql6148414', 'JVZsZGZDqF');
	if ($db) {
		$a=$_POST['Title'];
		$b=$_POST['Price'];
		$c=$_POST['Description'];
		$kategori=$_POST['Kategori'];
		$image = $_FILES['image']['tmp_name'];
		$img = file_get_contents($image);
		$sql = $db->prepare("INSERT INTO barang (Nama,Harga,Deskripsi,Kategori,Gambar) VALUES (?,?,?,?,?)");
		$sql->execute(array($a, $b, $c, $kategori, $img));
		
		if ($sql) {
			echo "<meta http-equiv=\"refresh\" content=\"2; url=./index.php\">";
		}	 
	}
	else echo "Can't reach database";

?>