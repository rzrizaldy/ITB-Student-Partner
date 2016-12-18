<?PHP

function do_the_query($db, $query)
{
	$conn = new mysqli('localhost:3306', 'root','','chatty');
if($conn -> connect_error){
	die('TAI! '.mysqli_error());
}
	$result = mysqli_query($conn,$query) or die ("Query Salahh : ");
	//mysqli_db_query($db, $query) or print("$query<BR>" . "<B>" . mysqli_errno() . ": " . mysqli_error() . "</B><BR>\r\n<BR>\r\n");
	return $result;
}

/* funzione frontend per generare numeri pseudo-casuali */
function random($max)
{
	srand((double)microtime() * 1000000);
	return rand(1, $max);
}
?>
