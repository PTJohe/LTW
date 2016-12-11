<?php
include_once 'paths.php';
include_once 'Utilities.php';
include_once('database/get_restaurants.php');
include_once('database/connection.php') ;

$array=bestRestaurantsLastWeek();
for($i=0;$i<count($array);$i++){
?>

<p><a href=
  <?php
  echo $navPath."restaurant/" . $array[$i];
?>><?php echo $array[$i]; }?>
</a>
</p>
