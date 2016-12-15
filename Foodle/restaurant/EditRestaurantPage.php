<?php
session_start();

include '../paths.php';
include '../nav.php';
include '../resources/resources.php';

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

$dbh = new PDO('sqlite:../database.db');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //To enable error handling

//Store restaurantName in session
if(isset($_GET['restaurantId']))
{
	$restaurantName = getRestaurantName($_GET['restaurantId']);
	if($restaurantName != null || $restaurantName != "")
	{
		$_SESSION['restaurantName'] = $restaurantName;
	}
}
$inputRestaurantName = $_SESSION['restaurantName'];

//Gets the restaurant
$stmt = $dbh->prepare('SELECT * FROM restaurants WHERE restaurantName = ?');
$stmt->execute(array($inputRestaurantName));
$selectedRestaurant = $stmt->fetch();	
if($selectedRestaurant == null) //In case of a non-existing name
{
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
	<script src="../js/editRestaurantInfo.js"></script>
</head>

<body>
	<div id="headerdiv">
		<header>
			<?php include '../header.php'; ?>
		</header>
	</div>
	<div id="main">
		<div id="restaurantDetails">
			<input class="restaurantId" type="hidden" value=<?=$restaurantId?>>
			<input class="doneButton" type="button" value="Done editing"><br>
			<img id="logo" src="<?=$restaurantLogo?>" alt=<?=$restaurantName?> width="300" height="100">
			<!-- TODO Upload Logo -->
	
			<div class="editable" id="restaurantName">
				<h2 class="editItem"><?=$restaurantName?></h2>
				<input class="editButton" type="image" src="<?=$resourcesPath?>editIcon.png" alt="Edit" width="25" height="25">
				<input class="checkButton" type="hidden" src="<?=$resourcesPath?>checkEditIcon.png" alt="Check" width="25" height="25">
				<input class="cancelButton" type="hidden" src="<?=$resourcesPath?>cancelEditIcon.png" alt="Cancel" width="25" height="25">
			</div>
	
			<div class="editable" id="restaurantAddress">
				<p>Address:</p>
				<p class="editItem"><?=$restaurantAddress?></p>
				<input class="editButton" type="image" src="<?=$resourcesPath?>editIcon.png" alt="Edit" width="25" height="25">
				<input class="checkButton" type="hidden" src="<?=$resourcesPath?>checkEditIcon.png" alt="Check" width="25" height="25">
				<input class="cancelButton" type="hidden" src="<?=$resourcesPath?>cancelEditIcon.png" alt="Cancel" width="25" height="25">
			</div>
			<div class="editable" id="restaurantNumber">
				<p>Number:</p>
				<p class="editItem"><?=$restaurantContact?></p>
				<input class="editButton" type="image" src="<?=$resourcesPath?>editIcon.png" alt="Edit" width="25" height="25">
				<input class="checkButton" type="hidden" src="<?=$resourcesPath?>checkEditIcon.png" alt="Check" width="25" height="25">
				<input class="cancelButton" type="hidden" src="<?=$resourcesPath?>cancelEditIcon.png" alt="Cancel" width="25" height="25">
			</div>
			<p>Rating: <?=$restaurantAverageRating?> / 5 </p>
			<div class="editable" id="restaurantDescription">
				<p class="editItem"><?=$restaurantDescription?></p>
				<input class="editButton" type="image" src="<?=$resourcesPath?>editIcon.png" alt="Edit" width="25" height="25">
				<input class="checkButton" type="hidden" src="<?=$resourcesPath?>checkEditIcon.png" alt="Check" width="25" height="25">
				<input class="cancelButton" type="hidden" src="<?=$resourcesPath?>cancelEditIcon.png" alt="Cancel" width="25" height="25">
			</div>
			<div class="editableList" id="restaurantCategory">
				<p>Category:</p>
				<p class="editItem"><?=$restaurantCategory?></p>
			</div>
			<p>Creation Date: <?=$restaurantCreationDate?></p>
		</div>
	</div>
</body>
</html>