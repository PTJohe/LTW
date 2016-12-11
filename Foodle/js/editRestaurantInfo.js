$(document).ready(function()
{
	var initialEditValue;
	//Replaces element before the button with a box to edit
	$(".editButton").click(function()
	{
		//Replaces text with a text box
		var actualtext = $(this).prev().text(); //Gets text from the element before the button
		initialEditValue = actualtext;
		var textBox = $('<input class="editText" type="text" value="' + actualtext + '" >');
		$(this).prev().replaceWith(textBox);
		
		$(this).siblings('.cancelButton').attr('type', "image");
		$(this).siblings('.checkButton').attr('type', "image");
		$(this).attr('type', "hidden");
		
		
		
		return false;
	});
	
	$(".checkButton").click(function()
	{
		var newEditValue = $(this).siblings(".editText").val();
		initialEditValue = newEditValue;
		$(this).siblings(".editText").replaceWith('<h2>' + newEditValue + '</h2>'); //TODO NAO PODE SER ASSIM! NEM TODOS TEEM A TAG H2!
		$(this).siblings(".editButton").attr('type', 'image');
		$(this).siblings(".cancelButton").attr('type', 'hidden');
		$(this).attr('type', 'hidden');
		
		return false;

	});
	
	$(".cancelButton").click(function()
	{
		$(this).siblings(".editText").replaceWith('<h2>' + initialEditValue + '</h2>')
		$(this).siblings(".editButton").attr('type', 'image');
		$(this).siblings(".checkButton").attr('type', 'hidden');
		$(this).attr('type', 'hidden');
		return false;
	});
	
	//TODO o Botão de done coloca tudo na base de dados
	$(".doneButton").click(function()
	{
		//TODO AJAX CALL TO ALTER THE DATABASE
		var column = translateIdToColumn($(this).attr('id'));
		/*
		//After
		var dataString = 'id=' + reviewText + '&parameter=' + reviewRating + '&value=' + reviewUser;
		$.ajax({
		type: "POST",
		url: "action_editRestaurant.php",
		data: dataString,
		cache: false,
		success: function(result)
		{
			if(result == "Text/Rating empty" || result == "Invalid User" || result == "Invalid Restaurant")
			{
				alert(result);
			}
			else
			{
				//Adds the HTML to the page
				var newReview = $('<div class="review"></div>');
				newReview.append('<p>Rating: ' + reviewRating + '</p>');
				newReview.append('<p>Written by '+ result + '</p>');
				newReview.append('<li>' + reviewText + '</li>');
				$("#reviews").append(newReview);
			}
		}
		});
		*/	
		
		return false;
	});
});
	
function translateIdToColumn(id)
{
	var result;
	
	switch(id){
		case 'restaurantname':
			result = "resturantName";
			break;
		//TODO Create other ids
		default:
			result = "Invalid";
			break;
	}
	
	return result;
}