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
	<script src="js/setSearchRatings.js"></script>
</head>

<body>
	<header>

		<?php include 'header.php' ?>
	</header>
	<div id="Login">



		<h1>Restaurants:
				<?php include 'search.php' ?>
			<div id=#resultRating></div>
		</h1>
	</div>
<form>
	<p>Rating<p>
		<form action="" method="POST">
	<input type="range" name="rating" id="rating"  min="0" max="5" step="1"  oninput="getRatings(this.value)" onchange="getRatings(this.value)"/>
		</form>

	<p>Category<p>
		<div id="categoria">
<input type="checkbox" iname="category" value="Categoria1">Categoria1<br>
<input type="checkbox" name="category" value="Categoria2">Categoria2<br>
<input type="checkbox" name="category" value="Categoria3">Categoria3<br>
<input type="checkbox" name="category" value="Categoria4">Categoria4<br>
		</div>
</form>
	<form action="HomePage.php">
		<button type="submit" name="back">Go Back</button>
	</form>
</body>

</html>
