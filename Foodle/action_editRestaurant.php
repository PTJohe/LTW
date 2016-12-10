<?php
//Get post variables from ajax call
$idRestaurant = $_POST['idRestaurant'];
$parameter = $_POST['parameter'];
$value = $_POST['value'];

include_once('database/connection.php'); //Opens database
include_once('database/update_restaurant.php');


$result = updateRestaurant($idRestaurant, $parameter, $value);
if($result != 0)
{
	echo 'Invalid idRestaurant';
}

echo 'Success';
?>