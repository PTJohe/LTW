<?php

$resourcesPath = "https://gnomo.fe.up.pt/~up201303962/Foodle/resources/";

function getProfilePicturePath($userId){
    global $resourcesPath;
	$imagePath = $resourcesPath."profilePictures/".$userId.".png";
	$file_headers = @get_headers($imagePath);
	if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found')
		return $resourcesPath."profilePictures/default.png";
	else return $imagePath;
}

function getRestaurantLogoPath($restaurantId){
    global $resourcesPath;
	$imagePath = $resourcesPath."restaurantLogos/".$restaurantId.".png";
	$file_headers = @get_headers($imagePath);
	if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found')
		return $resourcesPath."restaurantLogos/default.png";
	else return $imagePath;
}

function getRestaurantPhotoPath($photoId){
    global $resourcesPath;
	$imagePath = $resourcesPath."restaurantPhotos/".$photoId.".png";
	$file_headers = @get_headers($imagePath);
	if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found')
		return $resourcesPath."restaurantPhotos/default.png";
	else return $imagePath;
}
?>