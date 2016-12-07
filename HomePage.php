<!DOCTYPE html>
<html>
<?php
session_start();

?>
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="HomePage.css">
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
            <h1>RestaurantRating</h1>
            <p class="Search"><input type="text" name="search" placeholder="Search Restaurants by name, location,food,menu"></p>
        </header>
    </section>
    <div class="Colecoes">
        <h2>Curiosities</h2>
        <img src="topSemana.jpg" alt="Image" style="width:104px;height:58px;">Top of the Week
        <p><img src="./resources/restaurantCur.jpg" alt="Image" style="width:104px;height:58px;">News</p>
    </div>
</body>

</html>
