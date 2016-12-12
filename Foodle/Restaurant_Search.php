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
	<script src="js/lib/jquery-1.11.3.min.js"></script>
	<script src="js/rangeValues.js"></script>
</head>

<body>
	<header>

		<?php include 'header.php' ?>
	</header>
	<div id="Login">



		<h1>Restaurants:
			<div id=resultRating>	<?php include ('search.php') ?></div>
		</h1>
	</div>
<form>
		<form action="" method="post">
			<p>Rating >
			<span id="slider_value"></span>
		</p>
	<input type="range" id="slider" value="2.5" min="0.0" max="5.0" step="0.1" oninput="getRanges(this.value)" onchange="getRanges(this.values)" />

	<br />

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
