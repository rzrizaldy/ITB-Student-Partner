<?php  
$connect = mysqli_connect("sql6.freemysqlhosting.net:3306", "sql6148702", "8aFhLJv1bj", "sql6148702");  
$id = $_POST["id"];  
$text = $_POST["text"];  
$column_name = $_POST["column_name"];  

if (($column_name == 'jumlah_SKS') || ($column_name == 'nilai')){
	$sql = "UPDATE tbl_indeks SET ".$column_name."='".$text."' WHERE id='".$id."'";
} else {  
	$sql = "UPDATE tbl_total SET ".$column_name."='".$text."' WHERE id='".$id."'";
}
mysqli_query($connect, $sql);
?>  