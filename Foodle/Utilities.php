<?php

include_once 'paths.php';

define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);

session_start();

function isLoggedIn(){
	//True if logged in, false otherwise
	if ($_SESSION['username'])
		return true;
	else return false; 
}

function getCurrentUser(){
	return $_SESSION['username'];
}

function getCurrentUserID(){
	//Opens database
	$dbh = new PDO('sqlite:../database.db');
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //To enable error handling
	$inputUsername = getCurrentUser();

	//Gets the user
	$stmt = $dbh->prepare('SELECT * FROM users WHERE username = ?');
	$stmt->execute(array($inputUsername));
	$selectedUser = $stmt->fetch();

	//Get the infos needed
	$userID = $selectedUser['idUser'];
	
	return $userID;
}

?>