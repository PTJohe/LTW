<!DOCTYPE html>
<html>

<head>
	<title>Sign Up</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/Register.css">


	<body>
		<header>
			<?php include 'header.php' ?>
		</header>
		<div id="main">
			<div id="RegFoodle">
				<h1>Register in </h1><h1 id="foodle">foodle</h1><h1>!</h1>
			</div>
			<div id="Inputs" >
				<form method="post" class="form-signup" role = "form"
				action = "action_signUp.php" method = "post">
				<div id="cname">
					<b>Complete Name</b>
					<input type="text" placeholder="Enter your name" name="cname" required>
				</div>
				
				<div id=username>
					<p>
						<b>Username</b>
						<input type="text" placeholder="Enter Username" name="uname" required>
					</div>
				</p>
				<div id="password">
					<p>
						<b>Password</b>
						<input type="password" placeholder="Enter Password" name="psw1" required>
					</p>
				</div>
				<div id="cpassword">
					<p>
						<b>Confirm Password</b>
						<input type="password" placeholder="Confirm Password" name="psw2" required>
					</p>
				</div>

			</p>
			<p>
				<button type="submit" id="RegButton" name="SignUp">Register</button>
			</p>
		</form>
	</div>
</div>
<footer>
	<?php include 'footer.php' ?>
</footer>
</body>

</html>
