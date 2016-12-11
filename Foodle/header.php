<?php 
include_once 'paths.php';
include_once 'resources/resources.php';

$foodleLogo = getLogo();

?>

<a href=<?php echo $homePath?>><img src=<?=$foodleLogo?> alt="Logo" width="200" height="200"></a>

<nav>
	<?php include_once 'nav.php' ?>
</nav>