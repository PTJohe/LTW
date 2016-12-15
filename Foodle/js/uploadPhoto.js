$(document).ready(function()
{
	$('#submitImage').click(function(e) 
	{ // jQuery click form
		e.preventDefault();
		e.stopImmediatePropagation();
		$('#uploadImageForm').ajaxForm(
		{ // AJAX form plugin to edit details
			url: 'uploadFile.php', // Call this file to update database and send back a response message
			dataType: 'json', // JSON format
			success: function(data){
				console.log(data.uploadState);
				if(data.uploadState == true){
					$('#uploadImageForm').hide();
				}
				$('#uploadNotification').html(data.text);
			}
		}).submit();
	});
});