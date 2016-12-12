<!DOCTYPE html>
<html>

<head>
  <title>Sign Up</title>
  <meta charset="utf-8">

  <body>
    <div id="container">

      <form method="post" class="form-signup" role = "form"
      action = "action_signUp.php" method = "post">

      <label><b>Complete Name</b>
        <input type="text" placeholder="Enter your name" name="cname" required>
      </label>
      <p>
        <label><b>Username</b>
          <input type="text" placeholder="Enter Username" name="uname" required>
        </label>
      </p>
      <p>
        <label><b>Password</b>
          <input type="password" placeholder="Enter Password" name="psw1" required>
        </label>
      </p>
      <p>
        <label><b>Confirm Password</b>
          <input type="password" placeholder="Confirm Password" name="psw2" required>
        </label>
      </p>
      <p>
        <button type="submit" name="SignUp">Sign Up</button>
      </p>
    </form>
  </div>
</body>

</html>
