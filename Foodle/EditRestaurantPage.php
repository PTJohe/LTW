<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<?php
	
	include 'paths.php';
	include 'nav.php';
	//Get session parameters
		if(isset($_SESSION['username']))
		{
			$loggedUser = true;
			$username = $_SESSION['username'];
		}
		else
		{
			$loggedUser = false;
			$username = "anonymous";
		}
	//Opens database
	/*
	FOR DEBUGGING
		$loggedUser = true;
		$username = "Maxzelik";
	*/
		$dbh = new PDO('sqlite:database.db');
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //To enable error handling
		
	//Store restaurantName in session
		if(isset($_POST['restaurantName']))
		{
			$_SESSION['restaurantName'] = $_POST['restaurantName'];
		}
		$inputRestaurantName = $_SESSION['restaurantName'];
		
	//Gets the restaurant
		$stmt = $dbh->prepare('SELECT * FROM restaurants WHERE restaurantName = ?');
		$stmt->execute(array($inputRestaurantName));
		$selectedRestaurant = $stmt->fetch();	
		if($selectedRestaurant == null) //In case of a non-existing name
		{
			header('Location: Error404.php'); //TODO não se pode simplesmente mostrar ERROR 404 sem explicar a razão de erro.
		}
		
	//Gets the reviews
		$stmt = $dbh->prepare('SELECT * FROM reviews WHERE idRestaurant = ?');
		$stmt->execute(array($selectedRestaurant['idRestaurant']));
		$restaurantReviews = $stmt->fetchAll();
		
	//Get the owner
		$stmt = $dbh->prepare('SELECT username FROM users WHERE idUser = ?');
		$stmt->execute(array($selectedRestaurant['idOwner']));
		$restaurantOwner = $stmt->fetch()[0];
		
	//Get the infos needed
		$restaurantId = $selectedRestaurant['idRestaurant'];
		$restaurantName = $selectedRestaurant['restaurantName'];
		$restaurantLogo = $selectedRestaurant['logoFileName'];
		$restaurantAddress = $selectedRestaurant['address'];
		$restaurantContact = $selectedRestaurant['contact'];
		$restaurantAverageRating = $selectedRestaurant['averageRating'];
		$restaurantDescription = $selectedRestaurant['description'];
		$restaurantCategory = $selectedRestaurant['category'];
		$restaurantCreationDate = $selectedRestaurant['creationDate'];
	?>
	<head>
		<meta charset="UTF-8">
		<title><?=$restaurantName?></title>
		<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="writeComment.js"></script>
		<script src="editRestaurantInfo.js"></script>
	</head>
	
	<body>
		<div>
			<img src="<?=$resourcesPath?>restaurantLogos/<?=$restaurantId?>" alt=<?=$restaurantName?> width="300" height="100">
			<!-- TODO Upload Logo -->
		</div>
		<div>
			<div class="editable" id="restaurantname">
				<h2><?=$restaurantName?></h2>
				<input class="editButton" type="image" src="<?=$resourcesPath?>editIcon.png" alt="Edit" width="25" height="25">
				<input class="checkButton" type="hidden" src="<?=$resourcesPath?>checkEditIcon.png" alt="Check" width="25" height="25">
				<input class="cancelButton" type="hidden" src="<?=$resourcesPath?>cancelEditIcon.png" alt="Cancel" width="25" height="25">
			</div>
			<!-- TODO Confirm changes -->
			
			<p>Address: <?=$restaurantAddress?></p>
			<p>Number: <?=$restaurantContact?></p>
			<p>Rating: <?=$restaurantAverageRating?> / 5 </p>
			<p><?=$restaurantDescription?></p>
			<p>Category: <?=$restaurantCategory?></p>
			<p>Creation Date: <?=$restaurantCreationDate?></p>
		</div>
		<br>
		<div>
			<ul id="reviews">
				<?php for($i = 0; $i < count($restaurantReviews); $i++)
				{ 
					//Gets the user who wrote the actual review
					$stmt = $dbh->prepare('SELECT * FROM users WHERE idUser = ?');
					$stmt->execute(array($restaurantReviews[$i]['idUser']));
					$reviewUser = $stmt->fetch();
					$reviewId = $restaurantReviews[$i]['idReview'];
					?>
					<div class="review">
						<p>Rating: <?=$restaurantReviews[$i]['rating']?></p>
						
						<p>Written by <?=$reviewUser['name'];?></p>
						<li>
						<?=$restaurantReviews[$i]['text']?>
							<ul class="responses" id="response<?=$reviewId?>">
								<?php 
								//Get the users who wrote the responses
								$stmt = $dbh->prepare('SELECT * FROM responses WHERE idReview = ?');
								$stmt->execute(array($reviewId));
								$responses = $stmt->fetchAll();
								for($j = 0; $j < count($responses); $j++)
								{
									$stmt = $dbh->prepare('SELECT * FROM users WHERE idUser = ?');
									$stmt->execute(array($responses[$j]['idUser']));
									$responseUser = $stmt->fetch();
								?>
								<div class="response">
									<p>Written by <?=$responseUser['name']?></p>
									<li>
										<?=$responses[$j]['text']?>
									</li>
								</div>
								<?php } ?>
							</ul>
						</li>
					</div>
				<?php } ?>
			</ul>
		</div>
		<div>Icons made by <a href="http://www.flaticon.com/authors/madebyoliver" title="Madebyoliver">Madebyoliver</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a>
		<a href="http://www.freepik.com" title="Freepik">Freepik</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a>
		</div>
	</body>
</html>