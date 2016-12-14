$(document).ready(function()
{
	var idRestaurant = $("#restaurantId").val();
	var imageIds = [];
	var actualImage;
	var dataString = 'idRestaurant=' + idRestaurant;
	
	$.ajax({
		type: "POST",
		url: "../action_showPhotos.php",
		data: dataString,
		dataType:"json",
		cache: false,
		success: function(result)
		{
			if(result == -1)
			{
				alert("Error");
			}
			else if(result.length > 0)
			{
				actualImage = 0;
				imageIds = result;
			}
			else
			{
				actualImage = -1;
			}
			
			$("#imageSlideShow").children('img').attr('src', '../resources/restaurantPhotos/' + imageIds[actualImage][0] + '.png');
		}
		});
		
	$("#imageSlideShow").children("input").click(function()
	{
		var change = 0; //+1 or -1 in the array of photos
		if($(this).attr("id") == "previousPhoto")
		{
			change = -1;
		}
		else if($(this).attr("id") == "nextPhoto")
		{
			change = 1;
		}
		else
		{
			console.log("Error on id Change Photo");
			change = 0;
		}
		
		//If there are no images, this function does nothing
		if(actualImage == -1)
		{
			return false;
		}
		
		//Change the photo id to the next/prev photo
		if(actualImage == 0 && change == -1)
		{
			actualImage = imageIds.length - 1;
		}
		else if(actualImage == imageIds.length - 1 && change == 1)
		{
			actualImage = 0;
		}
		else
		{
			actualImage += change;
		}
		
		var newImage = imageIds[actualImage][0];
		//imageIds[actualImage][actualImage] porque ele devolve na resposta ao ajax sempre objetos, com o indice la dentro
		$("#imageSlideShow").children('img').attr('src', '../resources/restaurantPhotos/' + newImage + '.png');
	});
});