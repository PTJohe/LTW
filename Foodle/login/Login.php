<?php
//Start the Session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/login/Login.css">

	<script src="../js/lib/jquery-1.11.3.min.js"></script>
	<script src="../js/lib/jquery.form.js"></script>
	<script src="../js/login.js"></script>
</head>
<body>
	<header>
		<?php include '../header.php' ?>
	</header>
	<div id="main">
		<div id="LoginFoodle">
			<h1>Login into </h1><h1 id="foodle">foodle</h1><h1>!</h1>
		</div>
		<div id="Inputs">
			<form id="form-login" method="post">
				<div id="notification"></div>
				<div class="form-input" id="username">
					<b>Username</b><input class="UserName" type="text" placeholder="Enter Username" name="uname" required>
				</div>
				<div class="form-input" id="password">
					<b>Password</b><input class="Password" type="password" placeholder="Enter Password" name="psw" required>
				</div>
				<button type="submit" id="loginButton" name="login">Sign In</button>
			</form>
		</div>
	</div>

	<footer>
		<?php include '../footer.php' ?>
	</footer>
</body>
</html>
