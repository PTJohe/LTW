$(document).ready(function()
{	
	$("#collections").click(function(e){
		var senderElement = e.target.id;
		if(senderElement !== "collections")
			return;

		if($('#topWeekOutput').is(':visible') || $('#newRestaurantsOutput').is(':visible')){
			$("#topWeekOutput").slideUp();	
			$("#newRestaurantsOutput").slideUp();
		}else{
			$("#topWeekOutput").slideDown();
			$("#newRestaurantsOutput").slideDown();
		}
	});

	$("#topWeek").click(function(e){
		var senderElement = e.target.tagName;
		if(senderElement.toLowerCase() === "p")
			return;

		if ($('#topWeekOutput').is(':visible'))
			$("#topWeekOutput").slideUp();			
		else
			$("#topWeekOutput").slideDown();
	});

	$("#newRestaurants").click(function(e){
		var senderElement = e.target.tagName;
		if(senderElement.toLowerCase() === "p")
			return;

		if ($('#newRestaurantsOutput').is(':visible'))
			$("#newRestaurantsOutput").slideUp();			
		else
			$("#newRestaurantsOutput").slideDown();
	});

	$("#liveSearch").keyup(function(){
		$("#results").html('<img src="resources/loading.gif" alt="" />');

		var value = this.value;
		if(value.length==0){
			$("#results").css('display', 'none');
		}
		else{
			$.post("search/livesearch.php",{partialState:value},function(data){
				$('#results').css('display', 'block');
				$("#results").html(data);
			});
		}
	});
});

