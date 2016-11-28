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
		$restaurantDescription = $selectedRestaurant['description'];
		$restaurantCategory = $selectedRestaurant['category'];
	?>
	<head>
		<meta charset="UTF-8">
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
			<p><?=$restaurantDescription?></p>
			<p>Category: <?=$restaurantCategory?></p>
		</div>
		<br>
		<div>
			<ul id="reviews">
				<?php for($i = 0; $i < count($restaurantReviews); $i++) //WTF???? COM <?php funciona, sem o "php" ja nao funciona, e o contrário para as de baixo
				{ 
					//Gets the user who wrote the actual review
					$stmt = $dbh->prepare('SELECT * FROM users WHERE idUser = ?');
					$stmt->execute(array($restaurantReviews[$i]['idUser']));
					$reviewUser = $stmt->fetch();
					?>
					<p>Rating: <?=$restaurantReviews[$i]['rating']?></p>
					
					<p>Written by <?=$reviewUser['name'];?></p>
					<li>
						<?=$restaurantReviews[$i]['text']?>
						<ul>
							<?php 
							//Get the users who wrote the responses
							$stmt = $dbh->prepare('SELECT * FROM responses WHERE idReview = ?');
							$stmt->execute(array($restaurantReviews[$i]['idReview']));
							$responses = $stmt->fetchAll();
							for($j = 0; $j < count($responses); $j++)
							{
								$stmt = $dbh->prepare('SELECT * FROM users WHERE idUser = ?');
								$stmt->execute(array($responses[$j]['idUser']));
								$responseUser = $stmt->fetch();
							?>
								<p>Written by <?=$responseUser['name']?></p>
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