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

           <?php include 'nav.php';
           if(restaurantExist($_POST['search'])!=false){
             $_SESSION['restaurantName']=$_POST['search'];
           ?>

        </div>
        <header id="header">
            <h1>Restaurants -
              <?php include('search.php'); }?>
            </h1>
            <form action="HomePage.php">
              <button type="submit" name="back">Go Back</button>
            </form>
        </header>
    </section>
</body>

</html>
