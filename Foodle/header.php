<?php 
include_once 'paths.php';
include_once 'resources/resources.php';

$foodleLogo = getLogo();

?>
<div id="siteLogo">
	<a href=<?php echo $homePath?>><img src=<?=$foodleLogo?> alt="Logo" width="100" height="100"></a>
</div>
<nav>
	<?php include_once 'nav.php' ?>
</nav>