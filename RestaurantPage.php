<!DOCTYPE html>
<html>
	<?php 
	//TODO use get/post to pass the name/id of the restaurant
	//Opens database
		$dbh = new PDO('sqlite:database.db');
		$username = "Joao";
	//Gets the user
		$stmt = $dbh->prepare('SELECT * FROM users WHERE username = ?');
		$stmt->execute(array($username));
		$selectedUser = $stmt->fetch();
	//Gets the restaurant
		$stmt = $dbh->prepare('SELECT * FROM restaurants WHERE idOwner = ?');
		$stmt->execute(array($selectedUser['idUser']));
		$selectedRestaurant = $stmt->fetch();
		
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
	</body>
</html>