<?php 
error_reporting(0);

	
 $con = mysql_connect("localhost","root","");
 if (!$con) {
 die('Could not connect: ' . mysql_error());
 }
 mysql_select_db("2pm", $con);
if(mysql_query('TRUNCATE TABLE stat'))
//echo "success"; else "failed";

?>