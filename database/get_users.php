<?php
function userExists($username,$password){

global $dbh;

$stmt = $dbh->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
  $stmt->execute(array($username,sha1($password)));

  $stmt->fetch();
}
 ?>
