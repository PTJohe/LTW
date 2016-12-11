<?php
$dbh=new PDO('sqlite:database.db');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


include_once 'paths.php';
include_once 'Utilities.php';


$partialStates=$_POST['partialState'];


$stmt = $dbh->prepare("SELECT restaurantName FROM restaurants WHERE restaurantName LIKE '%$partialStates%'");
  $stmt->execute();

  $result=$stmt->fetchAll();
  foreach($result as $row){
  //echo "<div>".$row['restaurantName']."</div>";
   echo "<div><a href=".$navPath."restaurant/".$row['restaurantName'].">".$row['restaurantName']."</a></div>";
  }
 ?>
