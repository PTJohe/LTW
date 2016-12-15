<?php

include_once '../Utilities.php';

$idUser = $_POST['idUser'];
$idRestaurant = $_POST['idRestaurant'];

$acceptedExtension = Array('image/jpeg', 'image/jpg', 'image/png'); // Accepted extensions
$maxSize = 512*KB;
$destFolder = '../resources/restaurantPhotos/'; // We upload the image here

$imgType = $_FILES["uploadedPhoto"]["type"];
$imgSize = $_FILES["uploadedPhoto"]["size"];
$imgName = $_FILES["uploadedPhoto"]["name"];
$imgTmpName = $_FILES["uploadedPhoto"]["tmp_name"];
list($txt, $ext) = explode("image/", $imgType); // Get image extension

$uploadState = false;

if (in_array($imgType, $acceptedExtension) && $imgSize <= $maxSize && $imgSize != "") { // Test is extension allowed and image size ok

	$dbh=new PDO('sqlite:../database.db');
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$stmt = $dbh->prepare("INSERT INTO photos (idRestaurant, idUser) VALUES (?,?)");
	$stmt->execute(array($idRestaurant, $idUser));

	$stmt = $dbh->prepare("SELECT idPhoto FROM photos ORDER BY idPhoto DESC LIMIT 1");
	$stmt->execute();
	$idPhoto = $stmt->fetch()[0];
	
	$newThumbImageName = $idPhoto . ".png";

	if(move_uploaded_file($imgTmpName,$destFolder.$newThumbImageName)) { // Upload image
		$uploadState = true;
		$text .= '<div class="alert alert-success" role="alert">Restaurant photo successfully uploaded.</div>';
		$dataBack = array('text' => $text, 'uploadState' => $uploadState);
	}
} else {
	if (!in_array($imgType, $acceptedExtension)) $text = '<div class="alert alert-danger" role="alert">Wrong format! Formats accepted: jpeg, jpg, png.</div>';
	if ($imgSize > $maxSize) $text = '<div class="alert alert-danger" role="alert">Image too heavy. Maximum size is 512 Kb.</div>';
	if ($imgSize == "") $text = '<div class="alert alert-danger" role="alert">Please choose an image!</div>';
	
	$dataBack = array('text' => $text, 'uploadState' => $uploadState);

}

$dataBack = json_encode($dataBack);
echo $dataBack;
?>