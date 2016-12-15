<?php

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

//Gets the restaurants
$stmt = $dbh->prepare('SELECT * FROM restaurants WHERE idOwner = ?');
$stmt->execute(array($selectedUser['idUser']));
$ownedRestaurants = $stmt->fetchAll();

$inputPage = $_GET['page'];

$maxResultsPerPage = 3;
$offset = ($inputPage - 1 ) * $maxResultsPerPage;
$totalPages = ceil(count($ownedRestaurants) / $maxResultsPerPage);

if(count($ownedRestaurants != 0) && $inputPage != 1){
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
	<link rel="stylesheet" href="../../../css/profile/viewAll.css">
</head>
<body>
	<header>
		<?php include '../header.php' ?>
	</header>
	<div id="main">
		<div id="personalData">
			<article>
				<h1>All Owned Restaurants</h1>
			</article>
		</div>
		<section id="ownedRestaurants">
			<div id="allResults">
				<?php 
				if(count($ownedRestaurants) == 0){	
					?><p>This user doesn't own any restaurant.</p><?php 
				} else { 
					for($i = $offset; $i < count($ownedRestaurants); $i++){ 
					//Limit number of Results Per Page
						if($i >= $offset + $maxResultsPerPage)
							break;			

						$restaurantId = $ownedRestaurants[$i]['idRestaurant'];
						$restaurantName = $ownedRestaurants[$i]['restaurantName'];
						$restaurantLogo = getRestaurantLogoPath($restaurantId);
						$restaurantRating = $ownedRestaurants[$i]['averageRating'];
						$restaurantCategory = $ownedRestaurants[$i]['category'];
						?>

						<article>
							<a href="../../../restaurant/<?php echo $restaurantId ?>">
								<h3><?=$restaurantName?></h3>
								<img src=<?=$restaurantLogo?> alt=<?=$restaurantName?> width="200" height="100">
							</a>
							<p><b>Rating:</b> <?=$restaurantRating?></p>
							<p><b>Category:</b> <?=$restaurantCategory?></p>
						</article>
						<?php 
					}
					?>
				</div>
				<div id="pageButtons">
					<?php
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
				</div>
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