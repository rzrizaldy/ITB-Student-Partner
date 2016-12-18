<?php  
$connect = mysqli_connect("sql6.freemysqlhosting.net:3306", "sql6148702", "8aFhLJv1bj", "sql6148702");  
$sql = "DELETE FROM tbl_indeks WHERE id = '".$_POST["id"]."'";  
if(mysqli_query($connect, $sql))  
{  
	echo 'Data Deleted';  
}  
?>