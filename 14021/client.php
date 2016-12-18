<?php

require 'api.php';
	
function show()
{
	$array=getFacebookData(200);
	$arr= combineFbDB($array);
	usort($arr, function($a, $b) {
	  $ad = ($a['Date']);
	  $bd = ($b['Date']);

	  if ($ad == $bd) {
		return 0;
	  }

	  return $ad > $bd ? -1 : 1;
	});
	echo'
			<div class="col-sm-6">
			<h2 class="text-center lol">Lost</h2>
			 <div class="tbl-header">
			<table cellpadding="10" cellspacing="10" border="0">
			<thead>
			  <tr>
				<th class="d">Date</th>
				<th class="d">Information</th>
			  </tr>
			</thead>
			</table>
			</div>
			  <div class="tbl-content">
				<table cellpadding="0" cellspacing="0" border="0">
			<tbody>';
	echo '<form action="?action=deleted" method="post">';
	foreach ($arr as $row)
	{
		if ($row['Status']== 'LOST') {
		echo"<tr>";
		echo'<td class="b">'.$row['Date']."</td>";
		echo'<td class="b">'.$row['Information'];
		if (($row['Attachment']!== null) && ($row['Attachment']!== "")) {
			echo '<br><img src="'.$row['Attachment'].'" alt="Mountain View" style="height:228px;" class="center-block"></br>';
		}
		echo"</td>";
		if (($row['Link']== null) && ($row['Link']== "")) {
			echo '<td class="c"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal1">Solved</button></td>
			<div id="myModal1" class="modal fade" role="dialog">
			  <div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title text-center">Are you sure you want to delete this item?</h3>
				  </div>
				  <form method="post" action="?action=addtosql" class="form-horizontal">
				  <div class="modal-footer">
					<button type="submit" class="btn btn-primary pull-left" id="deleted" name="Id" value="'.$row['Id'].'">Yes</button>
					 <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
				  </div>
				  </form>
				</div>
			  </div>
			</div>';
		} else {
			echo'<td class="c"><a href="'.$row['Link'].'" type="button" class="btn btn-primary btn-sm" >More  &raquo;</a></td>';
		}
		echo"</tr>";
		}
	}
	echo '</form>
	</tbody>
	</table>
	</div>
	</div>';
	
	echo '<div class="col-sm-6">
		<h2 class="lol text-center">Found</h2>
			<div class="tbl-header">
			<table cellpadding="0" cellspacing="0" border="0">
			<thead>
			  <tr>
				<th class="d">Date</th>
				<th class="d">Information</th>
			  </tr>
			</thead>
			</table>
			  </div>
			  <div class="tbl-content">
				<table cellpadding="0" cellspacing="0" border="0">
			<tbody>';
	echo '<form action="?action=deleted" method="post">';
	foreach ($arr as $row)
	{
		if ($row['Status']== 'FOUND') {
		echo"<tr>";
		echo'<td class="b">'.$row['Date']."</td>";
		echo'<td class="b">'.$row['Information'];
		if (($row['Attachment']!== null) && ($row['Attachment']!== "")) {
			echo '<br><img src="'.$row['Attachment'].'" alt="Mountain View" style="height:228px;" class="center-block"></br>';
		}
		echo"</td>";
		if (($row['Link']== null) && ($row['Link']== "")) {
			echo '<td class="c"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal2">Solved</button></td>
				<div id="myModal2" class="modal fade" role="dialog">
				  <div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 class="modal-title text-center">Are you sure you want to delete this item?</h3>
					  </div>
					  <form method="post" action="?action=addtosql" class="form-horizontal">
					  <div class="modal-footer">
						<button type="submit" class="btn btn-info pull-left" id="deleted" name="Id" value="'.$row['Id'].'">Yes</button>
						 <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
					  </div>
					  </form>
					</div>
				  </div>
				</div>';
		} else {
			echo'<td class="c"><a href="'.$row['Link'].'" type="button" class="btn btn-info btn-sm" >More  &raquo;</a></td>';
		}
		
		echo"</tr>";
		}
	}
	echo '</form>
	</tbody>
	</table>
	</div>
	</div>
	';
}

function search()
{
	
	if(! get_magic_quotes_gpc() )
	{
	   $info = addslashes ($_POST['Search']);
	}
	else
	{
	   $info = $_POST['Search'];
	}
	
	$array=getFacebookData(200);
	$arr= combineFbDB($array);
	$searchresult = searchData($info,$arr);
	usort($searchresult, function($a, $b) {
	  $ad = ($a['Date']);
	  $bd = ($b['Date']);

	  if ($ad == $bd) {
		return 0;
	  }

	  return $ad > $bd ? -1 : 1;
	});
	
	echo'<h3 class="text-center lol">Search results for : '; echo $info; echo '</h3>			
			<div class="col-sm-6">
			<h2 class="text-center lol">Lost</h2>
			 <div class="tbl-header">
			<table cellpadding="10" cellspacing="10" border="0">
			<thead>
			  <tr>
				<th class="d">Date</th>
				<th class="d">Information</th>
			  </tr>
			</thead>
			</table>
			</div>
			  <div class="tbl-content">
				<table cellpadding="0" cellspacing="0" border="0">
			<tbody>';
	echo '<form action="?action=deleted" method="post">';
	foreach ($searchresult as $row)
	{
		if (($row['Status']== 'LOST')) {
		echo"<tr>";
		echo'<td class="b">'.$row['Date']."</td>";
		echo'<td class="b">'.$row['Information'];
		if (($row['Attachment']!== null) && ($row['Attachment']!== "")) {
			echo '<br><img src="'.$row['Attachment'].'" alt="Mountain View" style="height:228px;" class="center-block"></br>';
		}
		echo"</td>";
		if (($row['Link']== null) && ($row['Link']== "")) {
			echo '<td class="c"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal2">Solved</button></td>
				<div id="myModal2" class="modal fade" role="dialog">
				  <div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 class="modal-title text-center">Are you sure you want to delete this item?</h3>
					  </div>
					  <form method="post" action="?action=addtosql" class="form-horizontal">
					  <div class="modal-footer">
						<button type="submit" class="btn btn-primary pull-left" id="deleted" name="Id" value="'.$row['Id'].'">Yes</button>
						 <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
					  </div>
					  </form>
					</div>
				  </div>
				</div>';
		} else {
			echo'<td class="c"><a href="'.$row['Link'].'" type="button" class="btn btn-primary btn-sm" >More  &raquo;</a></td>';
		}
		
		echo"</tr>";
		}
	}
	echo '</form>
	</tbody>
	</table>
	</div>
	</div>';
	
	echo '<div class="col-sm-6">
		<h2 class="lol text-center">Found</h2>
			<div class="tbl-header">
			<table cellpadding="0" cellspacing="0" border="0">
			<thead>
			  <tr>
				<th class="d">Date</th>
				<th class="d">Information</th>
			  </tr>
			</thead>
			</table>
			  </div>
			  <div class="tbl-content">
				<table cellpadding="0" cellspacing="0" border="0">
			<tbody>';
	echo '<form action="?action=deleted" method="post">';
	foreach ($searchresult as $row)
	{
		if ($row['Status']== 'FOUND') {
		echo"<tr>";
		echo'<td class="b">'.$row['Date']."</td>";
		echo'<td class="b">'.$row['Information'];
		if (($row['Attachment']!== null) && ($row['Attachment']!== "")) {
			echo '<br><img src="'.$row['Attachment'].'" alt="Mountain View" style="height:228px;" class="center-block"></br>';
		}
		echo"</td>";
		if (($row['Link']== null) && ($row['Link']== "")) {
			echo '<td class="c"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal2">Solved</button></td>
				<div id="myModal2" class="modal fade" role="dialog">
				  <div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 class="modal-title text-center">Are you sure you want to delete this item?</h3>
					  </div>
					  <form method="post" action="?action=addtosql" class="form-horizontal">
					  <div class="modal-footer">
						<button type="submit" class="btn btn-info pull-left" id="deleted" name="Id" value="'.$row['Id'].'">Yes</button>
						 <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
					  </div>
					  </form>
					</div>
				  </div>
				</div>';
		} else {
			echo'<td class="c"><a href="'.$row['Link'].'" type="button" class="btn btn-info btn-sm" >More  &raquo;</a></td>';
		}
		
		echo"</tr>";
		}
	}
	echo '</form>
	</tbody>
	</table>
	</div>
	</div>
	';
}

function add()
{
	echo '<div class="container">
	<div class="alert alert-success">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong>Added!</strong>';
	addtosql();
	echo '</div>
	</div>';
}

function delete()
{
	echo '<div class="container">
	<div class="alert alert-warning">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong>Deleted!</strong>';
	deletesql();
	echo '</div>
	</div>';
}

?>
