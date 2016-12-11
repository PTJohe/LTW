<?php

include_once '../Utilities.php';

$acceptedExtension = Array('image/jpeg', 'image/jpg', 'image/png'); // Accepted extensions
$maxSize = 512*KB;
$destFolder = '../resources/profilePictures/'; // We upload the image here

$imgType = $_FILES["imageProfile"]["type"];
$imgSize = $_FILES["imageProfile"]["size"];
$imgName = $_FILES["imageProfile"]["name"];
$imgTmpName = $_FILES["imageProfile"]["tmp_name"];
list($txt, $ext) = explode("image/", $imgType); // Get image extension
 
if (in_array($imgType, $acceptedExtension) && $imgSize <= $maxSize && $imgSize != "") { // Test is extension allowed and image size ok
 
	$newThumbImageName = ''.$_POST['userId'].'.png'; // We rename the image (in our example it will be $userId.png)
 
	if(move_uploaded_file($imgTmpName,$destFolder.$newThumbImageName)) { // Upload image
		
		$text = '<p class="myImage"><img src="../resources/profilePictures/'.$newThumbImageName.'" width="100" alt="" /></p>'; // Send back the image...
		$text .= '<div class="alert alert-success" role="alert">Image profile uploaded successfully.</div>'; //...and a successfull text
		
		$dataBack = array('text' => $text, 'imgURL' => '../resources/profilePictures/'.$newThumbImageName); // Also send back the image URL
	}
 
} else {
	if (!in_array($imgType, $acceptedExtension)) $text = '<div class="alert alert-danger" role="alert">Wrong format! Formats accepted: jpeg, jpg, png.</div>';
	if ($imgSize > $maxSize) $text = '<div class="alert alert-danger" role="alert">Image too heavy. Maximum 512 Kb.</div>';
	if ($imgSize == "") $text = '<div class="alert alert-danger" role="alert">Please choose an image!</div>';
	
	$dataBack = array('text' => $text);
}
 
$dataBack = json_encode($dataBack);
echo $dataBack;
?>