<?php
session_start();

include_once('database/get_restaurants.php');
include_once('database/connection.php') ;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Foodle</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/HomePage.css">
	<script src="js/lib/jquery-1.11.3.min.js"></script>
	<script src="js/setLiveSearch.js"></script>
	<script src="js/homePage.js"></script>
</head>

<body>
	<header>
		<?php include 'header.php' ?>
		<div id="SearchBar">
			<form  class="form-search" role = "form" action = "search/" method="post">
				<input id="liveSearch" type="text" name="search" placeholder="Search for Restaurants in your area." autocomplete="off" onkeyup="getStates(this.value)">
				<button type="submit" name="searchBtn">Search</button>
				<div id="results"></div>
			</form>
		</div>
	</header>
	<div id="main">
		<div id="welcomeToFoodle">
			<h1>Welcome to </h1><h1 id="foodle">foodle</h1><h1>!</h1>
		</div>
		<div id="collections">
			<h2>Collections</h2>
			<div class="collection" id="topWeek">
				<h3>Top of the Week</h3>
				<img src="resources/topWeek.png" alt="Image" height = "200" width = "250">
				<div class="collectionResults"><?php include 'topWeek.php' ?></div>
			</div>
			<div class="collection" id="newRestaurants">
				<h3> New Restaurants </h3>
				<img src="resources/newRestaurants.png" alt="Image" height = "200" width = "250">
				<div class="collectionResults"><?php include 'newRestaurants.php' ?></div>
			</div>
		</div>
	</div>
	<footer>
		<h2>Linguagens e Tecnologias Web 2016</h2>
		<h3><pre>Francisco Barbosa      João Araújo      José Carlos Coutinho</pre></h3>
	</footer>
</body>

</html>
