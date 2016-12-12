<?php
$dbh=new PDO('sqlite:database.db');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


include_once 'paths.php';
include_once 'Utilities.php';


$rating=$_POST['restRating'];


$stmt = $dbh->prepare("SELECT restaurantName,idRestaurant FROM restaurants WHERE restaurantRating >= ?");
  $stmt->execute($rating);


  $result=$stmt->fetchAll();
  foreach($result as $row){
  //echo "<div>".$row['restaurantName']."</div>";
   echo "<div><a href=".$navPath."restaurant/".$row['idRestaurant'].">".$row['restaurantName']."</a></div>";
  }
 ?>
