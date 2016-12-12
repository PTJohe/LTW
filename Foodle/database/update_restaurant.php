<?php

function updateRestaurant($id, $column, $value){

	global $dbh;

	$stmt = $dbh->prepare('SELECT * FROM restaurants WHERE idRestaurant = ?');
	$stmt->execute(array($id));
	$validId = $stmt->fetch()['idRestaurant'];

	if($validId == null || $validId == ""){
		//Invalid ID	
		return 1; 
	}

	$stmt = $dbh->prepare('UPDATE restaurant SET ? = ? WHERE idRestaurant = ?');
	$stmt->execute(array($column, $value, $id));
	
	// 0 = Successful
	return 0;
}

?>
