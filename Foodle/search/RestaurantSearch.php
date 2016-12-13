<!DOCTYPE html>
<html lang="en">
<head>
	<title>Search Restaurants</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/RestaurantSearch.css">
	<script src="../js/lib/jquery-1.11.3.min.js"></script>
	<script src="../js/lib/jquery.form.js"></script>
	<script src="../js/advancedSearch.js"></script>
</head>

<body>
	<header>
		<?php include '../header.php' ?>
	</header>

	<div id="advancedSearch">&#9906 Filters
		<form id="filterForm" method="post" action="" >
			<div id="sortFilter">
				&#9504 Sort
				<p id="sortFilterInput">
					<input type="radio" name="sort" value="name" checked>By Name<br>
					<input type="radio" name="sort" value="rating">By Rating<br>
				</p>
			</div>
			<div id="ratingFilter">
				&#9504 Rating
				<p id="ratingFilterInput"> 
					<input type="range" name="minRating" id="slider" value="0" min="0.0" max="5.0" step="0.1" />
					> <span id="slider_value">0</span>
				</p>
			</div>
			<div id="categoryFilter">
				&#9504 Category
				<p id="categoryFilterInput">
					<input type="checkbox" name="category1">Bar<br>
					<input type="checkbox" name="category2">Café<br>
					<input type="checkbox" name="category3">Restaurante<br>
					<input type="checkbox" name="category4">Tasco
				</p>
			</div>
			<br>
			<button type="submit" id="applyFilter">Apply</button>
		</form>
	</div>


	<h1>Restaurants:</h1>
	<div id="searchResults"><?php include 'normalSearch.php'; ?></div>

</body>
</html>