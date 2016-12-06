<?php
$dbh = new PDO('sqlite:database.db');
$text = $_POST['text'];
$username = $_POST['username'];
$idReview = $_POST['idReview'];

//Checks if username exists
$stmt = $dbh->prepare('SELECT * FROM users WHERE username = ?');
$stmt->execute(array($username));
$validUser = $stmt->fetch();
if($validUser == null || $validUser == '')
{
	error_log("Invalid user");
	$error = "Invalid user";
	echo $error;
	die();
}

//Gets the user full name
$fullname = $validUser['name'];

//Checks if review exists
$stmt = $dbh->prepare('SELECT * FROM reviews WHERE idReview = ?');
$stmt->execute(array($idReview));
$validReview = $stmt->fetch();
if($validReview == null || $validReview == '')
{
	error_log("Invalid review");
	$error = "Invalid review";
	echo $error;
	die();
}

$stmt = $dbh->prepare('INSERT INTO responses(idUser, idReview, text) VALUES(?, ?, ?)');
$stmt->execute(array($validUser['idUser'], $idReview, $text));
echo $fullname;
?>