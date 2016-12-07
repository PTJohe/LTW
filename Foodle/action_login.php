<?php session_start(); ?>
<!DOCTYPE html>
<html>
<?php

include_once('database/connection.php');
include_once('database/get_users.php');

$loginState = "null"; //String that will be shown as title

if(userExists($_POST['uname'],$_POST['psw'])){
$_SESSION['username'] = $_POST['uname'];
$loginState = "Log In Successuful!";
}
else{
$loginState = "Couldn't Log In...";
}

?>

<head>
	<meta charset="utf-8">
	<title><?=$loginState?></title>
</head>
<body>
	<h2><?=$loginState?></h2>
	<form action="HomePage.php">
		<button type="submit" name="back">Go Back</button>
	</form>
	<!-- TODO
	Possible improvements:
	When it fails, show "login failed on the same page"
	When it succeeds, automatically goes to HomePage with "loggedon" display
	-->
</body>
</html>