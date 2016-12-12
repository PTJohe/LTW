<?php
function
global $dbh;

$partialStates=$_POST['partialState'];


$stmt = $dbh->prepare("SELECT restaurant FROM restaurants WHERE restaurantName LIKE ?");
  $stmt->execute('%'.$partialStates.'%');

  $result=$stmt->fetchAll();
  foreach($result as $row){
  echo "<div>".$row['restaurantName']."</div>";
  }
 ?>
