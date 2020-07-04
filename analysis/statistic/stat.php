<?php	
	//error_reporting(0);
require_once '../alchemyapi.php';
	$alchemyapi = new AlchemyAPI();
	//global $c=1;
$url = $_POST['s'];
$title = $_POST['t'];
$tit = $_POST['sea'];	

$crawl=	$_POST['crawl'];


$call=1;
	
//echo $url,$title,$tit,$dep,$crawl;




$response = $alchemyapi->sentiment_targeted('url',$url,$tit, null);

	if ($response['status'] == 'OK') {
			
			
				
		echo "<span class='hcHead2'><input name='url' type='checkbox' class='url' title='url' value='".$url."' id='".$url."' />
 <a href ='".$url."'>", $title."</a> </span>";
		
		$type=$response['docSentiment']['type'];
		if($type==="neutral") $score=0; else $score=$response['docSentiment']['score'];
		
		if($type==="positive") {
		echo "(<span class='pos'>", $type.'&nbsp;&nbsp;&nbsp; score: ', $score."</span>)";}
		
		if($type==="negative") {
		echo "(<span class='neg'> ", $type.'&nbsp;&nbsp;&nbsp; score: ', $score."</span>)";}
		
		if($type==="neutral") {
		echo "(<span class='neu'> ", $type."&nbsp;&nbsp;&nbsp;  score: 0</span>)";}

		echo "<div class='link'> ",$url,"</div>"; 

		//echo "<div class='text'>", $html."</div>";
				

		
		
	} else {
		//echo 'Error in the sentiment analysis call: ', $response['statusInfo'];
		echo "";
	}


$con = mysql_connect("localhost","root","");
 if (!$con) {
 die('Could not connect: ' . mysql_error());
 }
 mysql_select_db("2pm", $con);
 //Pull data from home.php front-end page
 
if (isset($type,$score)) {
 //Insert Data into mysql
$query=mysql_query("INSERT INTO stat(link,senti_score,title,senti_type) VALUES('$url','$score','$title','$type')");
if($query){
//echo "Data inserted successfully!";
}
else{ echo "An error occurred!"; }}
else {
 //Insert Data into mysql
$query=mysql_query("INSERT INTO stat(link,senti_score,title,senti_type) VALUES('$url','0','$title','positive')");
if($query){
//echo "Data inserted successfully!";
}
else{ echo "An error occurred!"; }}


?>
