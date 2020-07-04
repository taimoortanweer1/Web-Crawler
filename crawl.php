<?php

error_reporting(0);
require_once 'analysis/alchemyapi.php';
	$alchemyapi = new AlchemyAPI();
	
	
 $con = mysql_connect("localhost","root","");
 if (!$con) {
 die('Could not connect: ' . mysql_error());
 }
 mysql_select_db("2pm", $con);
mysql_query('TRUNCATE TABLE crawls');


    /*** a link to search ***/
    $link = "http://www.wikihow.com/Make-Marshmallows";
    /*** get the links ***/
    $urls = getLinks($link);
    /*** check for results ***/
    if(sizeof($urls) > 0)
    {
        foreach($urls as $key=>$value)
        {
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
			
			 if($key[0] == "#"){ echo "";}
			
			 if(substr($key, 0, 4) != 'http') {echo "";}
			  $rest3 = substr($key, -4); // returns "de"
		if($rest3=='.jpg' || $rest3=='.gif'  ) {echo "";}

			else 
			{
	echo "<a href='".$key . "'>".$key."</a>". $value . '<br >';
		
			
		$response = $alchemyapi->sentiment('url',$key, null);

	if ($response['status'] == 'OK') {
	
	
	$type=$response['docSentiment']['type'];
		if($type==="neutral") $score=0; else $score=$response['docSentiment']['score'];
		//echo $type.$score."</br>";
		echo $type,$score."</br>";
		
		 

		}
		else echo "failed";


 
		
	
}
      		

	  
	    }//for braces
 }//if braces
    else
    {
        echo "No links found at $link";
    }
?>

<?php
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