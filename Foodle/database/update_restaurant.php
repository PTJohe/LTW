<?php

function updateRestaurant($id, $column, $value){
	print_r('updating restaurant ');
	global $dbh;
	print_r($id . ' ');
	$stmt = $dbh->prepare('SELECT * FROM restaurants WHERE idRestaurant = ?');
	$stmt->execute(array($id));
	$result = $stmt->fetch();
	$validId = $result['idRestaurant'];
	$originalValue = $result[$column];
	print_r($originalValue . ' ');
	print_r($value . ' ');
	if($originalValue == $value)
	{
		print_r("No change");
		return 0;
	}
	print_r('ID = ' . $validId);
	if($validId == null || $validId == ""){
		//Invalid ID	
		return 1; 
	}
	
	//Prepares the update (columns can't be substituted on ?)
	switch($column)
	{
		case 'restaurantName':
			$stmt = $dbh->prepare('UPDATE restaurants SET restaurantName = ? WHERE idRestaurant = ?');
			break;
		case 'address':
			$stmt = $dbh->prepare('UPDATE restaurants SET address = ? WHERE idRestaurant = ?');
			break;
		case 'contact':
			$stmt = $dbh->prepare('UPDATE restaurants SET contact = ? WHERE idRestaurant = ?');
			break;
		case 'description':
			$stmt = $dbh->prepare('UPDATE restaurants SET description = ? WHERE idRestaurant = ?');
			break;
		case 'category':
			$stmt = $dbh->prepare('UPDATE restaurants SET category = ? WHERE idRestaurant = ?');
			break;
		default:
			break;
	}
	
	//If the query is prepared successfully
	if($stmt)
	{
		$success = $stmt->execute(array($value, $id));
	}

	if($success)
		print_r("Yes");
	else
		print_r("No");
	
	// 0 = Successful
	return 0;
}

?>
