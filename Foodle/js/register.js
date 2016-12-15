$(document).ready(function()
{
	console.log('1');
	$('#RegButton').click(function() 
	{ // jQuery click form
		console.log('2');
		$('#form-signup').ajaxForm(
		{ // AJAX form plugin to edit details
			url: 'action_signUp.php', // Call this file to update database and send back a response message
			dataType: 'json', // JSON format
			success: function(data){
				console.log('3');
				console.log(data.text);
				if(data.regState != 0)
					$('#notification').html(data.text);
				else{
					window.location = "https://gnomo.fe.up.pt/~up201303962/Foodle";
				}
			}
		}).submit();
	});

});	