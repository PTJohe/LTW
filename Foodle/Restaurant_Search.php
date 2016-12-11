<?php
session_start();

include_once('database/connection.php');
include_once('database/get_restaurants.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Restaurant_Search</title>
	<meta charset="utf-8">
	<link rel="stylesheet">
</head>

<body>
	<header>

		<?php include 'header.php' ?>
	</header>
	<div id="Login">

		<?php
		if(isRestaurant($_POST['search'])){
			$_SESSION['idRestaurant'] = getRestaurantId($_POST['search']);
			$_SESSION['restaurantName'] = getRestaurantName($_SESSION['idRestaurant']);
		} else {
			$_SESSION['idRestaurant'] = "";
			$_SESSION['restaurantName'] = "";
		}
		?>

		<h1>Restaurants:
			<?php include('search.php'); ?>
		</h1>
	</div>

	<form action="HomePage.php">
		<button type="submit" name="back">Go Back</button>
	</form>
</body>

</html>
