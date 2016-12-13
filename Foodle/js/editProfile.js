$(document).ready(function()
{
	$('#submitImage').click(function() 
	{ // jQuery click form
		$("#currentPhoto").html('<img src="../resources/loading.gif" alt="" />');
		$('#editImageForm').ajaxForm(
		{ // AJAX form plugin to upload a single image
			url: 'uploadFile.php', // Call this file to update database and send back the correct new image and URL
			dataType: 'json', // JSON format
			success: function(data){
				$('#currentPhoto').html(data.text); // We display text in the div currentPhoto tank
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
				$('#editNotification').html(data.text); // We display text in the div currentPhoto tank 
			}
		}).submit();
	});
});