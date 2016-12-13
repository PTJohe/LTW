<?php

$userId = $_POST['userId'];
$restaurantName = $_POST['restaurantName'];

$success = false;

if(strlen($restaurantName) == 0){
	$text = '<div class="alert alert-danger" role="alert">The restaurant name must not be empty!</div>';
	goto sendAnswer;
}
if(preg_match("/[^a-zA-ZÀ-ÿ'- ]/", $restaurantName)){
	$text = '<div class="alert alert-danger" role="alert">The restaurant name contains invalid characters!</div>';
	goto sendAnswer;
}
if(strlen($restaurantName) > 30){
	$text = '<div class="alert alert-danger" role="alert">The restaurant name must not exceed 30 characters!</div>';
	goto sendAnswer;
}


$dbh = new PDO('sqlite:../database.db');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $dbh->prepare('SELECT restaurantName FROM restaurants WHERE restaurantName = ?');
$stmt->execute(array($restaurantName));
$result = $stmt->fetch();

if($result['restaurantName']){
	$text = '<div class="alert alert-danger" role="alert">There is already a restaurant with that name!</div>';
}
else{
	$stmt = $dbh->prepare('INSERT INTO restaurants(restaurantName,idOwner) VALUES(?,?)');
	$stmt->execute(array($restaurantName, $userId));

	$stmt = $dbh->prepare('SELECT idRestaurant FROM restaurants WHERE restaurantName = ?');
	$stmt->execute(array($restaurantName));
	$result = $stmt->fetch();
	$restaurantId = $result['idRestaurant'];

	$text = '<div class="alert alert-success" role="alert">Restaurant was successfully created.<br><a href="../restaurant/';
	$text .= $restaurantId;
	$text .= '">Click here to edit the restaurant details.</a></div>';

	$success = true;
}


sendAnswer:

$dataBack = array('text' => $text, 'success' => $success);

$dataBack = json_encode($dataBack);
echo $dataBack;

?>
