<?php
function insertReview($idRestaurant, $username, $text, $rating){

global $dbh;

if($text == null || $text == "" || $rating == null || $rating == "")
{
	return 1; // 1 = No text or rating
}

$stmt = $dbh->prepare('SELECT * FROM users WHERE username = ?');
$stmt->execute(array($username));
$validUser = $stmt->fetch();
if($validUser == null || $validUser == '')
{
	return 2;// 2 = "Invalid user";
}

$stmt = $dbh->prepare('SELECT * FROM restaurants WHERE idRestaurant = ?');
$stmt->execute(array($idRestaurant));
$validRestaurant = $stmt->fetch();
if($validRestaurant == null || $validRestaurant == '')
{
	return 3; //3 = "Invalid restaurant";
}

$stmt = $dbh->prepare('INSERT INTO reviews(idUser, idRestaurant, text, rating) VALUES(?, ?, ?, ?)');
$stmt->execute(array($validUser['idUser'], $idRestaurant, $text, $rating));
return 0; // 0 = Successful
}
 ?>
