<?php
include '../resources/resources.php';

session_start();

//Opens database
$dbh = new PDO('sqlite:../database.db');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //To enable error handling
$inputUsername = $_GET['username'];

//Gets the user
$stmt = $dbh->prepare('SELECT * FROM users WHERE username = ?');
$stmt->execute(array($inputUsername));
$selectedUser = $stmt->fetch();	
if($selectedUser == null){ //In case of a non-existing name
	header('Location: ../Error404.php?info=1');
}

//Gets the reviews
$stmt = $dbh->prepare('SELECT * FROM reviews WHERE idUser = ?');
$stmt->execute(array($selectedUser['idUser']));
$userReviews = $stmt->fetchAll();

//Gets the photos
$stmt = $dbh->prepare('SELECT * FROM photos WHERE idUser = ?');
$stmt->execute(array($selectedUser['idUser']));
$userSubmittedPhotos = $stmt->fetchAll();

//Get the infos needed
$userId = $selectedUser['idUser'];
$userName = $selectedUser['name'];
$userPhoto = getProfilePicturePath($userId);

$maxLatestReviews = 2;
$maxLatestPhotos = 2;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title><?=$inputUsername?></title>
	<meta charset="utf-8">
</head>
<body>
	<header>
		<?php include '../header.php' ?>
	</header>
	<h1><?=$inputUsername?></h1>
	<div id="main">
		<section id="personalData">
			<h2>Personal Data</h2>
			<img src=<?=$userPhoto?> alt="Photo" width="250" height="250"><br>
			<p><?=$userName?></p>
		</section>
		<section id="reviews">
			<h2>Latest Reviews</h2>
			<?php 
			if(count($userReviews) == 0){	
				?><p>This user hasn't written a review yet.</p><?php 
			} else { 
				for($i = 0; $i < count($userReviews); $i++){ 		
				//Limit number of 'Latest Reviews'
					if($i >= $maxLatestReviews)
						break;			

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
					<?php 
				} ?>
				<a href="<?php echo $inputUsername ?>/allReviews/1">View All (<?=count($userReviews)?>)</a> 
				<?php 
			} ?>
		</section>
		<section id="photos">
			<h2>Latest Photos</h2>
			<?php 
			if(count($userSubmittedPhotos) == 0){	
				?>
				<p>This user hasn't submitted a photo yet.</p>
				<?php 
			} else { for($i = 0; $i < count($userSubmittedPhotos); $i++){
					//Limit number of 'Latest Photos'
				if($i >= $maxLatestPhotos)
					break;

					//Gets the restaurant name
				$stmt = $dbh->prepare('SELECT * FROM restaurants WHERE idRestaurant = ?');
				$stmt->execute(array($userSubmittedPhotos[$i]['idRestaurant']));
				$selectedRestaurant = $stmt->fetch();
				$restaurantName = $selectedRestaurant['restaurantName'];

				$restaurantPhoto = getRestaurantPhotoPath($userSubmittedPhotos[$i]['idPhoto']);
				$uploadDate = $userSubmittedPhotos[$i]['uploadDate'];
				?>

				<article>
					<h3><?=$restaurantName?></h3>
					<img src=<?=$restaurantPhoto?> alt=<?=$restaurantPhoto?> width="300" height="200">
					<p>Submitted on <?=$uploadDate?></p>
				</article>
				<?php 
			} ?>
			<a href="<?php echo $inputUsername ?>/allPhotos/1">View All (<?=count($userSubmittedPhotos)?>)</a> 
			<?php 
		} ?>
	</section>
</div>
</body>
</html>