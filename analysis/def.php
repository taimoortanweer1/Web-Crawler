<?php

function remote_file_size($url){
    $head = "";
    $url_p = parse_url($url);

    $host = $url_p["host"];
    if(!preg_match("/[0-9]*\.[0-9]*\.[0-9]*\.[0-9]*/",$host)){

        $ip=gethostbyname($host);
        if(!preg_match("/[0-9]*\.[0-9]*\.[0-9]*\.[0-9]*/",$ip)){

            return -1;
        }
    }
    if(isset($url_p["port"]))
    $port = intval($url_p["port"]);
    else
    $port    =    80;

    if(!$port) $port=80;
    $path = $url_p["path"];

    $fp = fsockopen($host, $port, $errno, $errstr, 20);
    if(!$fp) {
        return false;
        } else {
        fputs($fp, "HEAD "  . $url  . " HTTP/1.1\r\n");
        fputs($fp, "HOST: " . $host . "\r\n");
        fputs($fp, "User-Agent: http://www.example.com/my_application\r\n");
        fputs($fp, "Connection: close\r\n\r\n");
        $headers = "";
        while (!feof($fp)) {
            $headers .= fgets ($fp, 128);
            }
        }
    fclose ($fp);

    $return = -2;
    $arr_headers = explode("\n", $headers);
    foreach($arr_headers as $header) {

        $s1 = "HTTP/1.1";
        $s2 = "Content-Length: ";
        $s3 = "Location: ";

        if(substr(strtolower ($header), 0, strlen($s1)) == strtolower($s1)) $status = substr($header, strlen($s1));
        if(substr(strtolower ($header), 0, strlen($s2)) == strtolower($s2)) $size   = substr($header, strlen($s2));
        if(substr(strtolower ($header), 0, strlen($s3)) == strtolower($s3)) $newurl = substr($header, strlen($s3));  
    }

    if(intval($size) > 0) {
        $return=intval($size);
    } else {
        $return=$status;
    }

    if (intval($status)==302 && strlen($newurl) > 0) {

        $return = remote_file_size($newurl);
    }
    return $return;
}



echo "first ".remote_file_size('http://stackoverflow.com/questions/2602612/php-remote-file-size-without-downloading-file');

echo "<br>";
echo "second ".remote_file_size('http://forums.phpfreaks.com/topic/109521-get-file-size-of-website-or-url/');

echo "<br>";
echo "3rd ".remote_file_size('https://developers.google.com/chart/interactive/docs/gallery/barchart');


?>