<?php
	include '../resources/resources.php';

	//Opens database
	$dbh = new PDO('sqlite:../database.db');
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //To enable error handling
	$inputUsername = $_GET['username'];

	//Gets the restaurant
	$stmt = $dbh->prepare('SELECT * FROM users WHERE username = ?');
	$stmt->execute(array($inputUsername));
	$selectedUser = $stmt->fetch();	
	if($selectedUser == null){ //In case of a non-existing name
		header('Location: 404.php');
	}

	//Gets the reviews
	$stmt = $dbh->prepare('SELECT * FROM reviews WHERE idUser = ?');
	$stmt->execute(array($selectedUser['idUser']));
	$userReviews = $stmt->fetchAll();


	//Get the infos needed
	$userId = $selectedUser['idUser'];
	$userName = $selectedUser['name'];
	$userPhoto = getProfilePicturePath($userId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title><?=$inputUsername?></title>
	<meta charset="utf-8">
	<style>
		td,th{border:1px solid black}
		table{border-collapse: collapse}
	</style>
</head>
<body>
	<header>
		<h1><?=$inputUsername?></h1>
		<nav>
			<!--Links-->
		</nav>
	</header>
	<div id="main">
		<section id="personalData">
			<h2>Personal Data</h2>
			<img src=<?=$userPhoto?> alt="Photo" width="200" height="200"><br>
			<label><?=$userName?></label>
		</section>
		<section id="reviews">
			<h2>Latest Reviews</h2>
			<?php if(count($userReviews) == 0){	?>
			<p>This user hasn't written a review yet.</p> 
			<?php } 
			else {
				for($i = 0; $i < count($userReviews); $i++){ 		
				//Limit 'Latest Reviews' to two reviews
					if($i > 1){
						break;			
					}
				//Gets the restaurant
					$stmt = $dbh->prepare('SELECT * FROM restaurants WHERE idRestaurant = ?');
					$stmt->execute(array($userReviews[$i]['idRestaurant']));
					$selectedRestaurant = $stmt->fetch();

					$restaurantId = $selectedRestaurant['idRestaurant'];
					$restaurantName = $selectedRestaurant['restaurantName'];
					$restaurantLogo = getRestaurantLogoPath($restaurantId);
					?>

					<article>
						<h3><?=$restaurantName?></h3>
						<img src=<?=$restaurantLogo?> alt=<?=$restaurantName?> width="200" height="100">
						<p>Rating: <?=$userReviews[$i]['rating']?></p>
						<p><?=$userReviews[$i]['text']?></p>
					</article>
					<?php } ?>
					<a href="allReviews.php">View All (<?=count($userReviews)?>)</a> 
					<?php } ?>
				</section>
				<section id="photos">
					<h2>Latest Photos</h2>
					<p>This user hasn't submitted a photo yet.</p>
				</section>
			</div>
		</body>
		</html>