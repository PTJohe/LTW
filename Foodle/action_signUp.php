<?php session_start(); ?>
<!DOCTYPE html>

<html>
<?php

include_once('database/connection.php');
include_once('database/insert_users.php');

$result = insertUser($_POST['cname'],$_POST['uname'],$_POST['psw1'],$_POST['psw2']);
$resultStringsArray = array('Registration Successful', 'Passwords don\'t match', 'Username already taken');

$resultString = $resultStringsArray[$result];

?>
<head>
	<meta charset="utf-8">
	<title><?=$resultString?></title>
</head>

<body>
	<h2><?=$resultString?></h2>
	<?php
	if($result == 0)
		{ ?>
	<form action="HomePage.php">
		<button type="submit" name="back">Go Back</button>
	</form>
	<?php } 
	else
		{?>
	<form action="SignUp.php">
		<button type="submit" name="back">Try Again</button>
	</form>
	<?php } ?>
</body>
</html>