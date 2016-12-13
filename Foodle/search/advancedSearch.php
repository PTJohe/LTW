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

$implodedArray = implode(', ',$checkBoxValues);

$dbh=new PDO('sqlite:../database.db');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $dbh->prepare("SELECT * FROM restaurants WHERE (averageRating > ? AND category IN (?) )");
$stmt->execute(array($rating, $implodedArray));
$result=$stmt->fetchAll();

$text = "<p>Number of Results = ".count($result)."</p>";

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
		<div>
			<a href=".$navPath."restaurant/".$row['idRestaurant'].">
				".$row['restaurantName']."<br>
				<img src=".$restaurantLogoPath." width = '200' height = '100'>
			</a>
			<p>Rating: ".$row['averageRating']."</p>
			<p>Category: ".$row['category']."</p>
		</div>";
	}
/*
$text .= "<br>";

if($inputPage > 1){
	$previousPage = $inputPage - 1;
	$text .= "<a href=".$previousPage.">Previous</a>";
}
if($inputPage < $totalPages){
	$nextPage = $inputPage + 1;
	$text .= "<a href=".$nextPage.">Next</a>";
} 

$text .= "<p>Page ".$inputPage." of ".$totalPages."</p>";
*/

sendAnswer:

$dataBack = array('text' => $text);

$dataBack = json_encode($dataBack);
echo $dataBack;

?>