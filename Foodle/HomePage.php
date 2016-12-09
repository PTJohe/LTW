<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <link rel="stylesheet">
  <!-- href="HomePage.css"> -->
</head>

<body>
  <header>
  <?php include 'header.php' ?>
    <nav>
      <?php include 'nav.php' ?>
    </nav>
    <form  class="form-search" role = "form" action = "Restaurant_Search.php" method="post">
      <p class="Search"><input type="text" name="search" placeholder="Search Restaurants by name, location,food,menu"></p>
      <button type="submit" name="searchBtn">Search</button>
    </form>
  </header>

  <div class="Colecoes">
    <h2>Curiosities</h2>
    <img src="topSemana.jpg" alt="Image" style="width:104px;height:58px;">Top of the Week
    <p><img src="./resources/restaurantCur.jpg" alt="Image" style="width:104px;height:58px;">News</p>
  </div>
</body>

</html>
