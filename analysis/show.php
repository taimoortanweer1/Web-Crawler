<?php	

	//error_reporting(0);

$con = mysql_connect("localhost","root","");
 if (!$con) {
 die('Could not connect: ' . mysql_error());
 }
 mysql_select_db("2pm", $con);

 ///////getting seeeds
$result=mysql_query('select * from seed GROUP BY link');
while($row = mysql_fetch_array($result))
{
$l=$row['link'];
$type=$row['senti_type'];

echo "<br/><span class='hcHead2' style='font-size:1em;font-weight:700;padding-top:10px;padding-bottom:2px;margin-top:5px; text-decoration:none; color:#00ACED'><input name='url' type='checkbox' class='url' title='url' value='".$l."' id='".$l."' />
 <a href ='".$l."'>", $l."</a> </span>";
		
		
	
		
		if($type=="positive") {
		echo "(<span class='pos' style='color:#0000FF; font-size:16px; font-weight:550'>", $type, "</span>)";}
		
		if($type=="negative") {
		echo "(<span class='neg' style='color:#FF0000; font-size:16px; font-weight:550'>  ", $type,"</span>)";}
		
		if($type=="neutral") {
		echo "(<span style='color:#01DF01; font-size:16px; font-weight:550' class='neu'> ", $type."&nbsp;&nbsp;&nbsp;  </span>)";}

		
}	



?>

