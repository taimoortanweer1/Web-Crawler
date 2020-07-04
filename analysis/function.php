<?php
// function.php - URL validate function
validateURL($url,$valid_exts)
{
$url = trim($url);
if(filter_var($url,FILTER_VALIDATE_URL))
{
// URL validated by filter_var()
return true;
}
else if(is_array($valid_exts))
{
$allowed_exts_string = implode("|",$valid_exts); // Covert array to string
if(preg_match('!(http://)|(www\.)[a-z0-9\-\.\/]+\.(?:'.$allowed_exts_string.')!Ui', $url))
{
return true;
}
}
return false;
}