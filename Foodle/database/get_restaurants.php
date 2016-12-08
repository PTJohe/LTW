<?php
function restaurantExist($name){

global $dbh;

$stmt = $dbh->prepare('SELECT * FROM restaurants WHERE restaurantName = ? OR
  address = ?');
  $stmt->execute(array($name));

  $result=$stmt->fetch();

  if($result==null){
    echo 'restaurant not found, try again';
    return false;
  }
  else{
    return $result['restaurantName'];
  }
}
 ?>
