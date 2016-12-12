<?php

function insertResponse($idReview, $username, $text){

	global $dbh;

	if($text == null || $text == ""){
		// 1 = No text or rating
		return 1; 
	}

	$stmt = $dbh->prepare('SELECT * FROM users WHERE username = ?');
	$stmt->execute(array($username));
	$validUser = $stmt->fetch();
	if($validUser == null || $validUser == ''){
	// 2 = "Invalid user";
		return 2;
	}

	$stmt = $dbh->prepare('SELECT * FROM reviews WHERE idReview = ?');
	$stmt->execute(array($idReview));
	$validReview = $stmt->fetch();
	if($validReview == null || $validReview == ''){
		//3 = "Invalid review";
		return 3; 
	}

	$stmt = $dbh->prepare('INSERT INTO responses(idUser, idReview, text) VALUES(?, ?, ?)');
	$stmt->execute(array($validUser['idUser'], $idReview, $text));

	// 0 = Successful
	return 0;
}

?>