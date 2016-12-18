<?PHP

/* name of the chat-db */
$chat_db = "chatty";

/* Title/name of chat */
$chat_title = "Chatume - ITB Online Chat for Students";

/* colors */
$darkyellow = "#FF9900";
$red = "#ff0000";
$white = "#FFFFFF";
$blue = "#50a3a2";
$darkblue = "#666699";
$lightblue = "#ccccff";
$black = "#000000";
$yellow = "#FFFF00";
$green = "#009900";
$violet = "#990099";
$brown = "#996633";
$gray = "#666666";

/* Index background */
$index_bgimage = "";
$index_bgcolor = "000099";
$index_header_bgcolor = "#666699";
$index_table_bgcolor = "#ccccff";

/* Talk background */
$talk_bgimage = "";
$talk_bgcolor = "#ccccff";

/* Send Message background */
$msg_bgimage = "";
$msg_bgcolor = "#666699";

/* Users background */
$users_bgimage = "";
$users_bgcolor = "#666699";

/* Logo background */
$logo_bgimage = "";
$logo_bgcolor = "#666699";

/* logo image attributes */
$logo_url = "http://URL-TO-YOUR-LOGO";
$logo_height = "80";
$logo_width = "80";


/* host specification */
$your_host = "URL-TO-YOUR-HOST"; //This will be used by the logoff function to bring the user to your host site.  Do not enter "http://"
$mail_address = "you@yourhost.com"; //Administrator's email address.  This is seen by users.

/* difference, in hours, between local server time and your timezone */
$diff_timezone = "0";

/* the time (in seconds) to refresh the list of the users (in seconds) */
$refresh_users_every = "3";

/* The time (in seconds) to refresh the talk window */
$talk_refresh = "1";

/* days before a message is deleted from the database */
$msg_delete = "1"; //If set to 0, and the chat is loaded, all chat messages will be deleted.  Same if the value is empty

/* limit on number of messages to display */
$display_limit = "20";

foreach ($_REQUEST as $key=>$value) $$key = $value;
foreach ($_SERVER as $key=>$value) $$key = $value;

/* set error reporting to 0 */
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
?>
