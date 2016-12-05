<!DOCTYPE html>
<html>
<?php
$dbh=new PDO('sqlite:database.db');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

<head>
<title>Sign In</title>
<meta charset="utf-8">
</head>
<body>
  <div id="container form-signin">
  <?php  $stmt=$dbh->prepare('SELECT * FROM users WHERE username = ? AND password = ?');

    $inputUsername=$_POST['uname'];
    $inputPassword=$_POST['psw'];

    if(isset($_POST['login'])){
      $stmt->execute(array($inputUsername,$inputPassword));
      $account=$stmt->fetchAll();
    }

    $bool=0;
    foreach($account as $row){
      if(isset($_POST['login']) && $row['username']==$inputUsername &&
      $row['password']==$inputPassword){
        $bool=1;
        echo 'Login Successful';
      }
  }
    if(isset($_POST['login'])&& $bool==0){
      echo 'wrong Password or Username';
    }
  ?>
</div>
  <div id="container">
    <form method="post" class="form-signin" role = "form" action = "<?php echo $_SERVER['PHP_SELF']; ?>"
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
