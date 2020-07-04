<?php
//$dep = 3;
//$total_page = 10;

$dep = $_GET['dep'];

$time = $_GET['time'];

$total_page = $_GET['numb'];


echo "<h2 style='font-family: Geneva, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 24px;
	color: #000099;'> Crawling options Information</h2>";


echo "<p style='font-family: Geneva, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 14px;
	color: #000099;'>Depth set for crawler to crawl : ",$dep,"</p><p style='font-family: Geneva, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 14px;
	color: #000099;'> Total pages to crawl per Url : ",$total_page,"</p><p style='font-family: Geneva, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 14px;
	color: #000099;'> Time for crawler to crawl: ",$time,"</p>";
error_reporting(0);

set_time_limit($time);

$end = time()+$time;
$now=time();

echo "<h3 style='font-family: Geneva, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 14px;
	color: #CC0000;'> Crawling for time : ",$time," seconds</h3>";
require_once 'alchemyapi.php';
	$alchemyapi = new AlchemyAPI();	
$con = mysql_connect("localhost","root","");
 if (!$con) {
 die('Could not connect: ' . mysql_error());
 }
 mysql_select_db("2pm", $con);

 ///////getting seeeds
$result=mysql_query('select * from seed GROUP BY link');
while($row = mysql_fetch_array($result))
{
$d=1;

    /*** a link to search ***/
    $link = $row['link'];
	$k=$row['s_key'];
	echo "<br /> Crawling url: ".$link." for depth 1";
    /*** get the links ***/ 
    $urls = getLinks($link);
	
	saveLinks($urls,$link,$total_page,$k,$d);
	}
	//////////working on crawls with depth
   $d=1; /*** check for results ***/
   	while($d<$dep)
	{
		
	
			$result=mysql_query("select * from crawls WHERE depth= '$d'");
			echo "<h2>".($d+1)."</h2></br>";
			while($row = mysql_fetch_array($result))
			{
			$link = $row['link'];
			$k=$row['search_key'];
			echo "<br /> Crawling url: ".$link." for ".$k." depth: ",($d+1);
			$urls = getLinks($link);
	
			saveLinks($urls,$link,$total_page,$k,($d+1));
			 
			}
	$d++;
	}//nested if 
	
	
	//}
	//}//the query braces
	
	echo "<h2  style='font-family: Geneva, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 16px;
	color: #000099;'> Done crawling</h2>"; 
	
	echo "<form method='post'>
<input type='button' value='Close Window' id='ab' 
onclick='window.close()'></form>";
	
	
	

?>


<?php
 function saveLinks($urls,$link,$total_page,$k,$d)
    {
	$c=0;
	 if(sizeof($urls) > 0)
    {
        foreach($urls as $key=>$value)
        {
		
	if($c<$total_page){
		if (strpos($link, 'org') !== false)
  			 {
	$keywords = explode("org", $link);
	$keywords[0]=$keywords[0]."org";
			 }
	
	    else if (strpos($link, 'com') !== false)
   			{
   
	$keywords = explode("com", $link);
	$keywords[0]=$keywords[0]."com";
			}
		else if (strpos($link, 'net') !== false)
   			{
	$keywords = explode("net", $link);
	$keywords[0]=$keywords[0]."net";
			}
		
		 if($key[0] == "/"){
		
			 $key = $keywords[0].$key;


           // echo "<a href='".$key . "'>".$key."</a>". $value . '<br >';
							}
			
			 if($key[0] == "#"){}
			
			 if(substr($key, 0, 4) != 'http') {echo "";}
			 
			 
			 $rest3 = substr($key, -4); // returns "de"
		if($rest3=='.jpg' || $rest3=='.gif'  ) {echo "";}



			  if(substr($key, 0, 4) != 'http') {echo "";}

			else 

			//echo "<a href='".$key . "'>".$key."</a> ". $value . '<br >';
		
		mysql_query("INSERT INTO crawls(search_key,p_url_1,depth,title,link,score,senti_type) VALUES('$k','$link','$d','$value','$key','0','0')");
	
$c++;
}//total page
		
		
		
		
		
		
	


	  
	    }//for braces
		
		echo "<br/> done Crawling at url: ".$link."<br/><br/>";
 }//if braces
    else
    {
        echo "<br/>No links found at $link";
    }
	
	}

    function getLinks($link)
    {
        /*** return array ***/
        $ret = array();

        /*** a new dom object ***/
        $dom = new domDocument;

        /*** get the HTML (suppress errors) ***/
        @$dom->loadHTML(file_get_contents($link));

        /*** remove silly white space ***/
        $dom->preserveWhiteSpace = false;

        /*** get the links from the HTML ***/
        $links = $dom->getElementsByTagName('a');
    
        /*** loop over the links ***/
        foreach ($links as $tag)
        {
            $ret[$tag->getAttribute('href')] = $tag->childNodes->item(0)->nodeValue;
        }

        return $ret;
    }
?>