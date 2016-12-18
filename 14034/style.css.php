<?PHP 

include("config.inc.php");

header("Content-Type: text/css");

echo "body { BACKGROUND-COLOR: #50a3a2; BACKGROUND-IMAGE: url($index_bgimage); FONT-FAMILY: tahoma, verdana, arial, helvetica, sans-serif; FONT-SIZE: 10pt; }\r\n";

echo ".talk { BACKGROUND-COLOR: #000; BACKGROUND-IMAGE: url($talk_bgimage); BACKGROUND-ATTACHMENT: fixed; }\r\n";
echo ".users { BACKGROUND-COLOR: $users_bgcolor; BACKGROUND-IMAGE: url($users_bgimage); }\r\n";
echo ".snd_msg { BACKGROUND-COLOR: $msg_bgcolor; BACKGROUND-IMAGE: url($msg_bgimage); }\r\n";
echo ".logo { BACKGROUND-COLOR: $logo_bgcolor; BACKGROUND-IMAGE: url($logo_bgimage); }\r\n";

echo "form, tr, td, ul, ol, p, h1, h2, h3, h4 { COLOR: $white; FONT-FAMILY: tahoma, verdana, arial, helvetica, sans-serif; FONT-SIZE: 10pt; }\r\n";

echo ".bigwhite { COLOR: $white; FONT-SIZE: 10pt; FONT-WEIGHT: bold; }\r\n";
echo ".smallwhite { FONT-SIZE: 8pt; COLOR: $white; }\r\n";

echo ".white { FONT-SIZE: 11pt; FONT-WEIGHT: normal; COLOR: $white; }\r\n";
echo ".notes { FONT-SIZE: 11pt; FONT-WEIGHT: normal; COLOR: $darkyellow; }\r\n";

echo ".highlight { COLOR: $white; }\r\n";

echo "a.chat:link { COLOR: $white; TEXT-DECORATION: underline; FONT-WEIGHT: bold; }\r\n";
echo "a.chat:visited { COLOR: $white; TEXT-DECORATION: underline; FONT-WEIGHT: bold; }\r\n";
echo "a.chat:active { COLOR: $white; TEXT-DECORATION: underline; FONT-WEIGHT: bold; }\r\n";
echo "a.chat:hover { COLOR: $darkyellow; TEXT-DECORATION: underline; FONT-WEIGHT: bold; }\r\n";

echo ".left { TEXT-ALIGN: left; }\r\n";
echo ".center2 { TEXT-ALIGN: center; PADDING-TOP: 7%; PADDING-LEFT: 22%;}\r\n";
echo ".center { TEXT-ALIGN: center;}\r\n";
echo ".right { TEXT-ALIGN: right; }\r\n";
?>
