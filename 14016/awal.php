<?php

	require_once('koneksi.php');
	$koneksi = connect();
?>

<form name="formlogin" action="login.php" method="post">
<table>
<tr>
<td><input type="text" name="nama" placeholder="Masukkan nama anda"></td>
<td><input type="password" name="pass" placeholder="Masukkan password anda"></td>
<td><input type="submit" name="submit" value="Log In"></td>
</td>
</tr>
</table>
</form>
