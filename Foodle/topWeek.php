<?php
include_once 'resources/resources.php';
include_once 'paths.php';
include_once 'Utilities.php';
include_once 'database/get_restaurants.php';
include_once 'database/connection.php';

$arrayTopWeek = bestRestaurantsLastWeek();
?>

<div id="topWeekOutput">
	<?php
	for($i=0;$i<count($arrayTopWeek);$i++){
		$logoPath = getRestaurantLogoPath($arrayTopWeek[$i][0]);
		$linkRestaurant = $navPath."restaurant/" . $arrayTopWeek[$i][0];
		?>
		<p>
			<a href=<?=$linkRestaurant?>>
				<label id="averageRating"><?=$arrayTopWeek[$i][2]?></label><img src=<?=$logoPath?> alt="Image" height = "25" width = "25"><span>&#9<?php echo $arrayTopWeek[$i][1]?></span>
			</a>
		</p>
		<?php 
	} ?>
</div>
