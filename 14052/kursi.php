<?php
include('db.php');
session_start();
 
//finally, let's store our posted values in the session variables
$_SESSION['rute'] = $_POST['rute'];
$_SESSION['tanggal'] = $_POST['tanggal'];

$rute=$_POST['rute'];
$tanggal=$_POST['tanggal'];

echo $rute;
echo $tanggal;

$result = $bd->query("SELECT * FROM rute WHERE IDRute='$rute'");
while($row = $result->fetch_assoc())
	{
		$query = $bd->query("SELECT count(IDRute) FROM pemesanan where Tanggal = '$tanggal'");
							while($rows = $query->fetch_assoc())
							  {
							  $inogbuwin=$rows['count(IDRute)'];
							  }
		$avail=37-$inogbuwin;
		$setnum=$inogbuwin+1;
	}
?>
<?php

if ($avail < 1){
echo 'Qty reserve exced the available seat of the bus';
}
else if($avail > 0)
{
?>

<div id="stylized" class="myform">

<form id="form" name="form" action="form.php" method="post"  onsubmit="return validateForm()">
<input type="hidden" value="<?php echo $rute ?>" name="rute" />
<input type="hidden" value="<?php echo $tanggal ?>" name="tanggal" />

<label>Nomor Kursi
<span class="small">Auto Generated <a rel="facebox" href="seatlocation.php?id=<?php echo $rute; ?>">view seat</a></span>
</label>
<input type="text" name="setnum" value="
<?php
$N = 1;
for($i=0; $i < $N; $i++)
{
echo $i+$setnum;
} 
 ?>
" id="name" readonly/><br>


<button type="submit">Konfirmasi</button>
</form>
</div>
<?php
}
else if($avail <= 0)
{
echo 'no available sets';
}
?>
