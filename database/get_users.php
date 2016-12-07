<?php
function userExists($username,$password){

global $dbh;

$stmt = $dbh->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
  $stmt->execute(array($username,$password));

  $result=$stmt->fetch();

  if($result==null){
    return false;
  }
  else{
    return true;
  }
}
 ?>
