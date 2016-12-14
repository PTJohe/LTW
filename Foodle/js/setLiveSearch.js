function getStates(value){
	if(value.length==0){
		$("#results").css('display', 'none');
		return;
	}
	$("#results").html('<img src="resources/loading.gif" alt="" />');
	$.post("search/livesearch.php",{partialState:value},function(data){
		$('#results').css('display', 'block');
		$("#results").html(data);
	});
}
