<!DOCTYPE html>
<html lang="en">
<?php
	//Opens database
		$dbh = new PDO('sqlite:database.db');
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //To enable error handling
		$inputUsername = $_GET['username'];
		
	//Gets the restaurant
		$stmt = $dbh->prepare('SELECT * FROM users WHERE username = ?');
		$stmt->execute(array($inputUsername));
		$selectedUser = $stmt->fetch();	
		if($selectedUser == null) //In case of a non-existing name
		{
			header('Location: ErrorRestaurantPage.php');
		}
		
	//Gets the reviews
		$stmt = $dbh->prepare('SELECT * FROM reviews WHERE idUser = ?');
		$stmt->execute(array($selectedUser['idUser']));
		$userReviews = $stmt->fetchAll();
		
	//Get the infos needed
		$userId = $selectedUser['idUser'];
		$userName = $selectedUser['name'];
		$userPhoto = $selectedUser['photoFileName'];
	?>
<head>
	<title>Profile/<?=$username?></title>
	<meta charset="utf-8">
	<style>
		td,th{border:1px solid black}
		table{border-collapse: collapse}
	</style>
</head>
<body>
	<header>
		<h1>Profile <?=$userName?></h1>
		<nav>
			<ul>
				<li><a href="logout.php">Logout</a></li>
				<li><a href="reviews.php">All Reviews</a></li>
				<li><a href="photos.php">Photos Submitted</a></li>
			</ul>
		</nav>
	</header>
	<div id="main">
		<section id="personalData">
			<h2>Personal Data</h2>
			<img src="photo.png" alt="Photo" width="300" height="200"><br>
			<label>João Araújo</label>
		</section>
		<section id="reviews">
			<h2>Latest Reviews</h2>
			<article>
				<h3>Restaurant 1</h3>
				<img src="img.png" alt="Image" width="300" height="200">
				<p>Rating: 5/5</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non nisl et nisi faucibus congue id a magna. Donec sed diam non justo blandit venenatis. Nunc vestibulum aliquam sem vitae dignissim. Integer cursus lacus ut lectus varius, a imperdiet est blandit. Mauris iaculis ac erat id sodales. Fusce venenatis eu dui a hendrerit. Aliquam malesuada pretium neque et mollis.</p>
				<footer>
					<p>Date: 2016-09-29</p>
					<p>Comments: 10</p>
				</footer>
			</article>
			<article>
				<h3>Restaurant 2</h3>
				<img src="img.png" alt="Image" width="300" height="200">
				<p>Rating: 3/5</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non nisl et nisi faucibus congue id a magna. Donec sed diam non justo blandit venenatis. Nunc vestibulum aliquam sem vitae dignissim. Integer cursus lacus ut lectus varius, a imperdiet est blandit. Mauris iaculis ac erat id sodales. Fusce venenatis eu dui a hendrerit. Aliquam malesuada pretium neque et mollis.</p>  
				<footer>
					<p>Date: 2016-09-29</p>
					<p>Comments: 5</p>
				</footer>
			</article>
		</section>

	</div>
	<footer>
		<!--<p>Copyright: Restaurants 2016</p>-->
	</footer>
</body>
</html>