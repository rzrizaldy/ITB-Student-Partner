<?PHP 

include("connect.inc.php");
include("config.inc.php");
include("utils.inc.php");
include("lang.inc.php");

ignore_user_abort();
header("Refresh = 0");
if (!isset($username))
	$username = "";
if (!isset($password))
	$password = "";
if (!isset($color))
	$color = "1";

/* security checks */
$username = $username;
$password = $password;

/* is the login valid? */
$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = do_the_query($chat_db, $query);

if (mysqli_num_rows($result) != 0) {	/* login ok! */
	$failed_data = false;
}
else
	$failed_data = true;

if ($failed_data) {	/* sorry, there is an error*/
	header("Location: http://$your_host/index.php?username=$username");
	exit;
}

if (!isset($color)) {
	$color = random(6);
}

if (isset($msg)) {
	$query = "INSERT INTO msg(username, msg, color, sent_on) VALUES ('$username', '" . htmlspecialchars(addslashes($msg)) . "', '$color', DATE_ADD(NOW(), INTERVAL $diff_timezone HOUR))";
	do_the_query($chat_db, $query);

	/* update the user so that he is not thrown out of the chat */
	$query = "UPDATE users SET active = 'y', sent_on = DATE_ADD(NOW(), INTERVAL $diff_timezone HOUR) WHERE username = '$username'";
	do_the_query($chat_db, $query);
}

echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\r\n";

echo "<HTML>\r\n";
echo "<HEAD>\r\n";
echo "<LINK REL=\"stylesheet\" HREF=\"style.css.php\" TYPE=\"text/css\">\r\n";
echo "<script type=\"text/javascript\" src=\"validation.js\"></script>	";
echo "</HEAD>\r\n\r\n";

echo "<BODY CLASS=\"snd_msg\">\r\n";

echo "<FORM ACTION=\"$PHP_SELF\" METHOD=\"get\">\r\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"username\" VALUE=\"" . urlencode(addslashes($username)) . "\">\r\n";
echo "<INPUT TYPE=\"hidden\" NAME=\"password\" VALUE=\"$password\">\r\n";
echo "<SPAN CLASS=\"white\">$lang[your_msg] :</SPAN><BR>\r\n";
echo "<INPUT TYPE=\"text\" NAME=\"msg\" VALUE=\"\" SIZE=\"40\" MAXLENGTH=\"255\">\r\n";
echo "<SELECT NAME=\"color\" SIZE=\"1\">\r\n";
echo "<OPTION " . ($color == "1" ? "SELECTED" : "") . " VALUE=\"1\">$lang[white]</OPTION>\r\n";
echo "<OPTION " . ($color == "2" ? "SELECTED" : "") . " VALUE=\"2\">$lang[yellow]</OPTION>\r\n";
echo "<OPTION " . ($color == "3" ? "SELECTED" : "") . " VALUE=\"3\">$lang[red]</OPTION>\r\n";
echo "<OPTION " . ($color == "4" ? "SELECTED" : "") . " VALUE=\"4\">$lang[green]</OPTION>\r\n";
echo "<OPTION " . ($color == "5" ? "SELECTED" : "") . " VALUE=\"5\">$lang[blue]</OPTION>\r\n";
echo "<OPTION " . ($color == "6" ? "SELECTED" : "") . " VALUE=\"6\">$lang[brown]</OPTION>\r\n";
echo "<OPTION " . ($color == "7" ? "SELECTED" : "") . " VALUE=\"7\">$lang[violet]</OPTION>\r\n";
echo "<OPTION " . ($color == "8" ? "SELECTED" : "") . " VALUE=\"8\">$lang[light_red]</OPTION>\r\n";
echo "<OPTION " . ($color == "9" ? "SELECTED" : "") . " VALUE=\"9\">$lang[black]</OPTION>\r\n";
echo "</SELECT>\r\n";


echo "<INPUT TYPE=\"submit\" VALUE=\"$lang[send]\">\r\n";
?>

<?php
echo "</FORM>\r\n";

echo "</BODY>\r\n";
echo "</HTML>\r\n";
?>
