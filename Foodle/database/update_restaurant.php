<?php
function updateRestaurant($id, $column, $value){

global $dbh;

$stmt = $dbh->prepare('SELECT * FROM restaurants WHERE idRestaurant = ?');
$stmt->execute(array($id));
$validId = $stmt->fetch()['idRestaurant'];

if($validId == null || $validId == "")
{
	return 1; //Invalid ID
}

$stmt = $dbh->prepare('UPDATE restaurant SET ? = ? WHERE idRestaurant = ?');
$stmt->execute(array($column, $value, $id));
return 0;
}
 ?>
