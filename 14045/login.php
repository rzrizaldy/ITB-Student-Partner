<?php

include 'olurl.php';
include 'htmlparser.php';

$url1 = getlastolurl(getlastolurl("https://ol.akademik.itb.ac.id/"));
$url = "https://ol.akademik.itb.ac.id/frs/lihatFRSMhsBaru.php";

//debug olurl

//Authenticate user

  $ua = 'Mozilla/5.0 (Windows NT 5.1; rv:16.0) Gecko/20100101 Firefox/16.0 (ROBOT)';
  $cookiefile = "tmp/cookies.txt";
  $headers = array(
      "Connection: keep-alive",
      "Cache-control: max-age=0",
      "Upgrade-Insecure-Requests: 1",
      "User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36 (ROBOT)",
      "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*,q=0.8",
      "Accept-Encoding: gzip, deflate, br",
      "Accept-Language: en-GB,en;q=0.8,en-US;q=0.6,id;q=0.4"
  );
  //$url1 = "the login url generating the session ID";

  $ch             = curl_init();

  curl_setopt($ch, CURLOPT_URL,            $url1);
  curl_setopt($ch, CURLOPT_COOKIEFILE,     $cookiefile);
  curl_setopt($ch, CURLOPT_COOKIEJAR,      $cookiefile);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, True);
  curl_setopt($ch, CURLOPT_NOBODY,         False);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);
  curl_setopt($ch, CURLOPT_BINARYTRANSFER, True);
  curl_setopt($ch, CURLOPT_REFERER,        $url1);

  /*curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_PROXY, '127.0.0.1:8888');*/
  $ret    = curl_exec($ch);

  $fields = array(
        'user_id' => $_GET['user_id'],
        'password' => $_GET['password'],
        'submit' => 'Login',
    );
    $coded = array();
    foreach($fields as $field => $value){
        $coded[] = $field . '=' . urlencode($value);}
    $string = implode('&', $coded);

    curl_setopt($ch, CURLOPT_URL,         $url1); //same URL as before, the login url generating the session ID
    curl_setopt($ch, CURLOPT_HTTPHEADER,     $headers);
    curl_setopt($ch, CURLOPT_REFERER,        $url1);
    curl_setopt($ch, CURLOPT_COOKIEFILE,     $cookiefile);
    curl_setopt($ch, CURLOPT_POST,        True);
    curl_setopt($ch, CURLOPT_POSTFIELDS,  $string);
    curl_setopt($ch, CURLOPT_AUTOREFERER, True);
    $ret    = curl_exec($ch);


    curl_setopt($ch, CURLOPT_POST,        False);
    curl_setopt($ch, CURLOPT_HTTPGET,     True);

    // Start spidering
    curl_setopt($ch, CURLOPT_URL, $url);
    $classpage = curl_exec($ch);
    if (False === $classpage)
    {
        echo "Something went wrong, check curl_error() and curl_errno().<br>";
        echo curl_error($ch);
    }
    curl_close($ch);
    //unlink($cookiefile);

//$classes = parsehtml("https://ol.akademik.itb.ac.id/frs/lihatFRSMhsBaru.php");

$classes = parsehtml($classpage);

echo "<table border = 1>";
$i = 0;
while ($i <= 22){
    echo "<tr>";
    echo "<td>" . $classes[$i] . "</td>";
    $i = $i + 1;
    echo "<td>" . $classes[$i] . "</td>";
    $i = $i + 1;
    echo "</tr>";
}
echo "</table>";

unset($classpage);
unset($ch);

?>
