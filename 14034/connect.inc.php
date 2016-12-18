<?PHP

define("HOSTNAME", "sql6.freemysqlhosting.net");
define("USERNAME", "sql6149322");
define("PASSWORD", "vKANZWUWR5");

//mysql_connect(HOSTNAME, USERNAME, PASSWORD) or print("No connection available\r\n");
$conn = new mysqli(HOSTNAME, USERNAME,PASSWORD,'sql6149322');
if($conn -> connect_error){
	die('TAI! '.mysql_error());
}
//else
?>
