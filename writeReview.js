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
	
	$(".submitResponse").click(function()
	{
		var responseText = $(this).siblings("#newResponseText").val();
		console.log($(this).siblings("#newResponseText"));
		var responseUser = $(this).siblings("#newResponseUser").val();
		var responseReview = $(this).siblings("#newResponseReview").val();
		var responseUserFullName = "";
		
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
				if(result == "Invalid user" || result == "Invalid review")
				{
					alert(result);
				}
				else
				{
					responseUserFullName = result;
					
					//Adds the HTML to the page
					var newResponse = $('<div class="response"></div>');
					newResponse.append('<p>Written by '+ responseUserFullName + ' </p>');
					newResponse.append('<li>' + responseText + '</li>');
					$("#response" + responseReview).append(newResponse);
					console.log($("#" + responseReview));
				}
			}
			
			});
		}
		
		return false;
	});
});