<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <?php
  include_once('database/connection.php');
  include_once('database/get_restaurants.php');
  ?>
    <title>Restaurant_Search</title>
    <meta charset="utf-8">
    <link rel="stylesheet">
</head>

<body>
    <section>
        <div id="Login">
          <?php
            if($_SESSION['username']){
           ?>
           <p class="LogOut"><a href="Logout.php">LogOut </a></p>
		   <p><?=$_SESSION['username']?></p>
           <?php
         }
         else{
           ?>

            <p class="SignIn"><a href="SignIn.php">Sign In</a></p>
            <p class="SignUp"><a href="SignUp.php">Sign Up</a></p>

          <?php }?>
        </div>
        <header id="header">

            <h1>Restaurants -
              <?php $result=restaurantExist($_POST['search']);?>
            </h1>
        </header>
    </section>
</body>

</html>
