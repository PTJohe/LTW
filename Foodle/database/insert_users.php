<?php

function insertUser($completeName,$username,$password1,$password2){

	global $dbh;

	//Tries to get the username from database, to check if it already exists
	$stmt = $dbh->prepare('SELECT username FROM users WHERE username = ?');
	$stmt->execute(array($username));
	$checkedUsername = $stmt->fetch();

	if($password1!=$password2){
		// = 'passwords are different, try again';
		return 1; 
	}
	elseif($checkedUsername != null && $checkedUsername != ""){
		// = 'username already exists, please choose another';
		return 2;
	}
	elseif(strlen($password1) < 6){
		// = 'password must have at least 6 characters';
		return 3;
	}
	else {
		$hashedPassword = password_hash($password1, PASSWORD_BCRYPT);

		$stmt=$dbh->prepare('INSERT INTO users (username, password, name)
			VALUES (:username,:password,:name)');
		$stmt->bindParam(':username',$username);
		$stmt->bindParam(':password',$hashedPassword);
		$stmt->bindParam(':name',$completeName);

		$stmt->execute();

 		//= 'registration Successful';
		return 0;
	}
}

?>
