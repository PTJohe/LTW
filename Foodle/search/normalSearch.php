<?php

include_once '../paths.php';
include_once '../Utilities.php';
include_once '../resources/resources.php';

$partialStates = $_POST['search'];


$dbh=new PDO('sqlite:../database.db');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $dbh->prepare("SELECT * FROM restaurants WHERE restaurantName LIKE ? ORDER BY averageRating DESC");
$stmt->execute(array('%'.$partialStates.'%'));
$result=$stmt->fetchAll();


$text = "<p id='count'>Found ".count($result)." restaurants.</p>";

foreach($result as $row){
	$restaurantLogoPath = getRestaurantLogoPath($row['idRestaurant']);
	$restaurantPath = $navPath . "restaurant/" . $row['idRestaurant'];
	
	$text .="<article>
	<div id='results'>
		<a href=".$navPath."restaurant/".$row['idRestaurant'].">
			<img src=".$restaurantLogoPath." width = '200' height = '100'>
			<p>".$row['restaurantName']."</p>
		</a>
		<div id='rating'><b>Rating:</b> ".$row['averageRating']."</div>
		<div id='category'><b>Category:</b> ".$row['category']."</div>
	</div>
</article>";
}

sendAnswer:

$dataBack = array('text' => $text);

$dataBack = json_encode($dataBack);
echo $dataBack;

?>
