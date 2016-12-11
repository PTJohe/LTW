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
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
function getStates(value){
	if(value.length==0){
		$("#results").html("");
		return;
	}
	$.post("livesearch.php",{partialState:value},function(data){
	$("#results").html(data);
});
}

</script>
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
				<input type="text" name="search" placeholder="Search Restaurants by name, location,food,menu" onkeyup="getStates(this.value)">
				<button type="submit" name="searchBtn">Search</button>
				<div id="results">
				</div>
				<p><a href=<?php echo $navPath."restaurant/"?>></a></p>
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
