<?php	

	//error_reporting(0);

	//global $c=1;

//echo $url,$title,$tit,$dep,$crawl;

echo "<h2 style='font-family: Geneva, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 24px;
	color: #000099;'> All Crawled Urls</h2>";


$con = mysql_connect("localhost","root","");
 if (!$con) {
 die('Could not connect: ' . mysql_error());
 }
 mysql_select_db("2pm", $con);
 $n=1;

 $result = mysql_query("SELECT * FROM crawls");

while($row = mysql_fetch_array($result))
{
			
		
		echo "<span class='hcHead2' style='font-size:1em;font-weight:700;padding-top:10px;padding-bottom:2px;margin-top:5px; text-decoration:none; color:#00ACED'>
 <a href ='".$row['link']."'>".$n, " ",$row['title']."</a> </span>";
		
		
		echo "<div class='link' style='font-size:12px;font-weight:400;padding-top:1px;padding-bottom:1px;margin-top:1px; color:#0b636b'> ".$row['link']."</div>"; 
	
	$n++;	//echo "<div class='text'>", $html."</div>";
}

 
?>
