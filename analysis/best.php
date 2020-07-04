<?php	

	//error_reporting(0);

	//global $c=1;

//echo $url,$title,$tit,$dep,$crawl;
$numb=$_GET['n'];
$w=$_GET['v'];

echo "<h2 style='font-family: Geneva, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 24px;
	color: #000099;'> $w $numb Urls</h2>";


$con = mysql_connect("localhost","root","");
 if (!$con) {
 die('Could not connect: ' . mysql_error());
 }
 mysql_select_db("2pm", $con);
 $n=1;
$q="DELETE FROM  `alls`";
 mysql_query($q) or trigger_error(mysql_error()." in ".$q);


//create a combind table
$q1="INSERT INTO alls(  `item` ,  `title` ,  `link` ,  `snippet` ,  `senti_score` ,  `senti_type` ) 
SELECT  `item` ,  `title` ,  `link` ,  `snippet` ,  `senti_score` ,  `senti_type` 
FROM info";
 mysql_query($q1) or trigger_error(mysql_error()." in ".$q1);

$q2="INSERT INTO alls( `title` ,  `link` ,  `senti_score` ,  `senti_type` ) 
SELECT  `title` ,  `link` , `score` ,  `senti_type` 
FROM crawls";
 mysql_query($q2) or trigger_error(mysql_error()." in ".$q2);


//get worst by ASC
//get best desc



if($w=="Best"){
$n=1;
 $result = mysql_query("select distinct link,senti_score,senti_type,title from alls
order by senti_score DESC limit 0, $numb");

while($row = mysql_fetch_array($result))
{
$type=$row['senti_type'];
		
		
		if($type=="positive") {
		echo "<span class='hcHead2' style='font-size:1em;font-weight:700;padding-top:10px;padding-bottom:2px;margin-top:5px; text-decoration:none; color:#00ACED'>
 <a href ='".$row['link']."'>".$n, " ",$row['title']."</a> </span>";
		
		
		echo "(<span class='pos' style='color:#0000FF; font-size:16px; font-weight:550'>", $type, $row['senti_score'] ,"</span>)";
			echo "<div class='link' style='font-size:12px;font-weight:400;padding-top:1px;padding-bottom:1px;margin-top:1px; color:#0b636b'> ".$row['link']."</div>"; 
		$n++;}//if
		}//while
	$nn=$n-1;
	
	if($nn<$numb) {
	echo "<div style='font-size:14px;font-weight:600;padding-top:1px;padding-bottom:1px;margin-top:1px; color:#0b636b'> <br/>Only $nn best urls were in database</div>";}
	

}//if

////////////////////
if($w=="Worst"){
$n=1;
 $result = mysql_query("select distinct link,senti_score,senti_type,title from alls
order by senti_score ASC limit 0, $numb");

while($row = mysql_fetch_array($result))
{
$type=$row['senti_type'];
		
		
		if($type=="negative") {
		echo "<span class='hcHead2' style='font-size:1em;font-weight:700;padding-top:10px;padding-bottom:2px;margin-top:5px; text-decoration:none; color:#00ACED'>
 <a href ='".$row['link']."'>".$n, " ",$row['title']."</a> </span>";
		
		
		echo "(<span class='neg' style='color:#FF0000; font-size:16px; font-weight:550''>", $type, $row['senti_score'] ,"</span>)";
			echo "<div class='link' style='font-size:12px;font-weight:400;padding-top:1px;padding-bottom:1px;margin-top:1px; color:#0b636b'> ".$row['link']."</div>"; 
		$n++;}//if
		}//while
	$nn=$n-1;
	
	if($nn<$numb) {
	echo "<div style='font-size:14px;font-weight:600;padding-top:1px;padding-bottom:1px;margin-top:1px; color:#0b636b'> <br/>Only $nn worst urls were in database</div>";}
	

}//if









 
?>
