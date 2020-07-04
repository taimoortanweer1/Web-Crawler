
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
	
	
	$('.url').change(function () {
    alert('changed');
 })
//show seed button working**************************************************************************************************************************	
	$('#s_s').show().click(function () { 
	
 var width  = 600;
 var height = 600;
 var left   = (screen.width  - width)/2;
 var top    = (screen.height - height)/2;
 var params = 'width='+width+', height='+height;
 params += ', top='+top+', left='+left;
 params += ', directories=no';
 params += ', location=no';
 params += ', menubar=no';
 params += ', resizable=no';
 params += ', scrollbars=no';
 params += ', status=no';
 params += ', toolbar=no';
 newwin=window.open('analysis/showseed.html','bill', params);
 
 
 if (window.focus) {newwin.focus()}
 


								  });
	
//crawl button working**************************************************************************************************************************

	 $('#crawl').show().click(function () { 
	 $("#s1").css("display", "block");
	 $("#s2").css("display", "block");$("#s3").css("display", "block");$("#s4").css("display", "block");$("#s5").css("display", "block");$("#s6").css("display", "block");
 var width  = 600;
 var height = 600;
 var left   = (screen.width  - width)/2;
 var top    = (screen.height - height)/2;
 var params = 'width='+width+', height='+height;
 params += ', top='+top+', left='+left;
 params += ', directories=no';
 params += ', location=no';
 params += ', menubar=no';
 params += ', resizable=no';
 params += ', scrollbars=no';
 params += ', status=no';
 params += ', toolbar=no';
 if($( "#time option:selected" ).val()=="self") { 
 		//if($("#time1").val()=="seconds") alert("Please Specify the time")
 		//else
		var time=$("#time1").val();		}
		
 else  
 
	 var time=$( "#time option:selected" ).val();
 
 // alert (time)

 newwin=window.open('analysis/crawll.php?time='+time+'&dep='+$( "#dep option:selected" ).val()+'&numb='+$( "#numb option:selected" ).val(),'windowname5', params);

 
 
// if (window.focus) {newwin.focus()}
 
 

			
								  });
	
//enabling disabling seconds text field**************************************************************************************************************************		
	$('#time').change(function(){ 
								 var value = $(this).val();
								 if(value=='self')  $('#time1').attr("disabled", false);
								 else $('#time1').attr("disabled", true);
									 

								
							  });
	
	
//resetting analyze options if page numbers changed***************************************************************************************************************		
	$('#numb1').change(function(){ 
								
								$("#analyze")[0].selectedIndex = 0; 
								$("#rightPanel").html("");	
							  });
	
//sorting options**************************************************************************************************************************		
	$('#sort').change(function(){ 
							   $("#rightPanel").html("");	
    var value = $(this).val();
	if(value==0){}
	else{
		$("#output").html("");
			var chk = document.getElementsByName('url');
    var len = chk.length;
	var b =[value];
	
    for(i=0;i<len;i++)
    {
		b.push(chk[i].value);}
	 $.ajax({
        type:"POST",
        url: "analysis/c_sort.php",
        data: {b:b},
		
        success: function(response){

 $("#output").append(response)
	//alert(response)
		}
		
							   
	});
	 
	}
							   
	});
	
//analyze select options**************************************************************************************************************************		
	$('#analyze').change(function(){ 
							   $("#rightPanel").html("");	
    var value = $(this).val();
			//&&&&&&&&&&&&&&&&&&&&&&&&&&analyze all &&&&&&&&&&&&&&&&&&&&&&&&&		
if (value==1){
			 $.ajax({
        type:"POST",
        url: "analysis/analyze.php",
       data: "v=info"+ "&n="+$( "#numb1 option:selected" ).val(),
		
        success: function(response){

			  //alert(response);
			 var j=JSON.parse(response);
	$("#analyze")[0].selectedIndex = 0; 
//var l=j.length;
//if(l==3){
		google.load('visualization', '1', {'packages':['corechart']});
 var data = new google.visualization.arrayToDataTable([
 
      ['type', 'total'],
      ['Positive',j[0]],
      ['Negative', j[1]],
      ['Neutral', j[2]]
    ]);
 
 var chart = new google.visualization.PieChart(document.getElementById('rightPanel'));
     chart.draw(data, { is3D: true, title: 'Sentiment Analysis of All searched urls', width: 400, height: 240, backgroundColor: "#fffde4", color: ['blue', 'red', 'green']});
	   
		  
			//alert('bravo')  
			
		//do stuff after the AJAX calls successfully completes
 //  }
 
			// else alert(j)
			 
			 }
    });
}//if

					//&&&&&&&&&&&&&&&&&&&&&&&&&&analyze below urls &&&&&&&&&&&&&&&&&&&&&&&&&	
if(value==2)
{
	
	  
	var chk = document.getElementsByName('url');
    var len = chk.length;
	var b =[];
    for(i=0;i<len;i++)
    {
 
	   b.push(chk[i].value);
        
    }
	
	
	
			 $.ajax({
        type:"POST",
        url: "analysis/analyse.php",
        data: {b:b},
		
        success: function(response){
var j=JSON.parse(response);
		$("#analyze")[0].selectedIndex = 0; 	
			 google.load('visualization', '1', {'packages':['corechart']});
 var data = new google.visualization.arrayToDataTable([
 
      ['type', 'total'],
      ['Positive',j[0]],
      ['Negative', j[1]],
      ['Neutral', j[2]]
    ]);
 
 var chart = new google.visualization.PieChart(document.getElementById('rightPanel'));
     chart.draw(data, { is3D: true, title: 'Sentiment Analysis of only left side urls', width: 400, height: 240, backgroundColor: "#fffde4", color: ['blue', 'red', 'green']});
			 
			 
			 
			 
			 
		//do stuff after the AJAX calls successfully completes
    }

    });
			
			
		  
	  
	  
	  
	  }//else
	  
//dfssssss

					//&&&&&&&&&&&&&&&&&&&&&&&&&&analyze crawls with sentiments &&&&&&&&&&&&&&&&&&&&&&&&&	
if (value==3){
			 $.ajax({
        type:"POST",
        url: "analysis/analyze.php",
       data: "v=crawls"+ "&n="+$( "#numb1 option:selected" ).val(),
		
        success: function(response){

			  //alert(response);
			 var j=JSON.parse(response);
	$("#analyze")[0].selectedIndex = 0; 
//var l=j.length;
//if(l==3){
		google.load('visualization', '1', {'packages':['corechart']});
 var data = new google.visualization.arrayToDataTable([
 
      ['type', 'total'],
      ['Positive',j[0]],
      ['Negative', j[1]],
      ['Neutral', j[2]]
    ]);
 
 var chart = new google.visualization.PieChart(document.getElementById('rightPanel'));
     chart.draw(data, { is3D: true, title: 'Sentiment Analysis of crawled Urls', width: 400, height: 240, backgroundColor: "#fffde4", color: ['blue', 'red', 'green']});
	  
			 }
    });
}//if

					//&&&&&&&&&&&&&&&&&&&&&&&&&&analyze crawls + google resultss &&&&&&&&&&&&&&&&&&&&&&&&&	

if(value==4)
{
	 $.ajax({
        type:"POST",
        url: "analysis/analyze.php",
       data: "v=all"+ "&n="+$( "#numb1 option:selected" ).val(),
		
        success: function(response){

			  //alert(response);
			 var j=JSON.parse(response);
	$("#analyze")[0].selectedIndex = 0; 
//var l=j.length;
//if(l==3){
		google.load('visualization', '1', {'packages':['corechart']});
 var data = new google.visualization.arrayToDataTable([
 
      ['type', 'total'],
      ['Positive',j[0]],
      ['Negative', j[1]],
      ['Neutral', j[2]]
    ]);
 
 var chart = new google.visualization.PieChart(document.getElementById('rightPanel'));
     chart.draw(data, { is3D: true, title: 'Sentiment Analysis of All Urls', width: 400, height: 240, backgroundColor: "#fffde4", color: ['blue', 'red', 'green']});
	  
			 }
    });
	

	  }//if 2
//
					//&&&&&&&&&&&&&&&&&&&&&&&&&&show analysed crawled urls information &&&&&&&&&&&&&&&&&&&&&&&&&	

if(value==5)
{

var width  = 600;
 var height = 600;
 var left   = (screen.width  - width)/2;
 var top    = (screen.height - height)/2;
 var params = 'width='+width+', height='+height;
 params += ', top='+top+', left='+left;
 params += ', directories=no';
 params += ', location=no';
 params += ', menubar=no';
 params += ', resizable=no';
 params += ', scrollbars=no';
 params += ', status=no';
 params += ', toolbar=no';
 $("#analyze")[0].selectedIndex = 0; 
 newwin=window.open('analysis/crawl_sent.html','nill', params);
 if (window.focus) {newwin.focus()}
 }
 
 					//&&&&&&&&&&&&&&&&&&&&&&&&&&Crawls vs seed comaprison &&&&&&&&&&&&&&&&&&&&&&&&&	

if(value==6)
{
	
	$('<table><tr><td id="block1"></td></tr><tr><td id="block2"></td></tr></table>').appendTo( '#rightPanel' );
	 $.ajax({
        type:"POST",
        url: "analysis/analyze.php",
       data: "v=crawls"+ "&n="+$( "#numb1 option:selected" ).val(),
		
        success: function(response){

			  //alert(response);
			 var j=JSON.parse(response);
	$("#analyze")[0].selectedIndex = 0; 
//var l=j.length;
//if(l==3){
		google.load('visualization', '1', {'packages':['corechart']});
 var data = new google.visualization.arrayToDataTable([
 
      ['type', 'total'],
      ['Positive',j[0]],
      ['Negative', j[1]],
      ['Neutral', j[2]]
    ]);
 
 var chart = new google.visualization.PieChart(document.getElementById('block2'));
     chart.draw(data, { is3D: true, title: 'Crawler Sentiment Analysis', width: 400, height: 240, backgroundColor: "#fffde4", color: ['blue', 'red', 'green']});
	  
			 }
    });


 $.ajax({
        type:"POST",
        url: "analysis/analyze.php",
       data: "v=seed"+ "&n="+$( "#numb1 option:selected" ).val(),
		
        success: function(response){

			  //alert(response);
			 var j=JSON.parse(response);
	
//var l=j.length;
//if(l==3){
		google.load('visualization', '1', {'packages':['corechart']});
 var data = new google.visualization.arrayToDataTable([
 
      ['type', 'total'],
      ['Positive',j[0]],
      ['Negative', j[1]],
      ['Neutral', j[2]]
    ]);
 
 var chart = new google.visualization.PieChart(document.getElementById('block1'));
     chart.draw(data, { is3D: true, title: 'Seed Sentiment Analysis', width: 400, height: 240, backgroundColor: "#fffde4", color: ['blue', 'red', 'green']});
	  
			 }
    });
	
	
	
	}
///dfssssssss

					//&&&&&&&&&&&&&&&&&&&&&&&&&& seeing all crawls &&&&&&&&&&&&&&&&&&&&&&&&&	

if(value==7)
{

var width  = 600;
 var height = 600;
 var left   = (screen.width  - width)/2;
 var top    = (screen.height - height)/2;
 var params = 'width='+width+', height='+height;
 params += ', top='+top+', left='+left;
 params += ', directories=no';
 params += ', location=no';
 params += ', menubar=no';
 params += ', resizable=no';
 params += ', scrollbars=no';
 params += ', status=no';
 params += ', toolbar=no';
 $("#analyze")[0].selectedIndex = 0; 
 newwin=window.open('analysis/allcrawls.php','nill1', params);
 if (window.focus) {newwin.focus()}
 }	
 //
 
 
 					//&&&&&&&&&&&&&&&&&&&&&&&&&&crawled vs searched urls &&&&&&&&&&&&&&&&&&&&&&&&&	

 if(value==8)
{
	
	$('<table><tr><td id="block1"></td></tr><tr><td id="block2"></td></tr></table>').appendTo( '#rightPanel' );
	 $.ajax({
        type:"POST",
        url: "analysis/analyze.php",
       data: "v=crawls"+ "&n="+$( "#numb1 option:selected" ).val(),
		
        success: function(response){

			  //alert(response);
			 var j=JSON.parse(response);
	$("#analyze")[0].selectedIndex = 0; 
//var l=j.length;
//if(l==3){
		google.load('visualization', '1', {'packages':['corechart']});
 var data = new google.visualization.arrayToDataTable([
 
      ['type', 'total'],
      ['Positive',j[0]],
      ['Negative', j[1]],
      ['Neutral', j[2]]
    ]);
 
 var chart = new google.visualization.PieChart(document.getElementById('block2'));
     chart.draw(data, { is3D: true, title: 'Crawler Sentiment Analysis', width: 400, height: 240, backgroundColor: "#fffde4", color: ['blue', 'red', 'green']});
	  
			 }
    });


 $.ajax({
        type:"POST",
        url: "analysis/analyze.php",
       data: "v=info"+ "&n="+$( "#numb1 option:selected" ).val(),
		
        success: function(response){

			  //alert(response);
			 var j=JSON.parse(response);
	
//var l=j.length;
//if(l==3){
		google.load('visualization', '1', {'packages':['corechart']});
 var data = new google.visualization.arrayToDataTable([
 
      ['type', 'total'],
      ['Positive',j[0]],
      ['Negative', j[1]],
      ['Neutral', j[2]]
    ]);
 
 var chart = new google.visualization.PieChart(document.getElementById('block1'));
     chart.draw(data, { is3D: true, title: 'Searched Sentiment Analysis', width: 400, height: 240, backgroundColor: "#fffde4", color: ['blue', 'red', 'green']});
	  
			 }
    });
	
	
	
	}
 
 if (value==9){
	 var chk = document.getElementsByName('url');
    var len = chk.length;
	var b =[];
    var flag=0;
    for(i=0;i<len;i++)
    {
         if(chk[i].checked)
		 {
      
	   b.push(chk[i].value);
         flag ++;  }
    }
	if(flag==0)
	{
		alert('Must check one or more checkboxes to analze')
		$("#analyze")[0].selectedIndex = 0; 
		}
		else {
	
			 $.ajax({
        type:"POST",
        url: "analysis/analyze.php",
       data: "v=selected"+ "&n="+$( "#numb1 option:selected" ).val()+"&b="+b,
		
        success: function(response){

			$("#analyze")[0].selectedIndex = 0; 
			 var j=JSON.parse(response);
	
//var l=j.length;
//if(l==3){
		google.load('visualization', '1', {'packages':['corechart']});
 var data = new google.visualization.arrayToDataTable([
 
      ['type', 'total'],
      ['Positive',j[0]],
      ['Negative', j[1]],
      ['Neutral', j[2]]
    ]);
 
 var chart = new google.visualization.PieChart(document.getElementById('rightPanel'));
     chart.draw(data, { is3D: true, title: 'Selected Urls Sentiment Analysis', width: 400, height: 240, backgroundColor: "#fffde4", color: ['blue', 'red', 'green']});
	  
			 }
    });}//else
			 }//if
 
	if(value==10)
	{
		
		var num = prompt("Please specify number for best Urls","");
     
	 while (isNaN(num))
  {
alert("Must enter number")
  var num = prompt("Please specify number for best Urls","");
   
   }
   $("#analyze")[0].selectedIndex = 0; 
   var width  = 600;
 var height = 600;
 var left   = (screen.width  - width)/2;
 var top    = (screen.height - height)/2;
 var params = 'width='+width+', height='+height;
 params += ', top='+top+', left='+left;
 params += ', directories=no';
 params += ', location=no';
 params += ', menubar=no';
 params += ', resizable=no';
 params += ', scrollbars=no';
 params += ', status=no';
 params += ', toolbar=no';
 $("#analyze")[0].selectedIndex = 0; 
 newwin=window.open('analysis/best.php?v=Best'+'&n='+num,'bst', params);
 if (window.focus) {newwin.focus()}

  
		}
		
		
		if(value==11)
	{
		var num = prompt("Please specify number for best Urls","");
     
	 while (isNaN(num))
  {
alert("Must enter number")
  var num = prompt("Please specify number for best Urls","");
   
   }
   $("#analyze")[0].selectedIndex = 0; 
   var width  = 600;
 var height = 600;
 var left   = (screen.width  - width)/2;
 var top    = (screen.height - height)/2;
 var params = 'width='+width+', height='+height;
 params += ', top='+top+', left='+left;
 params += ', directories=no';
 params += ', location=no';
 params += ', menubar=no';
 params += ', resizable=no';
 params += ', scrollbars=no';
 params += ', status=no';
 params += ', toolbar=no';
 $("#analyze")[0].selectedIndex = 0; 
 newwin=window.open('analysis/best.php?v=Worst'+'&n='+num,'wrst', params);
 if (window.focus) {newwin.focus()}
  
  }
});
	
//display hide crawl options div**************************************************************************************************************************		
		
		  $('#options').show().click(function () { 
				//$('c_o').toggle('show');			
				var div = document.getElementById('c_o');
    if (div.style.visibility !== 'visible') {
        div.style.visibility = 'visible';
    }
    else {
        div.style.visibility = 'hidden';
    }
});
	
//checking all urls for seed**************************************************************************************************************************		
	
   $("#checkAll").click(function () {
          $('.url').attr('checked', this.checked);
    });
 
    // if all checkbox are selected, check the checkAll checkbox
    // and viceversa
    $(".url").click(function(){
 
        if($(".url").length == $(".url:checked").length) {
            $("#checkAll").attr("checked", "checked");
        } else {
            $("#checkAll").removeAttr("checked");
        }
 
    });

		  
		  
//adding seeds**************************************************************************************************************************		
		  
		  
		  $('#add').show().click(function () { 
				//$('#opt').toggle('show');
	var chk = document.getElementsByName('url');
    var len = chk.length;
	var b =[];
b.push($("#txtSearchTerm").val());

var flag=0;
    for(i=0;i<len;i++)
    {
         if(chk[i].checked)
		 {
      
	   b.push(chk[i].value);
         flag ++;  }
    }
	if(flag==0)
	{
		alert('Must check one or more checkboxes to enter as seed')
		}
		else {
			
			
$("#load_link").html('<img src="html/xampp1.gif" align="center" alt="Loading links"/> Adding seed');

			 $.ajax({
        type:"POST",
        url: "analysis/seed.php",
        data: {b:b},
		
        success: function(response){
$("#load_link").html('');

			 alert (response)
			 
			 $('#s_s').css("visibility", "visible");
			 $("#crawl").css("visibility", "visible");
			  $("#options").css("visibility", "visible");
		 
		//do stuff after the AJAX calls successfully completes
    }

    });
			
			
		}
 

});
		  
		  
		  
		   
		
//toggling between twitter and web search**************************************************************************************************************************		
		  

	 $('#S_web').show().click(function () { 
										  
										 
	
     document.getElementById("tweets").style.display = "none";
	 document.getElementById("searchtab").style.display = "block";
	  document.getElementById("st_an").style.display = "none";
	   $("#S_web").css("background","#D6CB89");
 	 $("#S_web").css("color","#324446");
	 
	 $("#S_twitter").css("background","#FFFFFF");
 	 $("#S_twitter").css("color","#D6CB89");
	 $("#s_a").css("background","#FFFFFF");
 	 $("#s_a").css("color","#D6CB89");
	 
	 
});
	 
	 
	 
	 
	
	
//search button activity**************************************************************************************************************************		

    $('#btnSearch').show().click(function () { 
										    $("#output").html("");
$("#load_link").html('<img src="html/xampp1.gif" align="center" alt="Loading links"/> Loading links');


 $.ajax({
        type:"POST",
        url: "analysis/del.php",
        
        success: function(response){
		
		//do stuff after the AJAX calls successfully completes
    }

    });
 											$("#re").css("visibility", "visible");
											
										   Search(0,$("#txtSearchTerm").val(),$( "#numb1 option:selected" ).val());
										   //	getOutput();				
										  		 $("#analyze").css("visibility", "hidden");
										    $("#clear_web").css("visibility", "hidden");
		   $("#output1").css("display", "none");
		   
		   $("#s_s").css("visibility", "hidden");
		    $("#c_o").css("visibility", "hidden");
			$("#options").css("visibility", "hidden");
		   $("#add").css("visibility", "hidden");
		   $("#crawl").css("visibility", "hidden");
		   $("#next").css("visibility", "hidden");
		   $("#back").css("visibility", "hidden");
		  
		   $("#checkAll").css("visibility", "hidden");
		    $("#stop").css("visibility", "hidden");
			 
		   $("#lblPageNumber").css("display", "none");	
				 $("#searchResult").html("");	
				 $("#rightPanel").html("");	
				 $("#s1").css("display", "none");
	 $("#s2").css("display", "none");$("#s3").css("display", "none");$("#s4").css("display", "none");$("#s5").css("display", "none");$("#s6").css("display", "none");
		 
										   
																			  
																			  });
	
 //back button activity**************************************************************************************************************************	
 


$('#back').click(function () {  $("#output").html("");
													  
													  Search(-1,$("#txtSearchTerm").val(),$( "#numb1 option:selected" ).val());
													  $("#analyze").css("visibility", "hidden");
										    $("#clear_web").css("visibility", "hidden");
		   $("#output1").css("display", "none");
		    $("#rightPanel").html("");	
				 $("#analyze")[0].selectedIndex = 0;
				  $("#checkAll").attr("checked", false); });
		
								
								
 //next button activity**************************************************************************************************************************		
	
	
    $('#next').click(function () {  $("#output").html("");
													  
													  Search(1, $("#txtSearchTerm").val(),$( "#numb1 option:selected" ).val()); 
													  $("#analyze").css("visibility", "hidden");
										    $("#clear_web").css("visibility", "hidden");
		   $("#output1").css("display", "none");
		    $("#rightPanel").html("");	
 $("#analyze")[0].selectedIndex = 0; 
 $("#checkAll").attr("checked", false);});
	 
 //X button activity**************************************************************************************************************************		

	  $('#clear_web').show().click(function () { 
				$("#output1").css("display", "none");	
				$("#txtSearchTerm").val("");
				 $("#output").html("");
		$("#analyze").css("visibility", "hidden");
		$("#clear_web").css("visibility", "hidden");
		$("#re").css("visibility", "hidden");
		 $("#searchResult").html("");
		 $("#load_link").html('');
		  $("#rightPanel").html("");	
		 $("#numb").val($("#numb option:first").val());
		  $("#numb1").val($("#numb option:first").val());
		  $("#add").css("visibility", "hidden");
		   $("#s_s").css("visibility", "hidden");
		    $("#c_o").css("visibility", "hidden");
			$("#options").css("visibility", "hidden");
		   
		   $("#crawl").css("visibility", "hidden");
		   $("#next").css("visibility", "hidden");
		   $("#back").css("visibility", "hidden");
		   $("#checkAll").css("visibility", "hidden");
		    $("#stop").css("visibility", "hidden");
		   $("#s1").css("display", "none");
		    
	 $("#s2").css("display", "none");$("#s3").css("display", "none");$("#s4").css("display", "none");$("#s5").css("display", "none");$("#s6").css("display", "none");
		  $("#dep").css("visibility", "hidden");
	    $("#numb").css("visibility", "hidden");
		   $("#lblPageNumber").css("display", "none");	



});
	  
	  
	  	
});


 //Functions**************************************************************************************************************************		


function Search(direction,term,number)
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

    $.getJSON(url, '', SearchCompleted);
	


}




function SearchCompleted(response)
{
	
    var html = "";
    $("#searchResult").html("");
	 
    if (response.items == null)
    {
        $("#searchResult").html("No matching pages found");
		$("#load_link").html('');
		$("#analyze").css("visibility", "hidden");
        return;
    }

    if (response.items.length === 0)
    {
        $("#searchResult").html("No matching pages found");
		$("#load_link").html('');
		$("#analyze").css("visibility", "hidden");
        return;
    }

    $("#searchResult").html("Total "+response.queries.request[0].totalResults + " pages found");

   
   
   
   //---------------
    if (response.queries.nextPage != null )
    {
	
        _nextIndex = response.queries.nextPage[0].startIndex;
		
	 $("#next").show();
    }
    else
    {
        $("#next").hide();
    }

    if (response.queries.previousPage != null)
    {
		
        _prevIndex = response.queries.previousPage[0].startIndex;
		
			
        $("#back").show();
    }
    else
    {
        $("#back").hide();
    }
 if (response.queries.request[0].totalResults > _resultsPerPage)
    {
        $("#lblPageNumber").show().html('Page '+_pageNumber);
    }
    else
    {
        $("#lblPageNumber").hide();
    }

    
	
	//---------------

    for (var i = 0; i < response.items.length; i++)
    {
        var item = response.items[i];
        var title = item.htmlTitle;
		var l=item.link;
		var s=item.htmlSnippet;
		fruits.push(l)

        //html += "<div><div class='hcHead2'><a  href='" + l + "'> " + title + "</a></div>";
        // html +="<div class='link'>" + l +" </div><br />";
		//html += "<div class='text'>" +s + "</div></div>";
		

			 $.ajax({
        type:"POST",
        url: "analysis/show1.php",
        data: "s="+l+ "&t="+title+"&sea="+$("#txtSearchTerm").val()+"&crawl="+$( "#numb option:selected" ).val()+"&d="+$( "#dep option:selected" ).val(),
		
        success: function(response){

			  $("#load_link").html('');	
		   $("#output").append(response)
		 $("#analyze").css("visibility", "visible");
		  $("#clear_web").css("visibility", "visible");
		  $("#add").css("visibility", "visible");
		  $("#sort").css("visibility", "visible"); 
		   $("#next").css("visibility", "visible");
		   $("#back").css("visibility", "visible");
				   $("#checkAll").css("visibility", "visible");

		//do stuff after the AJAX calls successfully completes
    }

    });
		
    }	//	html +="<div class='links'>"+fruits+" </div>";

    //$("#output").html(html);
	//$("#output1").html(fruits);
	

}
