<?php
	 
	$id =  $_GET["id"];
	
$sql = "SELECT * from opreckepanitiaan where id = '$id' ";
$connect =mysqli_connect("sql6.freemysqlhosting.net", "sql6148418", "2szpvIT4BX", "sql6148418");
$result = mysqli_query($connect, $sql); 


if ($result) {
	$row = $result->fetch_assoc();
	$numOfText = $row["numOfText"];
	$numOfRadio = $row["numOfRadio"];
	$numOfCheckBox = $row["numOfCheckBox"];
	$numOfLongText = $row["numOfLongText"];
	$textQuestionStr = $row["textName"];
	$radioQuestionStr = $row["radioName"];
	$checkBoxQuestionStr = $row["checkBoxName"];
	$longTextQuestionStr = $row["longTextName"];
	$radioChoiceStr = $row["radioChoice"];
	$checkBoxChoiceStr = $row["checkBoxChoice"];
	$numOfRadioChoiceStr= $row["numOfRadioChoice"];
	$numOfCheckBoxChoiceStr= $row["numOfCheckBoxChoice"];
	$namaKegiatan = $row["namaKegiatan"];
	$tanggalKegiatan = $row["tanggalKegiatan"];
}

?>
<!DOCTYPE html>
<html>
<head>
<link rel = "stylesheet" type = "text/css" href= "style.css">
<script type="text/javascript" src = "Opreckepanitiaan.js"> </script>

</head>
<body>

<center>
<h1> Form Kepanitian </h1>
 
 <div class="a1a">

 <form action="responden.php" method="POST">
<input type="hidden" name ="formId" value= <?php echo $id ;?>>
<h2> <?php echo $namaKegiatan; ?></h2>
 
<table border="0">
  <tbody>
<?php

	if ($numOfText > 0) {
	$textQuestionStr = ltrim($textQuestionStr, '#');
	$textQuestionStr = explode('#',$textQuestionStr,$numOfText);
	}

	for ($i=1; $i<=$numOfText; $i++) {
	?>
	<tr id="text1"><p id="dataname1" class="datadiri" type="name" value="Data"><?php echo $textQuestionStr[$i-1] ?>:</p>  <input id="datainput1" type="text" name=<?php echo "text".$i ?>></tr>

	<?php
	}
	?>
	</tbody>
	</table>
	<br>
	Tanggal Acara:
	<?php echo $tanggalKegiatan; ?>
	<br>
	<br>
	<?php
	if ($numOfRadio > 0) {
	$radioQuestionStr = ltrim($radioQuestionStr, '#');
	$radioQuestionStr = explode('#',$radioQuestionStr,$numOfRadio-1);

	$numOfRadioChoiceStr = ltrim($numOfRadioChoiceStr, '#');
	$numOfRadioChoiceStr = explode('#',$numOfRadioChoiceStr,$numOfRadio-1);

	$radioChoiceStr = ltrim($radioChoiceStr, '#');
	$radioChoiceStr = explode('#',$radioChoiceStr);

	}
	$k = 0;
	for ($i=1; $i<=$numOfRadio; $i++) {
	?>
  		<br>
		<p><?php echo $radioQuestionStr[$i-1]; ?></p>
		<?php for($j=1;$j <= $numOfRadioChoiceStr[$i-1]; $j++) {?>
			<input type="radio" name=<?php echo "radio".$i; ?>   value = <?php echo $radioChoiceStr[$k]; ?>><?php echo $radioChoiceStr[$k]; ?><br>
		<?php $k++; } ?>
		<br>
	<?php
	}
	$jumlahPilihanRadio = $k-1;

	if ($numOfCheckBox > 0) {
	$checkBoxQuestionStr = ltrim($checkBoxQuestionStr, '#');
	$checkBoxQuestionStr = explode('#',$checkBoxQuestionStr,$numOfCheckBox-1);

	$numOfCheckBoxChoiceStr = ltrim($numOfCheckBoxChoiceStr, '#');
	$numOfCheckBoxChoiceStr = explode('#',$numOfCheckBoxChoiceStr,$numOfCheckBox-1);

	$checkBoxChoiceStr = ltrim($checkBoxChoiceStr, '#');
	$checkBoxChoiceStr = explode('#',$checkBoxChoiceStr);
	}
	$k =0;
	for ($i=1; $i<=$numOfCheckBox; $i++) {
	?>
		<br>
		<p><?php echo $checkBoxQuestionStr[$i-1]; ?></p>
		<?php for($j=1;$j <= $numOfCheckBoxChoiceStr[$i-1]; $j++) {?>
			<input type="checkbox" name=<?php echo "checkBox".$k; ?> value="0" onclick = <?php echo "changeCheckBox(".$k.")"; ?> id =<?php echo "checkBoxChoice".$k; ?>> <?php echo $checkBoxChoiceStr[$k]; ?><br>
		<?php $k++; } ?>
		<br>
	<?php
	}
	$jumlahPilihanCheckBox = $k-1;

	if ($numOfLongText > 0) {
		$longTextQuestionStr = ltrim($longTextQuestionStr, '#');
		$longTextQuestionStr = explode('#',$longTextQuestionStr,$numOfLongText);
	}

	for ($i=1; $i<=$numOfLongText; $i++) {
	?>
		 <br>
		 <p><?php echo $longTextQuestionStr[$i-1] ?></p>
  		 <textarea name=<?php echo "longText".$i ?> rows="3" cols="30"></textarea>
  		 <br>
	
	<?php } ?>
	<input type="hidden" name= "jumlahPilihanRadio" value=<?php echo $numOfRadio;?>>
	<input type="hidden" name= "jumlahPilihanCheckBox" value =<?php echo $jumlahPilihanCheckBox; ?>>
	<input type="submit" name="submit">
	</form>

</div>
</center>

</body>
</html>