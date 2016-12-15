<?php

include_once '../paths.php';
include_once '../Utilities.php';
include_once '../resources/resources.php';

$searchCategories = array(Bar, Café, Restaurante, Tasco);

$checkBoxValues = array();

if(!(isset($_POST['category1']) || isset($_POST['category2']) || isset($_POST['category3']) || isset($_POST['category4']))){
	$checkBoxValues = $searchCategories;
} else {
	if(isset($_POST['category1']))
		$checkBoxValues[] = $searchCategories[0];
	if(isset($_POST['category2']))
		$checkBoxValues[] = $searchCategories[1];
	if(isset($_POST['category3']))
		$checkBoxValues[] = $searchCategories[2];
	if(isset($_POST['category4']))
		$checkBoxValues[] = $searchCategories[3];
}

$rating = $_POST['minRating'];

$dbh=new PDO('sqlite:../database.db');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$implodedArray = implode("', '",$checkBoxValues);
$query = "('" . $implodedArray . "')";


if($_POST['sort'] == 'name')
	$stmt = $dbh->prepare("SELECT * FROM restaurants WHERE (averageRating > ? AND category IN ". $query . " ) ORDER BY restaurantName ASC");
else 
	$stmt = $dbh->prepare("SELECT * FROM restaurants WHERE (averageRating > ? AND category IN ". $query . " ) ORDER BY averageRating DESC, restaurantName ASC");

$stmt->execute(array($rating));
$result=$stmt->fetchAll();

//$text = "<p id='count'>Restaurants found = ".count($result)."</p>";

/*$inputPage = $_POST['currentPage'];


$maxResultsPerPage = 5;
$offset = ($inputPage - 1 ) * $maxResultsPerPage;
$totalPages = ceil(count($result) / $maxResultsPerPage);


for($i = $offset; $i < count($result); $i++){
	//Limit number of Results Per Page
	if($i >= $offset + $maxResultsPerPage)
	break;	*/
	foreach ($result as $row) {
		$restaurantLogoPath = getRestaurantLogoPath($row['idRestaurant']);
		$restaurantPath = $navPath . "restaurant/" . $row['idRestaurant'];

		$text .="
		<article>
		<div id='results'>
			<a href=".$navPath."restaurant/".$row['idRestaurant'].">
				<img src=".$restaurantLogoPath." width = '200' height = '100'>
				".$row['restaurantName']."
			</a>
			<div id='rating'>Rating: ".$row['averageRating']."</div>
			<div id='category'>Category: ".$row['category']."</div>
		</div>
		</article>";
	}

sendAnswer:

$dataBack = array('text' => $text);

$dataBack = json_encode($dataBack);
echo $dataBack;

?>