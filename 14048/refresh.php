<?php
if ( file_exists("json/reload.txt")) {
	$reload = "1";
	unlink("json/reload.txt");
} else $reload = "0";
$s = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
$s .= "<tstatus>\n";
$s .= "<ulang>".$reload."</ulang>\n";
$s .= "</tstatus>\n";
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-type: text/xml');
//header('Content-Disposition: attachment; filename="dataxml.xml"');
echo $s;
unset($s);
?>