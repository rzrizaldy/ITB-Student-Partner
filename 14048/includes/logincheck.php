<?php
if (!isset($_SESSION)) session_start();
$lolos = true;
if (isset($_SESSION["member"]) && $_SESSION["member"]!="ok") {
	$lolos = false;
} elseif (!isset($_SESSION["member"])) $lolos = false;
if ($lolos==false) {
	unset($_SESSION["member"]);
	session_destroy();
	header("Location: index.php");
	exit();
}
?>