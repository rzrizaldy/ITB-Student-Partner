

function addInput() {
	var inputButton = document.getElementById("numOfInputText").value;
	if (inputButton < 10) {
		inputButton++;
		document.getElementById("numOfInputText").value = inputButton;
		document.getElementById("text"+inputButton).innerHTML = '<input id="dataname'+inputButton+'" name="textQuestion'+inputButton+'" class="datadiri" type = "name" value = "Data"></td><td> :</td><td> <input id="datainput'+inputButton+'" type="text" name="fname">'
	}

}

function addRadio() {
	var numOfRadio = document.getElementById("numOfRadio").value;
	if (numOfRadio < 5) {
		numOfRadio++;
		document.getElementById("numOfRadio").value = numOfRadio;
		var numOfCurrentRadioChoice = document.getElementById("numOfRadio"+numOfRadio).value;
		numOfCurrentRadioChoice++;
		document.getElementById("numOfRadio"+numOfRadio).value = numOfCurrentRadioChoice;
		document.getElementById("numOfRadio").value = numOfRadio;
		document.getElementById("radioButton"+numOfRadio).innerHTML = '<button onclick="addRadioChoice('+numOfRadio+')">Add Choice</button>'
		document.getElementById("radioname"+numOfRadio).innerHTML = '<br><textarea name="radioQuestion'+numOfRadio+'" rows="3" cols="30"<input id="radioQuestion'+numOfRadio+'" class="pertanyaan" >Edit Pertanyaan</textarea>';
		document.getElementById("radio"+numOfRadio+"#1").innerHTML = '<input type="radio" name="gender" value="male" checked> <input name="radioChoice'+numOfRadio+'#1" class="pilihan" type = "name" value = "Male"><br>';
	}
}

function addRadioChoice(radioId) {
	var numOfCurrentRadioChoice = document.getElementById("numOfRadio"+radioId).value;
	if (numOfCurrentRadioChoice < 5) {
		numOfCurrentRadioChoice++;
		document.getElementById("numOfRadio"+radioId).value = numOfCurrentRadioChoice;
		document.getElementById("radio"+radioId+"#"+numOfCurrentRadioChoice).innerHTML = '<input type="radio" name="gender" value="male" checked> <input name="radioChoice'+radioId+'#'+numOfCurrentRadioChoice+'" class="pilihan" type = "name" value = "Male"><br>';
	}
}

function addCheckBox() {
	var numOfCheckBox = document.getElementById("numOfCheckBox").value;
	if (numOfCheckBox < 5) {
		numOfCheckBox++;
		document.getElementById("numOfCheckBox").value = numOfCheckBox;
		var numOfCurrentCheckBoxChoice = document.getElementById("numOfCheckBox"+numOfCheckBox).value;
		numOfCurrentCheckBoxChoice++;
		document.getElementById("numOfCheckBox"+numOfCheckBox).value = numOfCurrentCheckBoxChoice;
		document.getElementById("numOfCheckBox").value = numOfCheckBox;
		document.getElementById("checkBoxButton"+numOfCheckBox).innerHTML = '<button onclick="addCheckBoxChoice('+numOfCheckBox+')">Add Choice</button>'
		document.getElementById("checkBoxname"+numOfCheckBox).innerHTML = '<br><textarea name="checkBoxQuestion'+numOfCheckBox+'" rows="3" cols="30"<input id="checkBoxQuestion'+numOfCheckBox+'" class="pertanyaan" >Edit Pertanyaan</textarea>';
		document.getElementById("checkBox"+numOfCheckBox+"#1").innerHTML = '<input type="checkbox" name="vehicle1" value="Bike"><input name="checkBoxChoice'+numOfCheckBox+'#1" class="pilihan" type = "name" value = "Other"> <br>';
	}
}

function addCheckBoxChoice(checkBoxId) {
	var numOfCurrentCheckBoxChoice = document.getElementById("numOfCheckBox"+checkBoxId).value;
	if (numOfCurrentCheckBoxChoice < 5) {
		numOfCurrentCheckBoxChoice++;
		document.getElementById("numOfCheckBox"+checkBoxId).value = numOfCurrentCheckBoxChoice;
		document.getElementById("checkBox"+checkBoxId+"#"+numOfCurrentCheckBoxChoice).innerHTML = '<input type="checkbox" name="vehicle1" value="Bike"><input name="checkBoxChoice'+checkBoxId+'#'+numOfCurrentCheckBoxChoice+'" class="pilihan" type = "name" value = "Other"> <br>';
	}
}

function addLongText() {
	var numOfLongText = document.getElementById("numOfLongText").value;
	if (numOfLongText < 5) {
		numOfLongText++;
		document.getElementById("numOfLongText").value = numOfLongText;
		document.getElementById("longText"+numOfLongText).innerHTML = '<br><textarea name="longTextQuestion'+numOfLongText+'" rows="3" cols="30"<input id="longTextQuestion'+numOfLongText+'" class="pertanyaan" >Edit Pertanyaan</textarea><textarea name="message" rows="10" cols="30">Deskripsi jawaban.</textarea><br>';
	}

}

function changeFinishBox() {
	var finishEdit = document.getElementById("finishEdit").value;
	if (finishEdit == "off") {
		document.getElementById("finishEdit").value = "on";
	}
	else {
		document.getElementById("finishEdit").value = "off";
	}
	console.log(document.getElementById("finishEdit").value);
}

function validate() {
	var finishEdit = document.getElementById("finishEdit").value;
	if (finishEdit == "on") {
		return true;
	}
	else {
		return false;
	}
}


function changeCheckBox (k) {
	var val= document.getElementById("checkBoxChoice"+k).value;
	if (val == "0") {
		document.getElementById("checkBoxChoice"+k).value = "1";
	}
	else 
	{
		document.getElementById("checkBoxChoice"+k).value = "0";
	}

}

