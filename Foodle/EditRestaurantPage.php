<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<?php
	
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
	?>
	<head>
		<meta charset="UTF-8">
		<title><?=$restaurantName?></title>
		<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="writeComment.js"></script>
	</head>
	
	<body>
		<div>
			<img src=<?=$restaurantLogo?> alt=<?=$restaurantName?> width="300" height="100">
			<!-- TODO Upload Logo -->
		</div>
		<div>
			<h2><?=$restaurantName?></h2>
			
			<!-- TODO Confirm changes -->
			
			<p>Address: <?=$restaurantAddress?></p>
			<p>Number: <?=$restaurantContact?></p>
			<p>Rating: <?=$restaurantAverageRating?> / 5 </p>
			<p><?=$restaurantDescription?></p>
			<p>Category: <?=$restaurantCategory?></p>
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
							
							<?php
							if($loggedUser == true) //Anonymous users can't comment
							{ ?>
							<form id="form<?=$reviewId?>" >
									<input id="newResponseText" type="text" placeholder="Write your response..."><br>
									<input id="newResponseUser" type="hidden" value=<?=$username?>><br>
									<input id="newResponseReview" type="hidden" value=<?=$reviewId?> >
									<input class="submitResponse" type="button" value="Send">
							</form>
							<?php } ?>
						</li>
					</div>
				<?php } ?>
			</ul>
			<?php
			if($loggedUser == true) //Anonymous users can't review
			{ ?>
			<form>
				Add a Review:<br>
				<input id="newReviewText" type="text" placeholder="Write your review..."><br>
				<input id="newReviewRating" type="number" min="0" max="5" placeholder="Rate"><br>
				<input id="newReviewUser" type="hidden" value=<?=$username?>><br>
				<input id="newReviewRestaurant" type="hidden" value=<?=$restaurantId?> >
				<input id="submitReview" type="button" value="Send">
			</form>
			<?php } ?>
		</div>
	</body>
</html>