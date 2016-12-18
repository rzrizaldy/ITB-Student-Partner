<html>
<head>
        <link href="./css/mainstyle.css" rel="stylesheet">
    
</head>
<body>
<div class="wrapper-utama">
<div class="container-utama">
<h1>KOSAN BANDUNG</h1>
<?php

error_reporting(0);
$url = "ww.php";

ob_start(); // begin collecting output

include 'ww.php';

$kosan = ob_get_clean();

$e = json_decode($kosan,true);



function build_table($array){

    $html = '<table border="1">';

    // header row
    $html .= '<tr>';
    foreach($array as $key=>$value){
        $html .= '<tr>';
        foreach($value as $key2=>$value2){
            $html .= '<th>' . $key2 . '</th>';
        }
        $html .= '</tr>';
        break;
    }

    // data rows
    foreach($array as $key=>$value){
        $html .= '<tr>';
        foreach($value as $key2=>$value2){
            $html .= '<td>' . $value2 . '</td>';
        }
        $html .= '</tr>';
    }

    // finish table and return it

    $html .= '</table>';
    return $html;
}


$array = $e;

echo build_table($array);    

 
?>
</div>
</div>
</body>