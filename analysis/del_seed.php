<?php 
//error_reporting(0);

	
 $con = mysql_connect("localhost","root","");
 if (!$con) {
 die('Could not connect: ' . mysql_error());
 }
 mysql_select_db("2pm", $con);
$url = $_POST['b'];
$x= count($url);

 for($i=0;$i<$x;$i++)
 {
 $q1="DELETE FROM seed WHERE link='".$url[$i]."'";
  mysql_query($q1) or trigger_error(mysql_error()." in ".$q1);
}
echo "Seed urls are removed";
//echo "success"; else "failed";

?>