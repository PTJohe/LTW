$(document).ready(function()
{	
	$("#searchResults").html('<img src="../resources/loading.gif" alt="" />');
	$('.form-search').ajaxForm(
		{ // AJAX form plugin to edit details
			url: 'normalSearch.php', // Call this file to update database and send back a response message
			dataType: 'json', // JSON format
			success: function(data){
				$('#searchResults').html(data.text); 
				console.log('1');
			}
		}).submit();



	$('#searchButton').click(function() 
	{ // jQuery click form
		$("#searchResults").html('<img src="../resources/loading.gif" alt="" />');
		$('.form-search').ajaxForm(
		{ // AJAX form plugin to edit details
			url: 'normalSearch.php', // Call this file to update database and send back a response message
			dataType: 'json', // JSON format
			success: function(data){
				$('#searchResults').html(data.text); 
			}
		}).submit();
	});

	$("#advancedSearch ").click(function(){
		var senderElement = event.target.id;
		
		switch(senderElement){			
			case 'sortFilter':
			if ($('#sortFilterInput').is(':visible'))
				$("#sortFilterInput").slideUp();			
			else
				$("#sortFilterInput").slideDown();
			break;

			case 'ratingFilter':
			if ($('#ratingFilterInput').is(':visible'))
				$("#ratingFilterInput").slideUp();			
			else
				$("#ratingFilterInput").slideDown();
			break;

			case 'categoryFilter':
			if ($('#categoryFilterInput').is(':visible'))
				$("#categoryFilterInput").slideUp();			
			else
				$("#categoryFilterInput").slideDown();
			break;

			case 'advancedSearch':
			if ($('#filterForm').is(':visible'))
				$("#filterForm").slideUp();			
			else
				$("#filterForm").slideDown();
			break;

			default:
			break;
		}
	});


	$(document).on('input', '#slider', function() {
		$('#slider_value').html( $(this).val() );
	});

	function getRanges(value){
		if(value.length==0){
			$("#resultRating").html("");
			return;
		}
		$.post("ratingsearch.php",{restRating:value},function(data){
			$("#resultRating").html(data);
		});
	}

	$('#applyFilter').click(function() 
	{ // jQuery click form
		$("#searchResults").html('<img src="../resources/loading.gif" alt="" />');
		$('#filterForm').ajaxForm(
		{ // AJAX form plugin to edit details
			url: 'advancedSearch.php', // Call this file to update database and send back a response message
			dataType: 'json', // JSON format
			success: function(data){
				$('#searchResults').html(data.text); 
			}
		}).submit();
	});
});

