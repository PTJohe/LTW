<?php

include '../resources/resources.php';

//Opens database
$dbh = new PDO('sqlite:../database.db');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //To enable error handling
$inputUsername = $_GET['username'];

//Gets the user
$stmt = $dbh->prepare('SELECT * FROM users WHERE username = ?');
$stmt->execute(array($inputUsername));
$selectedUser = $stmt->fetch();	
if($selectedUser == null){ //In case of a non-existing name
	header('Location: ../../../Error404.php?info=1');
}

//Gets the photos
$stmt = $dbh->prepare('SELECT * FROM photos WHERE idUser = ?');
$stmt->execute(array($selectedUser['idUser']));
$userSubmittedPhotos = $stmt->fetchAll();

$inputPage = $_GET['page'];

$maxResultsPerPage = 2;
$offset = ($inputPage - 1 ) * $maxResultsPerPage;
$totalPages = ceil(count($userSubmittedPhotos) / $maxResultsPerPage);

if(count($userSubmittedPhotos != 0) && $inputPage != 1){
	if($inputPage < 1 || $inputPage > $totalPages)
	{
		header('Location: ../../../Error404.php');
	}
}
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
		<section id="photos">
			<?php
			if(count($userSubmittedPhotos) == 0){	
				?>
				<p>This user hasn't submitted a photo yet.</p>
				<?php 
			} else { 
				for($i = $offset; $i < count($userSubmittedPhotos); $i++){
					//Limit number of Results Per Page
					if($i >= $offset + $maxResultsPerPage)
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
				}
				if($inputPage > 1){
					?>
					<a href="<?php echo $inputPage - 1?>">Previous</a> 
					<?php 
				}
				if($inputPage < $totalPages){
					?>
					<a href="<?php echo $inputPage + 1?>">Next</a> 
					<?php 
				} 
				?>
				<p>Page <?=$inputPage?> of <?=$totalPages?></p>
				<?php 
			} ?>
		</section>
	</div>
	
	<footer>
		<?php include '../footer.php' ?>
	</footer>
</body>
</html>