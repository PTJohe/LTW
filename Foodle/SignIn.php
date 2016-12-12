<?php
//Start the Session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
    <meta charset="utf-8">
</head>
<body>
  <div id="container">
    <form  class="form-signin" role = "form"
    action = "action_login.php" method="post">
    <label><b>Username</b>
        <input class="UserName" type="text" placeholder="Enter Username" name="uname" required>
    </label>
    <p>
        <label><b>Password</b>
            <input class="Password"type="password" placeholder="Enter Password" name="psw" required>
        </label>
    </p>
    <p>
        <button type="submit" name="login">Sign In</button>
    </p>
</form>
</div>
</body>
</html>
