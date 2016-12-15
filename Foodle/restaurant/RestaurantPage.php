<?php
session_start();

//TODO Maybe put this hunk of code into a separate php file, to include in both edit and restaurant page
include '../paths.php';
//include_once($databaseFunctionsPath . 'get_restaurants.php');
include_once("../database/get_restaurants.php");
include '../resources/resources.php';

//Get session parameters
if(isset($_SESSION['username'])){
	$loggedUser = true;
	$username = $_SESSION['username'];
}
else{
	$loggedUser = false;
	$username = "anonymous";
}
//Opens database

//FOR DEBUGGING
/*
$loggedUser = true;
$username = "PTJohe";
$_SESSION['username'] = $username;
include 'nav.php';
*/

$dbh = new PDO('sqlite:../database.db');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //To enable error handling

//Store restaurantName in session
if(isset($_GET['restaurantId'])){
	$restaurantName = getRestaurantName($_GET['restaurantId']);
	if($restaurantName != null || $restaurantName != ""){
		$_SESSION['restaurantName'] = $restaurantName;
	}
}
$inputRestaurantName = $_SESSION['restaurantName'];

//Gets the restaurant
$stmt = $dbh->prepare('SELECT * FROM restaurants WHERE restaurantName = ?');
$stmt->execute(array($inputRestaurantName));
$selectedRestaurant = $stmt->fetch();	
if($selectedRestaurant == null){ //In case of a non-existing name
	header('Location: Error404.php?info=2');
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
$restaurantLogo = getRestaurantLogoPath($restaurantId);
$restaurantAddress = $selectedRestaurant['address'];
$restaurantContact = $selectedRestaurant['contact'];
$restaurantAverageRating = $selectedRestaurant['averageRating'];
$restaurantDescription = $selectedRestaurant['description'];
$restaurantCategory = $selectedRestaurant['category'];
$restaurantCreationDate = $selectedRestaurant['creationDate'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?=$restaurantName?></title>
	<link rel="stylesheet" href="../css/restaurant/RestaurantPage.css">
	<script src="../js/lib/jquery-1.11.3.min.js"></script>
	<script src="../js/writeComment.js"></script>
	<script src="../js/showPhotosRestaurant.js"></script>
</head>

<body>
	<div id="headerdiv">
		<header>
			<?php include '../header.php' ?>
		</header>
	</div>
	<div id="main">
		<div id="restaurantDetails">
			<article>
				<input id="restaurantId" type="hidden" value=<?=$restaurantId?>>
				<img id="logo" src="<?=$restaurantLogo?>" alt=<?=$restaurantName?> width="300" height="100">
				<h2><?=$restaurantName?></h2>

				<div id="imageSlideShow">
					<div>
						<img src='../resources/restaurantPhotos/default.png' alt="noimage" width="300" height="300">
					</div>
					<div>
						<input id="previousPhoto" type="button" value="Previous">
						<input id="nextPhoto" type="button" value="Next">
					</div>
				</div>

				<?php
			//If user is the owner of the page, he can choose to edit the page
				if($username == $restaurantOwner && $loggedUser == true){ ?>
				<form action="EditRestaurantPage.php" method="post">
					<input id="editRestaurantPage" type="submit" value="Edit">
				</form>
				<?php } ?>

				<p><b>Address:</b> <?=$restaurantAddress?></p>
				<p><b>Number:</b> <?=$restaurantContact?></p>
				<p><b>Rating:</b> <?=$restaurantAverageRating?> / 5 </p>
				<p><?=$restaurantDescription?></p>
				<p><b>Category:</b> <?=$restaurantCategory?></p>
				<p><b>Creation Date:</b> <?=date("d/m/Y", strtotime($restaurantCreationDate));?></p>
			</article>
		</div>

		<div id="reviews">
			<h1>Reviews:</h1>
			<ul id="reviewsList">
				<?php for($i = 0; $i < count($restaurantReviews); $i++){ 
					//Gets the user who wrote the actual review
					$stmt = $dbh->prepare('SELECT * FROM users WHERE idUser = ?');
					$stmt->execute(array($restaurantReviews[$i]['idUser']));
					$reviewUser = $stmt->fetch();
					$reviewId = $restaurantReviews[$i]['idReview'];
					$reviewUserPicture = getProfilePicturePath($restaurantReviews[$i]['idUser']);
					?>
					<div class="review">
						<p class="reviewRating">Rating: <?=intval($restaurantReviews[$i]['rating'])?></p>

						<p><?=$restaurantReviews[$i]['text']?></p>
						<p><img src=<?=$reviewUserPicture?> width="25" height="25"> <a href="../profile/<?=$reviewUser['username'];?>"><?=$reviewUser['name'];?></a></p>
						<ul class="responses" id="response<?=$reviewId?>">
							<?php 
								//Get the users who wrote the responses
							$stmt = $dbh->prepare('SELECT * FROM responses WHERE idReview = ?');
							$stmt->execute(array($reviewId));
							$responses = $stmt->fetchAll();
							for($j = 0; $j < count($responses); $j++){
								$stmt = $dbh->prepare('SELECT * FROM users WHERE idUser = ?');
								$stmt->execute(array($responses[$j]['idUser']));
								$responseUser = $stmt->fetch();

								$responseUserPicture = getProfilePicturePath($responses[$j]['idUser']);
								?>
								<div class="response">
									<li>
										<?=$responses[$j]['text']?>
									</li>
									<p>
										<img src=<?=$responseUserPicture?> width="25" height="25"> <a href="../profile/<?=$responseUser['username']?>"><?=$responseUser['name']?></a>
										<?php if($responseUser['username'] == $restaurantOwner){ ?>
										<label id="ownerTag">Owner</label> <?php } ?>
									</p>
								</div>
								<?php 
							} ?>
						</ul>

						<?php if($loggedUser == true){ //Anonymous users can't comment ?> 
						<form class="addResponse" id="form<?=$reviewId?>" >
							<textarea id="newResponseText" rows="3" placeholder="Write your response..."></textarea><br>
							<input id="newResponseUser" type="hidden" value=<?=$username?>><br>
							<input id="newResponseReview" type="hidden" value=<?=$reviewId?> >
							<input class="submitResponse" type="button" value="Send">
						</form>
						<?php } ?>
					</div>
					<?php 
				} ?>
			</ul>
		</div>

		<div id="addReview">
			<?php if($loggedUser == true && $username != $restaurantOwner){ //Anonymous users or Owner can't review ?>
			<form id="formReview">
				<textarea id="newReviewText"  rows="5" placeholder="Write your review..."></textarea>
				<br>
				Rating:
				<div class="newReviewRadio">
					<input class="newReviewRating" type="radio" id="radio5" name="select" value="5"/>
					<label for="radio5">5</label>
				</div>
				<div class="newReviewRadio">
					<input class="newReviewRating" type="radio" id="radio4" name="select" value="4"/>
					<label for="radio4">4</label>
				</div>
				<div class="newReviewRadio">
					<input class="newReviewRating" type="radio" id="radio3" name="select" value="3"/>
					<label for="radio3">3</label>
				</div>
				<div class="newReviewRadio">
					<input class="newReviewRating" type="radio" id="radio2" name="select" value="2"/>
					<label for="radio2">2</label>
				</div>
				<div class="newReviewRadio">
					<input class="newReviewRating" type="radio" id="radio1" name="select" value="1"/>
					<label for="radio1">1</label>
				</div>
				<br>
				<input id="newReviewUser" type="hidden" value=<?=$username?>><br>
				<input id="newReviewRestaurant" type="hidden" value=<?=$restaurantId?> >
				<input id="submitReview" type="button" value="Send">
			</form>
			<?php } ?>
		</div>
	</div>
	<footer>
		<?php include '../footer.php' ?>
	</footer>
</body>
</html>