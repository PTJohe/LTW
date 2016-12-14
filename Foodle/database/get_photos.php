<?php

function get_photos($idRestaurant){
	global $dbh;
	$stmt = $dbh->prepare('SELECT idPhoto FROM photos WHERE idRestaurant = ?');
	$stmt->execute(array($idRestaurant));
	if($stmt == false)
	{
		//Error
		return -1;
	}
	$photosList = $stmt->fetchAll();
	return $photosList;
}

?>
