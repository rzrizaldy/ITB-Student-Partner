<?php  
$connect = mysqli_connect("sql6.freemysqlhosting.net:3306", "sql6148702", "8aFhLJv1bj", "sql6148702");  
$sql = "INSERT INTO tbl_indeks(jumlah_SKS, nilai) VALUES('".$_POST["jumlah_SKS"]."', '".$_POST["nilai"]."')";  
if(mysqli_query($connect, $sql))  
{  
	echo 'Data Inserted';  
}  
?>  