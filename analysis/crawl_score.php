<?php
$positive=0;
$negative=0;
$neutral=0;
require_once 'alchemyapi.php';
	$alchemyapi = new AlchemyAPI();


 $con = mysql_connect("localhost","root","");
 if (!$con) {
 die('Could not connect: ' . mysql_error());
 }
 mysql_select_db("2pm", $con);


 $result = mysql_query("SELECT * FROM crawls");

while($row = mysql_fetch_array($result))
  {
  $response = $alchemyapi->sentiment_targeted('url',$row['url'],$row['search_key'], null);

	if ($response['status'] == 'OK') {
			
	
		
		$type=$response['docSentiment']['type'];
		
		if($type==="positive") $positive++;
  if($type==="negative") $negative++;
  if($type==="neutral") $neutral++;
  
		//echo $row['url'].$type."<br/>";

		//echo "<div class='text'>", $html."</div>";
			if($type==="neutral") $score=0; else $score=$response['docSentiment']['score'];	
mysql_query("UPDATE crawls SET type ='". $type."' ,score ='". $score."' WHERE  url = '".$row['url']."'");
		
		
	} else {
		//echo 'Error in the sentiment analysis call: ', $response['statusInfo'];
		//echo "failed";
	}
  
  }

echo json_encode(array($positive,$negative,$neutral));




?>

