<?php	
require_once 'alchemyapi.php';
	$alchemyapi = new AlchemyAPI();

	//error_reporting(0);
//$urls=array('https://twitter.com/pmln_org','http://timesofindia.indiatimes.com/topic/PML-N');

	//global $c=1;
$url =$_POST['b'];
//$value = $_GET['value'];
//print_r($url);

//echo " <br/>",count($url);
$arr=array();
 $urls = array_slice($url, 1);      // returns "c", "d", and "e"
$value = array_slice($url, 0, 1);

//print_r($value);

 $con = mysql_connect("localhost","root","");
 if (!$con) {
 die('Could not connect: ' . mysql_error());
 }
 mysql_select_db("2pm", $con);
 
 
  if($value[0]==1)
 {
 
 $result=mysql_query('SELECT * 
FROM  `info` 
ORDER BY  `senti_score` ASC ');
while($row = mysql_fetch_array($result))
{ 
$url1=$row['link'];
//echo $url1;
//if (in_array($url1, $urls))
 {
 
 $score=$row['senti_score'];
 $type=$row['senti_type'];
 $title=$row['title'];
 
echo "<span class='hcHead2'><input name='url' type='checkbox' class='url' title='url' value='".$url1."' id='".$url1."' />
 <a href ='".$url1."'>", $title."</a> </span>";
		
		
		if($type==="positive") {
		echo "(<span class='pos'>", $type.'&nbsp;&nbsp;&nbsp; score: ', $score."</span>)";}
		
		if($type==="negative") {
		echo "(<span class='neg'> ", $type.'&nbsp;&nbsp;&nbsp; score: ', $score."</span>)";}
		
		if($type==="neutral") {
		echo "(<span class='neu'> ", $type."&nbsp;&nbsp;&nbsp;  score: 0</span>)";}

		echo "<div class='link'> ",$url1,"</div>"; 

  
}
}


  }


 if($value[0]==2)
 {
 
 $result=mysql_query('SELECT * 
FROM  `info` 
ORDER BY  `senti_score` desc ');
while($row = mysql_fetch_array($result))
{
//if (in_array($row['link'], $url))
 {
 
 $url=$row['link'];
 $score=$row['senti_score'];
 $type=$row['senti_type'];
 $title=$row['title'];
 
echo "<span class='hcHead2'><input name='url' type='checkbox' class='url' title='url' value='".$url."' id='".$url."' />
 <a href ='".$url."'>", $title."</a> </span>";
		
		
		if($type==="positive") {
		echo "(<span class='pos'>", $type.'&nbsp;&nbsp;&nbsp; score: ', $score."</span>)";}
		
		if($type==="negative") {
		echo "(<span class='neg'> ", $type.'&nbsp;&nbsp;&nbsp; score: ', $score."</span>)";}
		
		if($type==="neutral") {
		echo "(<span class='neu'> ", $type."&nbsp;&nbsp;&nbsp;  score: 0</span>)";}

		echo "<div class='link'> ",$url,"</div>"; 

  
}
}


  }


?>