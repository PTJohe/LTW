$(document).ready(function()
{
	var initialEditValue;
	var initialTag;
	//Replaces element before the button with a box to edit
	$(".editButton").click(function()
	{
		//Closes all other edit elements
		$(".cancelButton").trigger("click");
		
		//Replaces text with a text box
		var actualtext = $(this).prev().text(); //Gets text from the element before the button
		var actualTag = $(this).prev(); //Gets the whole tag from the element before the button
		initialEditValue = actualtext;
		initialTag = actualTag;
		var test = $(this).prev();
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
		var newEditedTag = initialTag.text(newEditValue);
		initialEditValue = newEditValue;
		$(this).siblings(".editText").replaceWith(newEditedTag);
		$(this).siblings(".editButton").attr('type', 'image');
		$(this).siblings(".cancelButton").attr('type', 'hidden');
		$(this).attr('type', 'hidden');
		
		return false;

	});
	
	$(".cancelButton").click(function()
	{
		$(this).siblings(".editText").replaceWith(initialTag);
		$(this).siblings(".editButton").attr('type', 'image');
		$(this).siblings(".checkButton").attr('type', 'hidden');
		$(this).attr('type', 'hidden');
		return false;
	});
	
	//TODO o Botão de done coloca tudo na base de dados
	$(".doneButton").click(function()
	{
		//Closes all other edit elements
		$(".cancelButton").trigger("click");
		
		//TODO AJAX CALL TO ALTER THE DATABASE
		//var column = translateIdToColumn($(this).attr('id'));
		var id = $(".restaurantId").val();
		var name = $("#restaurantName").children(".editItem").text();
		var address = $("#restaurantAddress").children(".editItem").text();
		var number = $("#restaurantNumber").children(".editItem").text();
		var description = $("#restaurantDescription").children(".editItem").text();
		var category = $("#restaurantCategory").children(".editItem").text();
		
		if(validateTitle(name) == false)
		{
			alert("Invalid Name, illegal characters");
			window.location.reload();
			return false;
		}
		else if(validateAddress(address) == false)
		{
			alert("Invalid Address");
			window.location.reload();
			return false;
		}
		else if(validatePhoneNumber(number) == false)
		{
			alert("Invalid Phone Number");
			window.location.reload();
			return false;
		}
		else if(validateDescription(description) == false)
		{
			alert("Invalid Description, illegal characters");
			window.location.reload();
			return false;
		}
		
		var dataString = 'idRestaurant=' + id + '&name=' + name + '&address=' + address
		+ '&number=' + number + '&description=' + description + '&category=' + category;
		$.ajax({
		type: "POST",
		url: "../action_editRestaurant.php",
		data: dataString,
		cache: false,
		success: function(result)
		{
			if(result.substr(0, 6) == "Invalid")
			{
				alert(result);
			}
			else
			{
				alert("Saved Changes");
				window.location.replace("RestaurantPage.php"); //Returns to restaurant Page
			}
		}
		});
		
		
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

function validateTitle(title)
{
	//Doesn't recognize < (essential to pass scripts) and other simbols
	return /[\w \sáàãâäéèêëíìîïóòõôöúùûüçÁÀÃÂÄÉÈÊËÍÌÎÏÓÒÕÖÔÚÙÛÜÇ+-]+/.test(title);
}

function validatePhoneNumber(number)
{
	//Only recgnizes numbers
	return /(\+\d{3})?(\d{3}([-, ]?)){2}(\d{3})\b/.test(number);
}

function validateAddress(address)
{
	//Doesn't recognize < (essential to pass scripts) and other simbols
	return /[\w \sáàãâäéèêëíìîïóòõôöúùûüçÁÀÃÂÄÉÈÊËÍÌÎÏÓÒÕÖÔÚÙÛÜÇ+-]+/.test(address);
}

function validateDescription(description)
{
	//Doesn't recognize < (essential to pass scripts) and other simbols TODO bug! He recognizes!
	return /([\w \sáàãâäéèêëíìîïóòõôöúùûüçÁÀÃÂÄÉÈÊËÍÌÎÏÓÒÕÖÔÚÙÛÜÇ+-][^<])+/.test(description);
}