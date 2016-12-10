$(document).ready(function()
{
	//Replaces element before the button with a box to edit
	$(".editable input").click(function()
	{
		var actualtext = $(this).prev().text(); //Gets text from the element before the button
		var textBox = $('<input type="text" value="' + actualtext + '" >')
		$(this).prev().replaceWith(textBox);
		
		
		var column = translateIdToColumn($(this).attr('id'));
		
		//TODO AJAX call
		
		return false;
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