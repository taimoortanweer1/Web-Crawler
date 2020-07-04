<?php
function remotefileSize($url) {
	 $uh = curl_init();  
    curl_setopt($uh, CURLOPT_URL, $url);  
      
    // set NO-BODY to not receive body part  
    curl_setopt($uh, CURLOPT_NOBODY, 1);  
      
    // set HEADER to be false, we don't need header  
    curl_setopt($uh, CURLOPT_HEADER, 0);  
      
    // retrieve last modification time  
    curl_setopt($uh, CURLOPT_FILETIME, 1);  
    curl_exec($uh);  
      
    // assign filesize into $filesize variable  
    $filesize = curl_getinfo($uh,CURLINFO_CONTENT_LENGTH_DOWNLOAD);  
      
    // assign file modification time into $filetime variable  
    $filetime = curl_getinfo($uh,CURLINFO_FILETIME);  
    curl_close($uh);  
      
    // push out  
    return $filesize; 
}



//echo remotefileSize('http://stackoverflow.com/questions/2602612/php-remote-file-size-without-downloading-file');
//echo "<br>";
$a= remotefileSize('http://stackoverflow.com/questions/2602612/php-remote-file-size-without-downloading-file');
echo $a;


?>