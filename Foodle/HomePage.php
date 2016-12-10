<?php
session_start();
?>
<!DOCTYPE html>
<html>
<?php include_once('database/get_restaurants.php');
			include_once('database/connection.php') ;
			?>
<head>
	<title>Home</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="HomePage.css">
</head>

<body>
	<header>
		<?php include 'header.php' ?>
		<nav>
			<?php include 'nav.php' ?>
		</nav>
	</header>

	<div id="SearchBar">
		<form  class="form-search" role = "form" action = "Restaurant_Search.php" method="post">
			<p class="Search">
				<input type="text" name="search" placeholder="Search Restaurants by name, location,food,menu">
				<button type="submit" name="searchBtn">Search</button>
			</p>
		</form>
	</div>
	<div id="Colecoes">
		<h2>Curiosities</h2>
		<img src="topSemana.jpg" alt="Image" style="width:104px;height:58px;">
		<p>
			<?php bestRestaurantsLastWeek(); ?>
		 </p>
		<p><img src="./resources/restaurantCur.jpg" alt="Image" style="width:104px;height:58px;">News</p>
	</div>
</body>

</html>
