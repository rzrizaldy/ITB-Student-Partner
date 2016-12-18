<?PHP 

include("config.inc.php");
include("lang.inc.php");

echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\r\n";

echo "<HTML>\r\n";
echo "<HEAD>\r\n";
echo "<LINK REL=\"stylesheet\" HREF=\"style.css.php\" TYPE=\"text/css\">\r\n";
echo "</HEAD>\r\n\r\n";

echo "<BODY CLASS=\"logo\">\r\n";
echo "<DIV CLASS=\"center\">\r\n";
echo "<SPAN CLASS=\"smallwhite\"><A HREF=\"http://$your_host/\" target=\"_top\"><IMG SRC=\"$logo_url\" ALT=\"$lang[logo_desc]\" BORDER=\"0\"></A></SPAN>\r\n";
echo "</DIV>\r\n";
echo "</BODY>\r\n";
echo "</HTML>\r\n";
?>
