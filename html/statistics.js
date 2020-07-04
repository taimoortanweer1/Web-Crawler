
var _prevIndex = 0;
var _nextIndex = 0;
var _resultsPerPage = 10;
var _pageNumber = 1;
var result_to_display = 0;
var count=0;
 var startIndex = 1;

var fruits = [];

$(function ()
{
	
	
 $('#get_size').show().click(function () { 	
	 $.ajax({
        type:"POST",
        url: "analysis/statistic/analyze.php",
      
		
        success: function(response){

			  //alert(response);
			 var j=JSON.parse(response);
	var l=j.length;
	var x=l/2;
//var l=j.length;
//if(l==3){
		google.load('visualization', '1', {'packages':['corechart']});
 var data = new google.visualization.arrayToDataTable([
 
      ['Url', 'size'],
      [j[0],j[x]],
      [ j[1],j[x]],
      [j[2],j[x]]
    ]);
 
 var chart = new google.visualization.BarChart(document.getElementById('graph'));
     chart.draw(data, { is3D: true, title: 'Crawler Sentiment Analysis', width: 400, height: 240, backgroundColor: "#fffde4", color: ['blue', 'red', 'green']});
	  
			 }
    });
	 
	 
	}); 
	//getting sizes**************************************************************************************************************************		
		  
		  
		  
		  
		  
		  
		  $('#get_size').show().click(function () { 
				//$('#opt').toggle('show');
	var chk = document.getElementsByName('url');
    var len = chk.length;
	var b =[];

var flag=0;
    for(i=0;i<len;i++)
    {
        
      
	   b.push(chk[i].value);
         }
    
	
			
$("#l_l").html('<img src="html/xampp1.gif" align="center" alt="Loading links"/> Getting size');

			 $.ajax({
        type:"POST",
        url: "analysis/statistic/getsize.php",
        data: {b:b},
		
        success: function(response){
$("#l_l").html('');

			 alert (response)
			 
			 
		 
		//do stuff after the AJAX calls successfully completes
    }

    });
			
			
		
 

});
		  
		  //********************
$('#get_size').show().click(function () { 
										    
 $.ajax({
        type:"POST",
        url: "analysis/getsize.php",
        
        success: function(response){
		
		//do stuff after the AJAX calls successfully completes
    }

    });
  });



	 
	 //statistical anlysiss_a
	 $('#s_a').show().click(function () { 
										  
										 
	
     document.getElementById("tweets").style.display = "none";
	 document.getElementById("searchtab").style.display = "none";
	  document.getElementById("st_an").style.display = "block";
	  
	  $("#s_a").css("background","#D6CB89");
 	 $("#s_a").css("color","#324446");
	 
	  $("#S_twitter").css("background","#FFFFFF");
 	 $("#S_twitter").css("color","#D6CB89");
	 $("#S_web").css("background","#FFFFFF");
 	 $("#S_web").css("color","#D6CB89");
	 
	 
	 
});
	
 
 //search button activity**************************************************************************************************************************		

    $('#get_url').show().click(function () { 
										 
										 
										  $.ajax({
        type:"POST",
        url: "analysis/statistic/del.php",
        
        success: function(response){
		
		//do stuff after the AJAX calls successfully completes
    }

    });
										   
$("#l_l").html('<img src="html/xampp1.gif" align="center" alt="Loading links"/> Loading links');


 											
											
										   Search1(0,$("#get_q").val(),$( "#re_no option:selected" ).val());
										   //	getOutput();				
										  		
										   
																			  
																			  });
	
	//********************************************
 
	  
	  	
});


//++++++++++++++++ statistical analysis


function Search1(direction,term,number)
{

   if (direction === -1)
  {
      startIndex = _prevIndex; 
       _pageNumber--;
   }
    if (direction === 1)
   {
      startIndex = _nextIndex; 
       _pageNumber++;
    }
   if (direction === 0)
 {
   startIndex = 1; 
 _pageNumber = 1;
   }
   

    var url = "https://www.googleapis.com/customsearch/v1?key="
    + mGoogleApiKey + "&num="+number+"&cx=" + mGoogleCustomSearchKey + "&start=" + startIndex + "&q=" + escape(term) + "&callback=?";

 //   url = "http://hahndorf/ws/dummy.aspx?q=" + escape(term) + "&start=" + startIndex + "&callback=?";

   
  $.getJSON(url, '', SearchCompleted1);
	


}




function SearchCompleted1(response)
{
	
    $("#resp_res").html("");
	 
    if (response.items == null)
    {
        $("#resp_res").html("No matching pages found");
		$("#l_l").html('');
		
        return;
    }

    if (response.items.length === 0)
    {
        $("#resp_res").html("No matching pages found");
		$("#l_l").html('');
		
        return;
    }

    $("#resp_res").html("Total "+response.queries.request[0].totalResults + " pages found");
	
	
   
	//---------------

    for (var i = 0; i < response.items.length; i++)
    {$("#urls").html('');
        var item = response.items[i];
        var title = item.htmlTitle;
		var l=item.link;
		var s=item.htmlSnippet;
		fruits.push(l)

        
		//html += "<div class='text'>" +s + "</div></div>";
		 $.ajax({
        type:"POST",
        url: "analysis/statistic/stat.php",
        data: "s="+l+ "&t="+title+"&sea="+$("#get_q").val()+"&crawl="+$( "#re_no option:selected" ).val(),
		
        success: function(response){
			 $("#l_l").html('');	
		   
$("#urls").append(response);
		

			 

		//do stuff after the AJAX calls successfully completes
    }

    });

			
			  	
		   
	

  
		
    }	//	html +="<div class='links'>"+fruits+" </div>";

    //$("#output").html(html);
	//$("#output1").html(fruits);
	

}