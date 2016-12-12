<?php

function userExists($username,$password){

	global $dbh;

	$stmt = $dbh->prepare('SELECT password FROM users WHERE username = ?');
	$stmt->execute(array($username));
	$storedPassword = $stmt->fetch();

	$hashedPassword = $storedPassword['password'];

	return password_verify($password, $hashedPassword);
}

?>
