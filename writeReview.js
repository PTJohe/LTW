$(document).ready(function()
{
	$("#submitReview").click(function()
	{
		var reviewText = $("#newReviewText").val();
		var reviewRating = $("#newReviewRating").val();
		var reviewUser = $("#newReviewUser").val();
		var reviewRestaurant = $("#newReviewRestaurant").val();
		
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
		
		var newReview = $('<div class="review"></div>');
		newReview.append('<p>Rating: ' + reviewRating + '</p>');
		newReview.append('<p>Written by (WORK IN PROGRESS) </p>');
		newReview.append('<li>' + reviewText + '</li>');
		$("#reviews").append(newReview);
		return false;
	});
});