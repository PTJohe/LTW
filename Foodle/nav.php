<?php
include_once 'paths.php';
include_once 'Utilities.php';



if(isLoggedIn()){
	?><a href=<?php echo $navPath."profile/".$_SESSION['username']?>><?=$_SESSION['username']?></a>
	<?php
	if($inputUsername == getCurrentUser())
		?><a href =<?php echo $navPath."profile/Settings.php"?>>Settings</a> 
	<a href=<?php echo $navPath."Logout.php"?>>Logout</a><?php 
}
else{
	?><a href=<?php echo $navPath."SignIn.php" ?>>Login</a> <a href=<?php echo $navPath."SignUp.php" ?>>Register</a><?php 
} ?>