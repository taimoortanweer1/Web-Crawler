<?php
$positive=0;
$negative=0;
$neutral=0;

require_once '../analysis/alchemyapi.php';

require_once 'lib/twitteroauth.php';
$qu= $_POST['variable1'];
$type= $_POST['variable2'];
$numb= $_POST['variable3'];

define('CONSUMER_KEY', 'jAGcYP5DniirJFZja8w');
define('CONSUMER_SECRET', 'B6lwUbgIF5oX2kDYVpPmYsFyHqUKbA5M0meIz4KI');
define('ACCESS_TOKEN', '85088720-BgCa2bMQiVDT3HlS5KbuwLSdrtLwRL6pc5rUKOrlj');
define('ACCESS_TOKEN_SECRET', 'WADzbTyeFqtzc3fLM9PJN8IcWR3rsPSNypyZ0MSUCNGOv');
 

function search(array $query)
{
  $toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
  return $toa->get('search/tweets', $query);
   
}
 
 
$query = array(
  "q" => $qu,
  "count" => $numb,
  "result_type" => $type,
  "lang" => "en",
);



$results = search($query);


foreach ($results->statuses as $result) 

{

$txt=$result->text;
$user=$result->user->screen_name;
$alchemyapi = new AlchemyAPI();
//$key=str_replace("'", "", $txt);
$key=addslashes($txt);

$response = $alchemyapi->sentiment_targeted('text',$key, $qu, null);

	if ($response['status'] == 'OK')
 {
	
  $res= $response['docSentiment']['type'];
  if($res==="positive"){
   $positive++;
    echo "<span style='color:#0099FF; font-size:16px; font-weight:500'>[".$user . "]</span> " . $txt ."<span class='pos' style='color:#0000FF; font-size:16px; font-weight:550'>[" .$res. "]</span><br>\n";
}
  if($res==="negative") {
  $negative++;
   echo "<span style='color:#0099FF; font-size:16px; font-weight:500'>[".$user . "]</span> " . $txt ."<span class='neg' style='color:#FF0000; font-size:16px; font-weight:550'>[" .$res. "]</span><br>\n";
   }
  if($res==="neutral"){
   $neutral++;
   echo "<span style='color:#0099FF; font-size:16px; font-weight:500'>[".$user . "]</span> " . $txt ."<span style='color:#006600; font-size:16px; font-weight:550' class='neu'>[" .$res. "]</span><br>\n";
   }
 

		
}

 //echo "<span style='color:#0099FF; font-size:16px; font-weight:500'>[".$user . "]</span> " . $txt ." ".$res. "<br>\n";
  


 //Pull data from home.php front-end page
 
 
//Insert Data into mysql



//else{ echo "An error occurred!".mysql_error()."<br>"; }
}

 // echo "<div id='pos'>",$positive,"</div>";
 // echo "<div id='neg'>",$negative,"</div>";
 // echo "<div id='nei'>",$neutral,"</div>";




?>
