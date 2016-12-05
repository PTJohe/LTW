<!DOCTYPE html>
<html>
<?php
$dbh=new PDO('sqlite:database.db');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<head>
    <title>Sign Up</title>
    <meta charset="utf-8">

    <body>
        <div id="container">
          <?php

          $inputCompleteName=$_POST['cname'];
          $inputUsername=$_POST['uname'];
          $inputPassword1=$_POST['psw1'];
          $inputPassword2=$_POST['psw2'];

          if(isset($_POST['SignUp'])){
            if($inputPassword1!=$inputPassword2){
              echo 'passwords are different, try again';
            }
            else{
              $stmt=$dbh->prepare('INSERT INTO users (username, password, name)
              VALUES (:username,:password,:name)');
              $stmt->bindParam(':username',$inputUsername);
              $stmt->bindParam(':password',$inputPassword1);
              $stmt->bindParam(':name',$inputCompleteName);

              $stmt->execute();

              echo 'SignUp Successful';
            }
          }
          ?>
          <form method="post" class="form-signup" role = "form"
          action = "<?php echo $_SERVER['PHP_SELF']; ?>" method = "post">

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
                <label><b>Password</b>
    <input type="password" placeholder="Enter Again Password" name="psw2" required>
	</label>
            </p>
            <p>
                <button type="submit" name="SignUp">Sign Up</button>
            </p>
          </form>
        </div>
    </body>

</html>
