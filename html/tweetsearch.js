

$(function ()
{
	
	$('#btnSearch1').click( function(){
									 $("#analyze1").css("visibility", "hidden");
				 $('#res').html('<img src="html/xampp.gif" align="center"/>');	
				 	  $('#chart_div').html("");									  

       var text= $('#txtSearchTerm1').val();
       var type=$( '#result_type option:selected' ).val();
	    var numb=$( '#numb option:selected' ).val();
	   
	   
    $.ajax({
        type:"POST",
        url: "ts/search.php",
        data: "variable1=" + text + "&variable2="+ type+ "&variable3="+ numb,
        success: function(response){
			 $('#res').html("");
         $('#res').html(response);
		  $("#analyze1").css("visibility", "visible");
		   $("#clear_web1").css("visibility", "visible");
		
		//do stuff after the AJAX calls successfully completes
    }

    });
	
});
	
	
	  $('#clear_web1').show().click(function () { 
				
				 $("#res").html("");

		 $("#chart_div").html("");
$("#analyze1").css("visibility", "hidden");
$('#txtSearchTerm1').val("");
$("#clear_web1").css("visibility", "hidden");
});

 $('#S_twitter').show().click(function () { 
	
     document.getElementById("tweets").style.display = "block";
	 document.getElementById("searchtab").style.display = "none";
	 document.getElementById("st_an").style.display = "none";
	  $("#S_twitter").css("background","#D6CB89");
 	 $("#S_twitter").css("color","#324446");
	  $("#S_web").css("background","#FFFFFF");
 	 $("#S_web").css("color","#D6CB89");
	 $("#s_a").css("background","#FFFFFF");
 	 $("#s_a").css("color","#D6CB89");

});
});



