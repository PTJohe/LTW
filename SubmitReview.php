<?php
$dbh = new PDO('sqlite:database.db');
$text = $_POST['text'];
$rating = $_POST['rating'];
$username = $_POST['username'];
$idRestaurant = $_POST['idRestaurant'];

echo $text;
echo $rating;
echo $username;
echo $idRestaurant;

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

$stmt = $dbh->prepare('SELECT * FROM restaurants WHERE idRestaurant = ?');
$stmt->execute(array($idRestaurant));
$validRestaurant = $stmt->fetch();
if($validRestaurant == null || $validRestaurant == '')
{
	echo "Invalid restaurant";
	die();
}

$stmt = $dbh->prepare('INSERT INTO reviews(idUser, idRestaurant, text, rating) VALUES(?, ?, ?, ?)');
$stmt->execute(array($validUser['idUser'], $idRestaurant, $text, $rating));
?>