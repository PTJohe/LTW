<?php
include_once 'resources/resources.php';
include_once 'paths.php';
include_once 'Utilities.php';
include_once 'database/get_restaurants.php';
include_once 'database/connection.php';

$arrayNewRestaurants =newRestaurants();

for($i=0;$i<count($arrayNewRestaurants);$i++){
	$logoPath = getRestaurantLogoPath($arrayNewRestaurants[$i][0]);
	$linkRestaurant = $navPath."restaurant/" . $arrayNewRestaurants[$i][0];
	?>

	<p>
		<a href=<?=$linkRestaurant?>>
		<label id="averageRating"><?=$arrayNewRestaurants[$i][2]?></label><img src=<?=$logoPath?> alt="Image" height = "25" width = "25">&#9<?php echo $arrayNewRestaurants[$i][1]?>
		</a>
	</p>
	<?php 
} ?>
