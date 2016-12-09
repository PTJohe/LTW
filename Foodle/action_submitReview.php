<?php
//Get post variables from ajax call
$idRestaurant = $_POST['idRestaurant'];
$username = $_POST['username'];
$text = $_POST['text'];
$rating = $_POST['rating'];

include_once('database/connection.php'); //Opens database
include_once('database/insert_review.php');


$result = insertReview($idRestaurant, $username, $text, $rating);
$fullname = 'None';
if($result == 0)
{
	$stmt = $dbh->prepare('SELECT name FROM users WHERE username = ?');
	$stmt->execute(array($username));
	$fullname = $stmt->fetch()[0];
}
$resultStringsArray = array($fullname, 'Text/Rating empty', 'Invalid User', 'Invalid Restaurant');


echo $resultStringsArray[$result];
?>