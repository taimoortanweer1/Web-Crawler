



<?php	

	//error_reporting(0);

	//global $c=1;

//echo $url,$title,$tit,$dep,$crawl;




$con = mysql_connect("localhost","root","");
 if (!$con) {
 die('Could not connect: ' . mysql_error());
 }
 mysql_select_db("2pm", $con);
 

 $result = mysql_query("SELECT distinct link,senti_type,title,score FROM crawls GROUP BY link");

while($row = mysql_fetch_array($result))
{
	if($row['senti_type']!='0')
	{			
		
		echo "<span class='hcHead2' style='font-size:1em;font-weight:700;padding-top:10px;padding-bottom:2px;margin-top:5px; text-decoration:none; color:#00ACED'>
 <input name='url' type='checkbox' class='url' title='url' value='".$row['link']."' id='".$row['link']."' /><a href ='".$row['link']."'>".$row['title']."</a> </span>";
		
		$type=$row['senti_type'];
		if($type==="neutral") $score=0; else $score=$row['score'];
		
		if($type==="positive") {
		echo "(<span class='pos' style='color:#0000FF; font-size:16px; font-weight:550'>", $type.'&nbsp;&nbsp;&nbsp; score: ', $score."</span>)";}
		
		if($type==="negative") {
		echo "(<span class='neg' style='color:#FF0000; font-size:16px; font-weight:550'> ", $type.'&nbsp;&nbsp;&nbsp; score: ', $score."</span>)";}
		
		if($type==="neutral") {
		echo "(<span style='color:#006600; font-size:16px; font-weight:550' class='neu'> ", $type."&nbsp;&nbsp;&nbsp;  score: 0</span>)";}

		echo "<div class='link' style='font-size:12px;font-weight:400;padding-top:1px;padding-bottom:1px;margin-top:1px; color:#0b636b'> ".$row['link']."</div>"; }
		//echo "<div class='text'>", $html."</div>";

else {}
}


 
?>


