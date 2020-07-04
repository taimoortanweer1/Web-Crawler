<?php	
require_once 'alchemyapi.php';
	$alchemyapi = new AlchemyAPI();

	//error_reporting(0);

	//global $c=1;
$url = $_POST['b'];

$output1 = array_slice($url, 1);      // returns "c", "d", and "e"
$output = array_slice($url, 0, 1);

$x= count($output1);


 $con = mysql_connect("localhost","root","");
 if (!$con) {
 die('Could not connect: ' . mysql_error());
 }
 mysql_select_db("2pm", $con);
 
$q1="DELETE FROM seed WHERE s_key!='".$output[0]."'";
 
 mysql_query($q1) or trigger_error(mysql_error()." in ".$q1);

 
 for($i=0;$i<$x;$i++)
 {
 $response = $alchemyapi->sentiment_targeted('url',$output1[$i],$output[0], null);

	if ($response['status'] == 'OK') {
	$type=$response['docSentiment']['type'];
	
	}

$q = "INSERT INTO seed(link,s_key,senti_type) VALUES('$output1[$i]','$output[0]','$type')";

mysql_query($q) or trigger_error(mysql_error()." in ".$q);
}
echo $x." URL/URLs are successfully added to the seed queue for ".$output[0];
?>
