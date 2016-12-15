<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/register/Register.css">

	<script src="../js/lib/jquery-1.11.3.min.js"></script>
	<script src="../js/lib/jquery.form.js"></script>
	<script src="../js/register.js"></script>
</head>
<body>
	<header>
		<?php include '../header.php' ?>
	</header>
	<div id="main">
		<div id="RegFoodle">
			<h1>Register in </h1><h1 id="foodle">foodle</h1><h1>!</h1>
		</div>
		<div id="Inputs" >
			<form method="post" id="form-signup" method = "post">
				<div id="notification"></div>

				<div class="form-input" id="cname">
					<b>Complete Name</b><input type="text" placeholder="Enter your name" name="cname" required>
				</div>
				<div class="form-input" id="username">
					<b>Username</b><input type="text" placeholder="Enter Username" name="uname" required>
				</div>
				<div class="form-input" id="password">
					<b>Password</b><input type="password" placeholder="Enter Password" name="psw1" required>
				</div>
				<div class="form-input" id="cpassword">
					<b>Confirm Password</b><input type="password" placeholder="Confirm Password" name="psw2" required>
				</div>

				<button type="submit" id="RegButton" name="SignUp">Register</button>
			</form>
		</div>
	</div>

	<footer>
		<?php include '../footer.php' ?>
	</footer>

</body>
</html>
