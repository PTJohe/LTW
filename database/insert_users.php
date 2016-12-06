<?php
function insertUser($completeName,$username,$password1,$password2){

global $dbh;

if($password1!=$password2){
  echo 'passwords are different, try again';
}
else{

$stmt=$dbh->prepare('INSERT INTO users (username, password, name)
VALUES (:username,:password,:name)');
$stmt->bindParam(':username',$username);
$stmt->bindParam(':password',$password1);
$stmt->bindParam(':name',$completeName);

$stmt->execute();

echo 'login Successful';
}

}
 ?>
