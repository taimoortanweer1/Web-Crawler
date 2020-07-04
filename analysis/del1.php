<?php 
error_reporting(0);

	
 $con = mysql_connect("localhost","root","");
 if (!$con) {
 die('Could not connect: ' . mysql_error());
 }
 mysql_select_db("2pm", $con);
if(mysql_query('TRUNCATE TABLE crawls'))
mysql_query('TRUNCATE TABLE info')
//echo "success"; else "failed";

?>