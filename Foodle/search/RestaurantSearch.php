<!DOCTYPE html>
<html lang="en">
<head>
	<title>Search Restaurants</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/search/RestaurantSearch.css">	
	<script src="../js/lib/jquery-1.11.3.min.js"></script>
	<script src="../js/lib/jquery.form.js"></script>
	<script src="../js/search.js"></script>
</head>

<body>
	<header>
		<?php include '../header.php' ?>
	</header>
	<div id="main">
		<div id="titleSearch">
			<article>
				<h2>Search</h2>
			</article>
		</div>
		<div id="SearchBar">
			<form  class="form-search" role = "form" action = "" method="post">
				<input id="liveSearch" type="text" name="search" placeholder="Search for Restaurants in your area." autocomplete="off">
				<button type="submit" name="searchBtn" id="searchButton" >Search</button>
			</form>
		</div>

		<div id="advancedSearch">
			&#9906 Filters
			<div id="Filters">
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
		</div>
		<section>
			<div id="Restaurants">
				<div id="searchResults"></div>
			</div>
		</section>
	</div>

	<footer>
		<?php include '../footer.php' ?>
	</footer>
</body>
</html>