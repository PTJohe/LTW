<?php

include_once '../paths.php';
include_once '../Utilities.php';
include_once '../resources/resources.php';

$partialStates=$_POST['search'];

$dbh=new PDO('sqlite:../database.db');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $dbh->prepare("SELECT * FROM restaurants WHERE restaurantName LIKE ? ORDER BY averageRating DESC");
$stmt->execute(array('%'.$partialStates.'%'));
$result=$stmt->fetchAll();


echo "<p>Restaurants found = ".count($result)."</p>";

foreach($result as $row){
	$restaurantLogoPath = getRestaurantLogoPath($row['idRestaurant']);
	$restaurantPath = $navPath . "restaurant/" . $row['idRestaurant'];
	
	echo "
	<div>
		<a href=".$navPath."restaurant/".$row['idRestaurant'].">
			".$row['restaurantName']."<br>
			<img src=".$restaurantLogoPath." width = '200' height = '100'>
		</a>
		<p>Rating: ".$row['averageRating']."</p>
		<p>Category: ".$row['category']."</p>
	</div>";
}
?>
