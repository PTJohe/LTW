<?php
$dbh = new PDO('sqlite:database.db');
$text = $_POST['text'];
$username = $_POST['username'];
$idReview = $_POST['idReview'];

echo $text;
echo $username;
echo $idReview;

//Checks if username exists
$stmt = $dbh->prepare('SELECT * FROM users WHERE username = ?');
$stmt->execute(array($username));
$validUser = $stmt->fetch();
if($validUser == null || $validUser == '')
{
	echo "Invalid user: ";
	echo $validUser;
	echo $username;
	die();
}

//Checks if review exists
$stmt = $dbh->prepare('SELECT * FROM reviews WHERE idReview = ?');
$stmt->execute(array($idReview));
$validReview = $stmt->fetch();
if($validReview == null || $validReview == '')
{
	echo "Invalid review";
	die();
}

$stmt = $dbh->prepare('INSERT INTO responses(idUser, idReview, text) VALUES(?, ?, ?)');
$stmt->execute(array($validUser['idUser'], $idReview, $text));
?>