<?php

function insertReview($idRestaurant, $username, $text, $rating){

	global $dbh;

	if($text == null || $text == "" || $rating == null || $rating == ""){
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

	$stmt = $dbh->prepare('SELECT * FROM restaurants WHERE idRestaurant = ?');
	$stmt->execute(array($idRestaurant));
	$validRestaurant = $stmt->fetch();
	if($validRestaurant == null || $validRestaurant == ''){
		//3 = "Invalid restaurant";
		return 3; 
	}

	$stmt = $dbh->prepare('INSERT INTO reviews(idUser, idRestaurant, text, rating) VALUES(?, ?, ?, ?)');
	$stmt->execute(array($validUser['idUser'], $idRestaurant, $text, $rating));
	
	// 0 = Successful
	return 0; 
}

?>
