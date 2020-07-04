

<?php

$positive=0;
$negative=0;
$neutral=0;
$url = $_POST['b'];


$con = mysql_connect("localhost","root","");
 if (!$con) {
 die('Could not connect: ' . mysql_error());
 }
 mysql_select_db("2pm", $con);

$x=count($url);
//print_r($pieces);
for($i=0;$i<$x;$i++)
 {
// echo $pieces[$i];
 $result = mysql_query("SELECT * FROM crawls where link='".$url[$i]."' GROUP BY link");

while($row = mysql_fetch_array($result))
  {
  if($row['senti_type']==="positive") $positive++;
  if($row['senti_type']==="negative") $negative++;
  if($row['senti_type']==="neutral") $neutral++;
  
  }
 
 
 }
 
echo json_encode(array($positive,$negative,$neutral));
?>
