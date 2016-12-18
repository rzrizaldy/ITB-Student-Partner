<?php
	include 'api.php';
	$id = $_GET['id'];
	hapusBarang($id);
	header("location:barangsaya.php")
?>