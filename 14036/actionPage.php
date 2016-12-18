<?php
	
	

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$numOfText = test_input($_POST["numOfInputText"]);
		$numOfRadio = test_input($_POST["numOfRadio"]);
		$numOfCheckBox = test_input($_POST["numOfCheckBox"]);
		$numOfLongText = test_input($_POST["numOfLongText"]);
		$namaKegiatan = test_input($_POST["namaKegiatan"]);
		$tanggalKegiatan = test_input($_POST["tanggalKegiatan"]);


		$numOfRadioChoice = array();
		$numOfCheckBoxChoice = array();
		$textQuestion = array();
		$radioQuestion = array();
		$checkBoxQuestion = array();
		$longTextQuestion = array();
		$radioChoice = array();
		$checkBoxChoice = array();

		$textQuestionStr = "";
		$radioQuestionStr = "";
		$checkBoxQuestionStr = "";
		$longTextQuestionStr = "";
		$radioChoiceStr = "";
		$checkBoxChoiceStr = ""; 
		$numOfRadioChoiceStr= "";
		$numOfCheckBoxChoiceStr= "";

		for ($i=1; $i <= $numOfRadio; $i++) {
			$numOfRadioChoice[$i] = test_input($_POST["numOfRadio".$i]);
			$numOfRadioChoiceStr = $numOfRadioChoiceStr."#".$numOfRadioChoice[$i];
		}

		for ($i=1; $i <= $numOfCheckBox; $i++) {
			$numOfCheckBoxChoice[$i] = test_input($_POST["numOfCheckBox".$i]);
			$numOfCheckBoxChoiceStr = $numOfCheckBoxChoiceStr."#".$numOfCheckBoxChoice[$i];
		}

		for($i=1; $i <= $numOfText; $i++) {
			$textQuestion[$i] = test_input($_POST["textQuestion".$i]);
			$textQuestionStr = $textQuestionStr."#".$textQuestion[$i];
		}

		for($i=1; $i <= $numOfRadio; $i++) {
			$radioQuestion[$i] = test_input($_POST["radioQuestion".$i]);
			$radioQuestionStr = $radioQuestionStr."#".$radioQuestion[$i];
		}

		for($i=1; $i <= $numOfCheckBox; $i++) {
			$checkBoxQuestion[$i] = test_input($_POST["checkBoxQuestion".$i]);
			$checkBoxQuestionStr = $checkBoxQuestionStr."#".$checkBoxQuestion[$i];
		}

		for($i=1; $i <= $numOfLongText; $i++) {
			$longTextQuestion[$i] = test_input($_POST["longTextQuestion".$i]);
			$longTextQuestionStr = $longTextQuestionStr."#".$longTextQuestion[$i];
		}
		$k = 1;
		for($i=1; $i<= $numOfRadio; $i++) {
			for ($j = 1; $j <= $numOfRadioChoice[$i]; $j++) {
				$radioChoice[$k] = test_input($_POST["radioChoice".$i."#".$j]);
				$radioChoiceStr = $radioChoiceStr."#".$radioChoice[$k];
				$k++;
			}
		}

		$k = 1;
		for($i=1; $i<= $numOfCheckBox; $i++) {
			for ($j = 1; $j <= $numOfCheckBoxChoice[$i]; $j++) {
				$checkBoxChoice[$k] = test_input($_POST["checkBoxChoice".$i."#".$j]);
				$checkBoxChoiceStr = $checkBoxChoiceStr."#".$checkBoxChoice[$k];
				$k++;
			}
		}

		$sql = "INSERT INTO opreckepanitiaan(numOfText, numOfLongText, numOfRadio, numOfCheckBox, textName, longTextName, radioName, checkBoxName, radioChoice, checkBoxChoice,numOfRadioChoice,numOfCheckBoxChoice,namaKegiatan,tanggalKegiatan) VALUES ('$numOfText','$numOfLongText','$numOfRadio','$numOfCheckBox','$textQuestionStr','$longTextQuestionStr','$radioQuestionStr','$checkBoxQuestionStr','$radioChoiceStr','$checkBoxChoiceStr','$numOfRadioChoiceStr','$numOfCheckBoxChoiceStr','$namaKegiatan','$tanggalKegiatan')";
		$connect =mysqli_connect("sql6.freemysqlhosting.net", "sql6148418", "2szpvIT4BX", "sql6148418");
		if (mysqli_query($connect, $sql) ) {
			echo "success";

			$sql = "SELECT id FROM opreckepanitiaan WHERE namaKegiatan = '$namaKegiatan'";
			$result = mysqli_query($connect, $sql);
			$row = $result->fetch_assoc();
			$id = $row["id"];
			echo "<br><br><a href='http://localhost:82/OprecKepanitiaan/calldb.php?id=".$id."'><h2>Go To Form</h2></a><br>";

		}
		



		echo $numOfText;
		echo $numOfRadio;
		echo $numOfCheckBox;
		echo $numOfLongText;
		echo $textQuestionStr;	
		echo $checkBoxChoiceStr;
		echo $namaKegiatan;
		echo $tanggalKegiatan;

	}

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>