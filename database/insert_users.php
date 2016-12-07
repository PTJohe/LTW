<?php
function insertUser($completeName,$username,$password1,$password2){

global $dbh;

//Tries to get the username from database, to check if it already exists
$stmt->prepare('SELECT username FROM users WHERE username = ?');
$stmt->execute(array($username));
$checkedUsername = $stmt->fetch();

if($password1!=$password2){
  echo 'passwords are different, try again';
}
else if($checkedUsername == null || $checkedUsername == "")
{
	echo 'username already exists, please choose another';
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
