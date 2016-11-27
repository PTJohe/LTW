<!DOCTYPE html>
<html>
	<?php
	//Opens database
		$dbh = new PDO('sqlite:database.db');
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //To enable error handling
		$inputRestaurantName = $_POST['restaurantName'];
		
	//Gets the restaurant
		$stmt = $dbh->prepare('SELECT * FROM restaurants WHERE restaurantName = ?');
		$stmt->execute(array($inputRestaurantName));
		$selectedRestaurant = $stmt->fetch();	
		if($selectedRestaurant == null) //In case of a non-existing name
		{
			header('Location: ErrorRestaurantPage.php');
		}
		
	//Gets the reviews
		$stmt = $dbh->prepare('SELECT * FROM reviews WHERE idRestaurant = ?');
		$stmt->execute(array($selectedRestaurant['idRestaurant']));
		$restaurantReviews = $stmt->fetchAll();
		
	//Get the infos needed
		$restaurantName = $selectedRestaurant['restaurantName'];
		$restaurantLogo = $selectedRestaurant['logoFileName'];
		$restaurantAddress = $selectedRestaurant['address'];
		$restaurantContact = $selectedRestaurant['contact'];
		$restaurantAverageRating = $selectedRestaurant['averageRating'];
	?>
	<head>
		<title><?=$restaurantName?></title>
	</head>
	
	<body>
		<div>
			<img src=<?=$restaurantLogo?> alt=<?=$restaurantName?> width="300" height="100">
		</div>
		<div>
			<h2><?=$restaurantName?></h2>
			
			<p>Address: <?=$restaurantAddress?></p>
			<p>Number: <?=$restaurantContact?></p>
			<p>Rating: <?=$restaurantAverageRating?> / 5 </p>
		</div>
		
		<div>
			<ul>
				<?php for($i = 0; $i < count($restaurantReviews); $i++) //WTF???? COM <?php funciona, sem o "php" ja nao funciona, e o contrário para as de baixo
				{ ?>
				<p>Rating: <?=$restaurantReviews[$i]['rating']?></p>
				<li>
					<?=$restaurantReviews[$i]['text']?>
					<ul>
						<?php 
						$stmt = $dbh->prepare('SELECT * FROM responses WHERE idReview = ?');
						$stmt->execute(array($restaurantReviews[$i]['idReview']));
						$responses = $stmt->fetchAll();
						for($j = 0; $j < count($responses); $j++)
						{
						?>
						<li>
							<?=$responses[$j]['text']?>
						</li>
						<?php } ?>
					</ul>
				</li>
				<?php } ?>
			</ul>
		</div>
	</body>
</html>