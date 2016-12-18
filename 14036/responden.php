<?php
	
	

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$formId = test_input($_POST["formId"]);
		$jumlahPilihanRadio =test_input($_POST["jumlahPilihanRadio"]);
		$jumlahPilihanCheckBox = test_input($_POST["jumlahPilihanCheckBox"]);
		$sql = "SELECT * from opreckepanitiaan where id = '$formId'";
		$connect =mysqli_connect("sql6.freemysqlhosting.net", "sql6148418", "2szpvIT4BX", "sql6148418");
		$result = mysqli_query($connect, $sql);
		if ( $result) {
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
				echo "success";
				echo $jumlahPilihanCheckBox;
		}	

		$textAnswerStr = "";
		$radioAnswerStr = "";
		$checkBoxAnswerStr = "";
		$longTextAnswerStr = "";
		
		for ($i=1; $i<=$numOfText; $i++) {
			$textAnswerStr = $textAnswerStr."#".test_input($_POST["text".$i]);
		}

		for ($i=1; $i<=$numOfLongText; $i++) {
			$longTextAnswerStr = $longTextAnswerStr."#".test_input($_POST["longText".$i]);
		}
		for ($i=1; $i<=$jumlahPilihanRadio; $i++) {
			$radioAnswerStr = $radioAnswerStr."#".test_input($_POST["radio".$i]);
		}
		for ($i=0; $i<=$jumlahPilihanCheckBox; $i++) {
			$test = test_input($_POST["checkBox".$i]);
			echo "--".$i;
			echo "---".$test;
			if ($test == "1")
				$checkBoxAnswerStr = $checkBoxAnswerStr."#".$test;
			else {
				$checkBoxAnswerStr = $checkBoxAnswerStr."#"."0";
			}
		}		
		$sql = "INSERT INTO respon(formId, jawabanText, jawabanLongText, jawabanRadio, jawabanCheckbox) VALUES ('$formId','$textAnswerStr','$longTextAnswerStr','$radioAnswerStr','$checkBoxAnswerStr')";
		if (mysqli_query($connect, $sql) ) {
			echo "success";
			header("Location: http://www.google.com"); //redirect nya atur yahh than kemana supaya lebih tepat
			die();
		}

	}


		function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

?>