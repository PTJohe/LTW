$(document).ready(function()
{
	$("#submitReview").click(function()
	{
		var reviewText = $("#newReviewText").val();
		var reviewRating = $("#newReviewRating").val();
		var reviewUser = $("#newReviewUser").val();
		var reviewRestaurant = $("#newReviewRestaurant").val();
		
		//Calls the PHP to update the database
		if(reviewText == '' || reviewRating == '' || reviewUser == '' || reviewRestaurant == '')
		{
			alert("Please fill all fields");
		}
		else
		{
			var dataString = 'text=' + reviewText + '&rating=' + reviewRating + '&username=' + reviewUser + '&idRestaurant=' + reviewRestaurant;
			$.ajax({
			type: "POST",
			url: "SubmitReview.php",
			data: dataString,
			cache: false,
			success: function(result)
			{
				alert(result);
			}
			});
		}
		
		//Adds the HTML to the page
		var newReview = $('<div class="review"></div>');
		newReview.append('<p>Rating: ' + reviewRating + '</p>');
		newReview.append('<p>Written by (WORK IN PROGRESS) </p>');
		newReview.append('<li>' + reviewText + '</li>');
		$("#reviews").append(newReview);
		return false;
	});
	
	$("#submitResponse").click(function()
	{
		var responseText = $("#newResponseText").val();
		var responseUser = $("#newResponseUser").val();
		var responseReview = $("#newResponseReview").val();
		
		//Calls the PHP to update the database
		if(responseText == '' || responseUser == '' || responseReview == '')
		{
			alert("Please fill all fields");
		}
		else
		{
			var dataString = 'text=' + responseText + '&username=' + responseUser + '&idReview=' + responseReview;
			$.ajax({
			type: "POST",
			url: "SubmitResponse.php",
			data: dataString,
			cache: false,
			success: function(result)
			{
				alert(result);
			}
			});
		}
		
		//Adds the HTML to the page
		var newResponse = $('<div class="response"></div>');
		newResponse.append('<p>Written by (WORK IN PROGRESS) </p>');
		newResponse.append('<li>' + responseText + '</li>');
		$(".responses #newResponseReview").append(newResponse);
		//TODO this is not working
		console.log($(".responses #newResponseReview"));
		return false;
	});
});