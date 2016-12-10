<!DOCTYPE html>
<html>
<head>
	<title>Error 404</title>
</head>

<body>
	<header>
		<?php include 'header.php' ?>
		<nav>
			<?php include 'nav.php' ?>
		</nav>
	</header>
	<div id="main">
		<?php 	
		if (empty($_GET['info'])) { 
			?>
			<h2>Sorry :( </h2>
			<p>The page you were trying to access could not be found.</p>
			<?php 
		} 
		else { 
			$page = $_GET['info'];
			switch($page){
				case '1': //User not found
				?>
				<h2>Sorry :( </h2>
				<p>The user could not be found.</p>
				<?php 
				break;
				case '2': //Restaurant not found
				?>
				<h2>Sorry :( </h2>
				<p>The restaurant could not be found.</p>
				<?php 
				break;
				default:
				?>
				<h2>Sorry :( </h2>
				<p>The page you were trying to access could not be found.</p>
				<?php 
				break;
				
			}
		}
		?>
	</div>
</body>
</html>