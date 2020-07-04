<?php 
//error_reporting(0);

	require_once 'alchemyapi.php';
	$alchemyapi = new AlchemyAPI();
 $con = mysql_connect("localhost","root","");
 if (!$con) {
 die('Could not connect: ' . mysql_error());
 }
 mysql_select_db("2pm", $con);
$result=mysql_query("select distinct link,search_key from crawls where senti_type='0'");
//echo "success"; else "failed";


while($row = mysql_fetch_array($result))
  {
  
  //echo $row['link'].$row['title']."</br>";


$url=$row['link'];
$title=$row['search_key'];

  $response = $alchemyapi->sentiment('url',$url, null);

	if ($response['status'] == 'OK') {
	
	
	$type=$response['docSentiment']['type'];
		if($type==="neutral") $score=0; else $score=$response['docSentiment']['score'];
		//echo $type.$score."</br>";
		//echo $type,$score."</br>";
		mysql_query("UPDATE crawls SET senti_type ='". $type."' ,score ='". $score."' WHERE  link = '".$url."'");
		 

		}
		//else echo "failed";


  }
  


?>