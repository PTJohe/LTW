<?php
include_once 'paths.php';
include_once 'Utilities.php';
include_once('database/get_restaurants.php');
include_once('database/connection.php') ;

$arrayNews=newRestaurants();
for($i=0;$i<count($arrayNews);$i++){
?>

<p><a href=
  <?php
  echo $navPath."restaurant/" . $arrayNews[$i][0];
?>><?php echo $arrayNews[$i][1]; }?>
</a>
</p>
