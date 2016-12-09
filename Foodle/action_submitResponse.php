<?php
//Get post variables from ajax call
$idReview = $_POST['idReview'];
$username = $_POST['username'];
$text = $_POST['text'];

include_once('database/connection.php'); //Opens database
include_once('database/insert_response.php');


$result = insertResponse($idReview, $username, $text);
$fullname = 'None';
if($result == 0)
{
	$stmt = $dbh->prepare('SELECT name FROM users WHERE username = ?');
	$stmt->execute(array($username));
	$fullname = $stmt->fetch()[0];
}
$resultStringsArray = array($fullname, 'Text empty', 'Invalid User', 'Invalid Review');


echo $resultStringsArray[$result];
?>