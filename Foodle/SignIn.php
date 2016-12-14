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
    <div id=Inputs>
    <form  class="form-signin" role = "form" action = "action_login.php" method="post">
<p>
      <div id=username>
        <form class="form-user">
    <label ><b>Username</b>
        <input class="UserName" type="text" placeholder="Enter Username" name="uname" required>
    </label>
  </form>
  </div>
</p>
    <p>
      <div id=password>
        <form class="form-pass">
        <label><b>Password</b>
            <input class="Password"type="password" placeholder="Enter Password" name="psw" required>
        </label>
      </form>
      </div>
    </p>
    <div id=submit>
        <button type="submit" name="login">Sign In</button>
  </div>
  </div>
  </div>
    <footer>
      <?php include 'footer.php' ?>
    </footer>
</form>

</body>
</html>
