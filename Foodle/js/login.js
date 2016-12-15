$(document).ready(function()
{
	$('#loginButton').click(function() 
	{ // jQuery click form
		$('#form-login').ajaxForm(
		{ // AJAX form plugin to edit details
			url: 'action_login.php', // Call this file to update database and send back a response message
			dataType: 'json', // JSON format
			success: function(data){
				if(data.loginState == false)
					$('#notification').html(data.text);
				else{
					if(history.length > 0)
						window.history.back();
					else 
						window.location = "https://gnomo.fe.up.pt/~up201303962/Foodle";
				}
			}
		}).submit();
	});

});	