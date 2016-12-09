<?php
function insertResponse($idReview, $username, $text){

global $dbh;

if($text == null || $text == "")
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

$stmt = $dbh->prepare('SELECT * FROM reviews WHERE idReview = ?');
$stmt->execute(array($idReview));
$validReview = $stmt->fetch();
if($validReview == null || $validReview == '')
{
	return 3; //3 = "Invalid review";
}

$stmt = $dbh->prepare('INSERT INTO responses(idUser, idReview, text) VALUES(?, ?, ?)');
$stmt->execute(array($validUser['idUser'], $idReview, $text));
return 0; // 0 = Successful
}
 ?>