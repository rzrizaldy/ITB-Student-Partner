<?php
try
{
	$bdd = new PDO('mysql:host=sql6.freemysqlhosting.net;dbname=sql6148849;charset=utf8', 'sql6148849', 'ZC6kkLF88Z');
}
catch(Exception $e)
{
        die('Error : '.$e->getMessage());
}
