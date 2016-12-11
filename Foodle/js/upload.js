$(document).ready(function()
{
	$('#submitImage').click(function() 
	{ // jQuery on change form
		console.log('2');
		$("#resultImageProfile").html('<img src="../resources/loading.gif" alt="" />');
		$('#MyImageProfileUploadForm').ajaxForm(
		{ // AJAX form plugin to upload a single image
			url: 'uploadImage.php', // Call this file to update database and send back the correct new image and URL
			dataType: 'json', // JSON farmat
			success: function(data){
				$('#resultImageProfile').html(data.text); // We display text in the div resultImageProfile tank
				$(".myImage img").load(function() 
				{ // We break the cache and force the browser to check for the image again
					$(".myImage img").attr( 'src', data.imgURL + '?dt=' + (+new Date()) );
					$(".myImage img").attr( 'width', 250);
					$(".myImage img").attr( 'height', 250);
				}); 
			}
		}).submit();
	});
});