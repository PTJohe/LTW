<!DOCTYPE html>
<html>
<?php
$dbh=new PDO('sqlite:database.db');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<!-- foreach( $usernames as $row){
  echo $row['username'];
} -->
<head>
<title>Sign In</title>
<meta charset="utf-8">
<body>
  <div id="container form-signin">
  <?php  $stmt=$dbh->prepare('SELECT username FROM users ');
    $stmt->execute();
    $usernames=$stmt->fetchAll();
    $inputUserName=$_POST['uname'];
    $inputPassword=$_POST['psw'];
    $bool=0;
    foreach( $usernames as $row){
      if(isset($_POST['login']) && $row['username']==$inputUserName &&
      $row['password']==$inputPassword){
        $bool=1;
        echo 'Login Successful';
      }
  }
    if(bool==0){
      echo 'wrong Password or Username';
    }
  ?>
</div>
  <div id="container">
    <form  class="form-signin" role = "form"  action = "<?php echo $_SERVER['PHP_SELF']; ?>"
      method = "post">
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
