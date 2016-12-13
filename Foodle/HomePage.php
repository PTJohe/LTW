<?php
session_start();

include_once('database/get_restaurants.php');
include_once('database/connection.php') ;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/HomePage.css">
	<script src="js/lib/jquery-1.11.3.min.js"></script>
	<script src="js/setLiveSearch.js"></script>
</head>

<body>
	<header>
		<?php include 'header.php' ?>
	</header>

	<div id="SearchBar">
		<form  class="form-search" role = "form" action = "search/" method="post">
			<p class="Search">
				<input id="liveSearch" type="text" name="search" placeholder="Search Restaurants by name, location,food,menu" onkeyup="getStates(this.value)">
				<button type="submit" name="searchBtn">Search</button>
				<div id="results"></div>
			</p>
		</form>
	</div>
	<div id="Colecoes">
		<h2>Curiosities</h2>
		<p>
			<h3>Top of the Week</h3>
			<img src="resources/topWeek.png" alt="Image" height = "100" width = "100">
			<?php include 'topWeek.php' ?>
		</p>
		<p>
			<h3> New Restaurants </h3>
			<img src="resources/newRestaurants.png" alt="Image" height = "100" width = "100">
			<?php include 'newRestaurants.php' ?>
		</p>
	</div>
</body>

</html>
