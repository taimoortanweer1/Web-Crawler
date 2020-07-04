

<?php
include('Chart.php');
$positive=0;
$negative=0;
$neutral=0;

$url = $_POST['b'];
$con = mysql_connect("localhost","root","");
 if (!$con) {
 die('Could not connect: ' . mysql_error());
 }
 mysql_select_db("2pm", $con);
//echo $url[1];

for($i=0;$i<count($url);$i++)
{

 $result = mysql_query("SELECT  senti_type FROM  info WHERE  link =  '$url[$i]'");
if($result){
$row = mysql_fetch_array($result);
if($row['senti_type']==="positive") $positive++;
  if($row['senti_type']==="negative") $negative++;
  if($row['senti_type']==="neutral") $neutral++;
  }
}
echo json_encode(array($positive,$negative,$neutral));

?>
