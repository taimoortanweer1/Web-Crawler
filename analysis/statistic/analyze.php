

<?php
include('Chart.php');
$positive=0;
$negative=0;
$neutral=0;
$positive1=0;
$negative1=0;
$neutral1=0;
$tab = $_POST['v'];
$numb = $_POST['n'];
//$tab='seed';
$con = mysql_connect("localhost","root","");
 if (!$con) {
 die('Could not connect: ' . mysql_error());
 }
 mysql_select_db("2pm", $con);
 

if($tab=="all")
{
 $result = mysql_query("SELECT * FROM info GROUP BY link");

while($row = mysql_fetch_array($result))
  {
  if($row['senti_type']==="positive") $positive++;
  if($row['senti_type']==="negative") $negative++;
  if($row['senti_type']==="neutral") $neutral++;
  

  }
  $result = mysql_query("SELECT * FROM crawls GROUP BY link");

while($row = mysql_fetch_array($result))
  {
  if($row['senti_type']==="positive") $positive++;
  if($row['senti_type']==="negative") $negative++;
  if($row['senti_type']==="neutral") $neutral++;
  

  }
  echo json_encode(array($positive,$negative,$neutral));


}//if

if($tab=="seed"||$tab=="info"){

// demonstration of a line chart and formatted array
 $result = mysql_query("SELECT * FROM $tab GROUP BY link");

while($row = mysql_fetch_array($result))
  {
  if($row['senti_type']==="positive") $positive++;
  if($row['senti_type']==="negative") $negative++;
  if($row['senti_type']==="neutral") $neutral++;
  

  }
  echo json_encode(array($positive,$negative,$neutral));

  }
 
if($tab=='crawls'){

// demonstration of a line chart and formatted array
 $result = mysql_query("SELECT * FROM $tab GROUP BY link");

while($row = mysql_fetch_array($result))
  {
  if($row['senti_type']==="positive") $positive++;
  if($row['senti_type']==="negative") $negative++;
  if($row['senti_type']==="neutral") $neutral++;
  

  }
  echo json_encode(array($positive,$negative,$neutral));

  }
 
 
 if($tab=='selected'){
$tab = $_POST['b'];
//echo $tab;
// demonstration of a line chart and formatted array



$pieces = explode(",", $tab);
$x=count($pieces);
//print_r($pieces);
for($i=0;$i<$x;$i++)
 {
// echo $pieces[$i];
 $result = mysql_query("SELECT * FROM info where link='".$pieces[$i]."'");

while($row = mysql_fetch_array($result))
  {
  if($row['senti_type']==="positive") $positive++;
  if($row['senti_type']==="negative") $negative++;
  if($row['senti_type']==="neutral") $neutral++;
  

  }
 
 
 }
 
   echo json_encode(array($positive,$negative,$neutral));

  }

  




?>
