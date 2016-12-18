<!DOCTYPE html>
<html>
<head>
<link rel = "stylesheet" type = "text/css" href= "style.css">
<script type="text/javascript" src = "Opreckepanitiaan.js"> </script>
        <link href="./css/mainstyle.css" rel="stylesheet">
</head>
<body>
<div class="wrapper-utama">
<div class="container-utama">
<center>
<h1> Form Kepanitian </h1>
 
 <div class="a1a">

  <button id="addInputButton" onclick="addInput()" >Text</button>
  <button id="addRadio" onclick="addRadio()" >Radio</button>
  <button id="addCheckList" onclick="addCheckBox()" >Check Box</button>
  <button id="addLongText" onclick="addLongText()" >Long Text</button>
<form action="actionPage.php" onsubmit="return validate()" method="POST">
<br>
 <input type="text"  name="namaKegiatan" value="Nama Kegiatan" class="namakegiatan" >
  <input type="hidden" id="numOfInputText" name="numOfInputText" value="0">
  <table border="0">
  <tr id="text1"></tr>
  <tr id="text2"></tr>
  <tr id="text3"></tr>
  <tr id="text4"></tr>
  <tr id="text5"></tr>
  <tr id="text6"></tr>
  <tr id="text7"></tr>
  <tr id="text8"></tr>
  <tr id="text9"></tr>
  <tr id="text10"></tr>
  </table>

<br>

 Tanggal Acara:
  <input type= "date" name="tanggalKegiatan" >
<br>
 


  <input type="hidden" id="numOfRadio" name="numOfRadio" value="0">
  <div id="radio1">
    <input type="hidden" id="numOfRadio1" name="numOfRadio1" value="0">
    <div id="radioname1"></div>
    <div id="radioButton1"></div>
    <div id="radio1#1"></div>
    <div id="radio1#2"></div>
    <div id="radio1#3"></div>
    <div id="radio1#4"></div>
    <div id="radio1#5"></div>
  </div>
  <div id="radio2">
    <input type="hidden" id="numOfRadio2" name="numOfRadio2" value="0">
    <div id="radioname2"></div>
    <div id="radioButton2"></div>
    <div id="radio2#1"></div>
    <div id="radio2#2"></div>
    <div id="radio2#3"></div>
    <div id="radio2#4"></div>
    <div id="radio2#5"></div>
  </div>
  <div id="radio3">
    <input type="hidden" id="numOfRadio3" name="numOfRadio3" value="0">
    <div id="radioname3"></div>
    <div id="radioButton3"></div>
    <div id="radio3#1"></div>
    <div id="radio3#2"></div>
    <div id="radio3#3"></div>
    <div id="radio3#4"></div>
    <div id="radio3#5"></div>
  </div>
  <div id="radio4">
    <input type="hidden" id="numOfRadio4" name="numOfRadio4" value="0">
    <div id="radioname4"></div>
    <div id="radioButton4"></div>
    <div id="radio4#1"></div>
    <div id="radio4#2"></div>
    <div id="radio4#3"></div>
    <div id="radio4#4"></div>
    <div id="radio4#5"></div>
  </div>
  <div id="radio5">
    <input type="hidden" id="numOfRadio5" name="numOfRadio5" value="0">
    <div id="radioname5"></div>
    <div id="radioButton5"></div>
    <div id="radio5#1"></div>
    <div id="radio5#2"></div>
    <div id="radio5#3"></div>
    <div id="radio5#4"></div>
    <div id="radio5#5"></div>
  </div>




  <input type="hidden" id="numOfCheckBox" name="numOfCheckBox" value="0">
  <div id="checkBox1">
    <input  type="hidden" id="numOfCheckBox1" name="numOfCheckBox1" value="0">
    <div id="checkBoxname1"></div>
    <div id="checkBoxButton1"></div>
    <div id="checkBox1#1"></div>
    <div id="checkBox1#2"></div>
    <div id="checkBox1#3"></div>
    <div id="checkBox1#4"></div>
    <div id="checkBox1#5"></div>
  </div>
  <div id="checkBox2">
    <input type="hidden" id="numOfCheckBox2" name="numOfCheckBox2" value="0">
    <div id="checkBoxname2"></div>
    <div id="checkBoxButton2"></div>
    <div id="checkBox2#1"></div>
    <div id="checkBox2#2"></div>
    <div id="checkBox2#3"></div>
    <div id="checkBox2#4"></div>
    <div id="checkBox2#5"></div>
  </div>
  <div id="checkBox3">
    <input type="hidden" id="numOfCheckBox3" name="numOfCheckBox3" value="0">
     <div id="checkBoxname3"></div>
    <div id="checkBoxButton3"></div>
    <div id="checkBox3#1"></div>
    <div id="checkBox3#2"></div>
    <div id="checkBox3#3"></div>
    <div id="checkBox3#4"></div>
    <div id="checkBox3#5"></div>
  </div>
  <div id="checkBox4">
    <input type="hidden" id="numOfCheckBox4" name="numOfCheckBox4" value="0">
    <div id="checkBoxname4"></div>
    <div id="checkBoxButton4"></div>
    <div id="checkBox4#1"></div>
    <div id="checkBox4#2"></div>
    <div id="checkBox4#3"></div>
    <div id="checkBox4#4"></div>
    <div id="checkBox4#5"></div>
  </div>
  <div id="checkBox5">
    <input type="hidden" id="numOfCheckBox5" name="numOfCheckBox5" value="0">
    <div id="checkBoxname5"></div>
    <div id="checkBoxButton5"></div>
    <div id="checkBox5#1"></div>
    <div id="checkBox5#2"></div>
    <div id="checkBox5#3"></div>
    <div id="checkBox5#4"></div>
    <div id="checkBox5#5"></div>
  </div>


  <input type="hidden" id="numOfLongText" name="numOfLongText" value="0">
  <div id="longText1"></div>
  <div id="longText2"></div>
  <div id="longText3"></div>
  <div id="longText4"></div>
  <div id="longText5"></div>
 
  <br><div>Selesai Mengedit Form</div><input id="finishEdit" type="checkbox" value="off" onclick="changeFinishBox()" name="vehicle1"><br><br>
  <input type="submit" name="submit">
<br>

</form>

</div>
</center>
</div>
</div>

</body>
</html>