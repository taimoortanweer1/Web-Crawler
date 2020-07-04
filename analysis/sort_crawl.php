<?php	
require_once 'alchemyapi.php';
	$alchemyapi = new AlchemyAPI();

	//error_reporting(0);
//$urls=array('https://twitter.com/pmln_org','http://timesofindia.indiatimes.com/topic/PML-N');

	//global $c=1;
$value =$_POST['b'];
//$value = $_GET['value'];
//print_r($url);

//echo " <br/>",count($url);
//$arr=array();
 //$urls = array_slice($url, 1);      // returns "c", "d", and "e"
//$value = array_slice($url, 0, 1);
//$value=1;
//print_r($value);

 $con = mysql_connect("localhost","root","");
 if (!$con) {
 die('Could not connect: ' . mysql_error());
 }
 mysql_select_db("2pm", $con);
 
 
  if($value==2)
 {
 
 $result=mysql_query('SELECT distinct score,link,senti_type,title  
FROM  `crawls` 
ORDER BY  `score` ASC ');
while($row = mysql_fetch_array($result))
{ 
$url1=$row['link'];
//echo $url1;
//if (in_array($url1, $urls))
if($row['senti_type']!='0')
 {
 
 $score=$row['score'];
 $type=$row['senti_type'];
 $title=$row['title'];
 
echo "<span class='hcHead2' style='font-size:1em;font-weight:700;padding-top:10px;padding-bottom:2px;margin-top:5px; text-decoration:none; color:#00ACED'>
<input name='url' type='checkbox' class='url' title='url' value='".$url1."' id='".$url1."' /> <a href ='".$url1."'>", $title."</a> </span>";
		
		
		if($type==="positive") {
		echo "(<span class='pos' style='color:#0000FF; font-size:16px; font-weight:550'>", $type.'&nbsp;&nbsp;&nbsp; score: ', $score."</span>)";}
		
		if($type==="negative") {
		echo "(<span class='neg' style='color:#FF0000; font-size:16px; font-weight:550''> ", $type.'&nbsp;&nbsp;&nbsp; score: ', $score."</span>)";}
		
		if($type==="neutral") {
		echo "(<span style='color:#01DF01; font-size:16px; font-weight:550' class='neu'>  ", $type."&nbsp;&nbsp;&nbsp;  score: 0</span>)";}

		echo "<div class='link' style='font-size:12px;font-weight:400;padding-top:1px;padding-bottom:1px;margin-top:1px; color:#0b636b'>  ",$url1,"</div>"; 

  
}
}


  }


 if($value==1)
 {
 
 $result=mysql_query('SELECT distinct score,link,senti_type,title 
FROM  `crawls` 
ORDER BY  `score` desc ');
while($row = mysql_fetch_array($result))
{
//if (in_array($row['link'], $url))
if($row['senti_type']!='0')
 {
 
 $url=$row['link'];
 $score=$row['score'];
 $type=$row['senti_type'];
 $title=$row['title'];
 
echo "<span class='hcHead2' style='font-size:1em;font-weight:700;padding-top:10px;padding-bottom:2px;margin-top:5px; text-decoration:none; color:#00ACED'>
 <input name='url' type='checkbox' class='url' title='url' value='".$url."' id='".$url."' /><a href ='".$url."'>", $title."</a> </span>";
		
		
		if($type==="positive") {
		echo "(<span class='pos' style='color:#0000FF; font-size:16px; font-weight:550'>", $type.'&nbsp;&nbsp;&nbsp; score: ', $score."</span>)";}
		
		if($type==="negative") {
		echo "(<span class='neg' style='color:#FF0000; font-size:16px; font-weight:550''> ", $type.'&nbsp;&nbsp;&nbsp; score: ', $score."</span>)";}
		
		if($type==="neutral") {
		echo "(<span style='color:#01DF01; font-size:16px; font-weight:550' class='neu'>  ", $type."&nbsp;&nbsp;&nbsp;  score: 0</span>)";}

		echo "<div class='link' style='font-size:12px;font-weight:400;padding-top:1px;padding-bottom:1px;margin-top:1px; color:#0b636b'>  ",$url,"</div>"; 

  
}
}


  }


?>