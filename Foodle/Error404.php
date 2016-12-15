<!DOCTYPE html>
<html>
<head>
	<title>Error 404</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/Error404.css">
</head>

<body>
	<header>
		<?php include 'header.php' ?>
	</header>
	<div id="main">
		<div id="sorry">
			<article>
				<h2>Sorry :(</h2>
			</article>
		</div>
		<div id="message">
			<?php 	
			if (empty($_GET['info'])) { 
				?>
				The page you were trying to access could not be found.
				<?php 
			} 
			else { 
				$page = $_GET['info'];
				switch($page){
				case '1': //User not found
				?>
				<p>The user could not be found.</p>
				<?php 
				break;
				case '2': //Restaurant not found
				?>
				<p>The restaurant could not be found.</p>
				<?php 
				break;
				default:
				?>
				<p>The page you were trying to access could not be found.</p>
				<?php 
				break;
			} }?>
		</div>
		<img src="resources/error404.gif">
	</div>
	<footer>
		<?php include 'footer.php' ?>
	</footer>
</body>
</html>