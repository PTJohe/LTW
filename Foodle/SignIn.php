<?php
//Start the Session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign In</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/Login.css">
</head>
<body>
	<header>
		<?php include 'header.php' ?>
	</header>
	<div id="main">
		<div id="LoginFoodle">
			<h1>Login into </h1><h1 id="foodle">foodle</h1><h1>!</h1>
		</div>
		<div id="Inputs">
			<form class="form-login"  action = "action_login.php" method="post">
				<div id="username">
					<div class="form-user">
						<label>
							<b>Username</b><input class="UserName" type="text" placeholder="Enter Username" name="uname" required>
						</label>
					</div>
				</div>
				<div id="password">
					<div class="form-pass">
						<label>
							<b>Password</b><input class="Password"type="password" placeholder="Enter Password" name="psw" required>
						</label>
					</div>
				</div>
				<button type="submit" id="loginButton" name="login">Sign In</button>
			</form>
		</div>
	</div>

	<footer>
		<?php include 'footer.php' ?>
	</footer>
</body>
</html>
