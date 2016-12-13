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
		<h3>Top of the Week</h3>
		<img src="topSemana.jpg" alt="Image" style="width:104px;height:58px;">
		<?php include 'topWeek.php' ?>
		<h3> New Restaurants </h3>
		<p><img src="./resources/restaurantCur.jpg" alt="Image" style="width:104px;height:58px;"></p>
		<?php include 'news.php' ?>
	</div>
</body>

</html>
