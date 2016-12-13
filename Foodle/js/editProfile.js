$(document).ready(function()
{
	$(window).keydown(function(event){
		if(event.keyCode == 13) {
			event.preventDefault();
			return false;
		}
	}); 

	$('#submitImage').click(function() 
	{ // jQuery click form
		$("#currentPhoto").html('<img src="../resources/loading.gif" alt="" />');
		$('#editImageForm').ajaxForm(
		{ // AJAX form plugin to upload a single image
			url: 'uploadFile.php', // Call this file to update database and send back the correct new image and URL
			dataType: 'json', // JSON format
			success: function(data){
				$('#currentPhoto').html(data.text);
				$(".myImage img").load(function() 
				{ // We break the cache and force the browser to check for the image again
					$(".myImage img").attr( 'src', data.imgURL + '?dt=' + (+new Date()) );
					$(".myImage img").attr( 'width', 250);
					$(".myImage img").attr( 'height', 250);
				}); 
			}
		}).submit();
	});

	$('#submitChanges').click(function() 
	{ // jQuery click form
		$('#editDetailsForm').ajaxForm(
		{ // AJAX form plugin to edit details
			url: 'editProfile.php', // Call this file to update database and send back a response message
			dataType: 'json', // JSON format
			success: function(data){
				$('#editNotification').html(data.text);
			}
		}).submit();
	});

	$('#createRestaurant').click(function(e) 
	{ // jQuery click form
		e.preventDefault();
		e.stopImmediatePropagation();
		$('#addRestaurantForm').ajaxForm(
		{ // AJAX form plugin to edit details
			url: 'addRestaurant.php', // Call this file to update database and send back a response message
			dataType: 'json', // JSON format
			success: function(data){
				$('#addNotification').html(data.text);
				if(data.success === true){
					$('#createRestaurant').hide();
				}
			}
		}).submit();
	});
});