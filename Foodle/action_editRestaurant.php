<?php

//Get post variables from ajax call
$idRestaurant = $_POST['idRestaurant'];
$name = $_POST['name'];
$address = $_POST['address'];
$number = $_POST['number'];
$description = $_POST['description'];
$category = $_POST['category'];

include 'database/connection.php'; //Opens database
include_once('database/update_restaurant.php');

$result = updateRestaurant($idRestaurant, "restaurantName", $name);
if($result != 0)
{
	echo 'Invalid Restaurant';
}

$result = updateRestaurant($idRestaurant, "address", $address);
if($result != 0)
{
	echo 'Invalid address';
}

$result = updateRestaurant($idRestaurant, "contact", $number);
if($result != 0)
{
	echo 'Invalid number';
}

$result = updateRestaurant($idRestaurant, "description", $description);
if($result != 0)
{
	echo 'Invalid description';
}

$result = updateRestaurant($idRestaurant, "category", $category);
if($result != 0)
{
	echo 'Invalid category';
}

echo 'Success';
?>