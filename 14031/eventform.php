<form name='eventform' method='POST' action="<?php $_SERVER['PHP_SELF']; ?>?month=<?php echo $month;?>&day=<?php echo $day;?>&year=<?php echo $year;?>&v=true&add=true">
	<table width='400px' align = 'center'>
		<tr>
			<td width='150px'>Title</td>
			<td width='250px'><input type='text' name='txttitle'></td>
		</tr>
		<tr>
			<td width='150px'>Detail</td>
			<td width='250px'><textarea name='txtdetail'></textarea></td>
		</tr>
		<tr>
			<td colspan='2' align='center'><input type='submit' name='btnadd' value='Add Event'></td>
		</tr>
	</table>
</form>
