<?php

function get_web_page( $url, $cookie='' )
{
    $options = array(
        CURLOPT_RETURNTRANSFER    => true,   // return web page
        CURLOPT_HEADER            => false, // don't return headers
        CURLOPT_FOLLOWLOCATION    => true,   // follow redirects
        CURLOPT_ENCODING          => "",       // handle all encodings
        CURLOPT_USERAGENT         => "Arsi", // who am i
        CURLOPT_AUTOREFERER       => true,   // set referer on redirect
        CURLOPT_CONNECTTIMEOUT    => 120,     // timeout on connect
        CURLOPT_TIMEOUT           => 120,     // timeout on response
        CURLOPT_MAXREDIRS         => 10,       // stop after 10 redirects
        CURLOPT_SSL_VERIFYPEER    => false, // Disabled SSL Cert checks
        //CURLOPT_COOKIE            => $cookie
        CURLOPT_HTTPHEADER => array(
            'origin: https://mamikos.com' 
            ,'accept-encoding: gzip, deflate, br' 
            ,'accept-language: id-ID,id;q=0.8,en-US;q=0.6,en;q=0.4' 
            ,'authorization: GIT WEB:WEB' 
            ,'cookie: __cfduid=d5a138bdd439f9bcaae922eac738781361481470750; _ga=GA1.2.1396765317.1481470753; _gat=1; __utmt=1; __utma=143567529.1396765317.1481470753.1481470753.1481470753.1; __utmb=143567529.3.10.1481470753; __utmc=143567529; __utmz=143567529.1481470753.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none); XSRF-TOKEN=eyJpdiI6Imk1U0xwZkt0b1liZ3pXVDJcL2tJME9BPT0iLCJ2YWx1ZSI6Ijlsa0VhSWg0V1pPXC9JMUxRVXo3SDJEMXg1aXlZWWxqOTNVSlp4XC9pSVdGbDFXOFRUT1JzYmJuZHhBUzFRMjBVSHdpVFEzODVjNUZpMkM5cTNqcCtJdkE9PSIsIm1hYyI6ImUzMzZkOGUzZGYwYTNiZTU4MzJkNGU0NGQ5NWZmYjlhOWVhYmIxYTJhMjQxM2UyMjU1MmU3NzY4YjI4MTg0ZGUifQ%3D%3D; laravel_session=eyJpdiI6ImRVdW9lcEVYWGU5bUwwREk3Rm1oTUE9PSIsInZhbHVlIjoiVnlnMnN2dmZib1ppWlBYMlhwcGp3NkIxZFUrcU9SdGNWYTZZdnR5S1JzSjJmNUphRzRlN0FPODhsaVpcL2w0VEtLVFo0S1wvN2F0ZjZ2MERpT1VjZkdVUT09IiwibWFjIjoiMWQ4ZDhhNjdmZjhiMWE0NjY4N2M3NDc3YjY0MjU0NDBiZmE3OWYxZGRlNTE3YTYwNGZmMjA1OWFjZDYzY2E5ZiJ9' 
            ,'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.75 Safari/537.36' 
            ,'x-xsrf-token: eyJpdiI6Imk1U0xwZkt0b1liZ3pXVDJcL2tJME9BPT0iLCJ2YWx1ZSI6Ijlsa0VhSWg0V1pPXC9JMUxRVXo3SDJEMXg1aXlZWWxqOTNVSlp4XC9pSVdGbDFXOFRUT1JzYmJuZHhBUzFRMjBVSHdpVFEzODVjNUZpMkM5cTNqcCtJdkE9PSIsIm1hYyI6ImUzMzZkOGUzZGYwYTNiZTU4MzJkNGU0NGQ5NWZmYjlhOWVhYmIxYTJhMjQxM2UyMjU1MmU3NzY4YjI4MTg0ZGUifQ==' 
            ,'content-type: application/json' 
            ,'accept: application/json, text/plain, */*' 
            ,'referer: https://mamikos.com/carikos?position=%7B%22center%22%3A%5B107.61912280000001%2C-6.917463899999999%5D%2C%22zoom%22%3A13%2C%22name%22%3A%22Bandung%22%2C%22geometry%22%3A%7B%22lat%22%3A-6.917463899999999%2C%22lng%22%3A107.61912280000001%7D%7D&location=%7B%22location%22%3A%5B%5B107.56912280000002%2C-6.9674638999999985%5D%2C%5B107.66912280000001%2C-6.867463899999999%5D%5D%7D&filters=%7B%22price_range%22%3A%5B200000%2C20000000%5D%2C%22rent_type%22%3A2%2C%22gender%22%3A%5B0%2C1%2C2%5D%7D&name=Bandung&loc1=107.56912280000002,-6.9674638999999985&loc2=107.66912280000001,-6.867463899999999&referer=landing_page' 
            ,'authority: mamikos.com' 
            ,'x-git-time: 1406090202' )
        ,CURLOPT_POST   => 1
        ,CURLOPT_POSTFIELDS => '{"page":1,"location":[[107.56912280000002,-6.9674638999999985],[107.66912280000001,-6.867463899999999]],"filters":{"price_range":[200000,20000000],"gender":[0,1,2],"rent_type":"2"},"sorting":{"field":"price","direction":"asc"},"referer":"carikos"}'
    );

    $ch   = curl_init( $url );
    curl_setopt_array( $ch, $options );
    $content = curl_exec( $ch );
    $err     = curl_errno( $ch );
    $errmsg  = curl_error( $ch );
    $header  = curl_getinfo( $ch );
    curl_close( $ch );

    $header['errno']   = $err;
    $header['errmsg']  = $errmsg;
    $header['content'] = $content;
    return $header;
}

$isi = json_decode(get_web_page('https://mamikos.com/garuda/stories/list')['content'])->rooms;
echo json_encode($isi);
?>
