<?php
$dbh=new PDO('sqlite:../database.db');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


include_once '../paths.php';
include_once '../Utilities.php';
include_once '../resources/resources.php';


$partialStates=$_POST['partialState'];


$stmt = $dbh->prepare("SELECT restaurantName,idRestaurant FROM restaurants WHERE restaurantName LIKE ? ");
$stmt->execute(array('%'.$partialStates.'%'));


$result=$stmt->fetchAll();
foreach($result as $row){
	$restaurantLogoPath = getRestaurantLogoPath($row['idRestaurant']);
	echo "<a id='liveSearchLink' href=".$navPath."restaurant/".$row['idRestaurant']."><div id='liveSearchResult'><img id='liveSearchImage' src=".$restaurantLogoPath." width='50' height='50'>  ".$row['restaurantName']."</div></a>";
}
?>
