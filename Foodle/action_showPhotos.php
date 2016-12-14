<?php
//Get post variables from ajax call
$idRestaurant = $_POST['idRestaurant'];

include 'database/connection.php'; //Opens database
include_once('database/get_photos.php');

$photosList = get_photos($idRestaurant);
echo json_encode($photosList);
?>