<?php
	// include config.php file, this contains our DB connection
	$db = new PDO('mysql:host=sql6.freemysqlhosting.net;dbname=sql6148414;charset=utf8mb4', 'sql6148414', 'JVZsZGZDqF');
	if ($db) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$comment = $_POST['message'];
		$date = date('F j, Y');
		$ID = $_POST['ID_Barang'];
		$sql = $db->prepare("INSERT INTO komentar(Nama, Email, Message, Date_Posted, ID_Barang) VALUES (?, ?, ?, ?, ?)");
		$sql->execute(array($name, $email, $comment, $date, $ID));	
	}
?>