<?php
include '../resources/resources.php';
include '../Utilities.php';

session_start();

if(!isLoggedIn())
	header('Location: ../Error404.html');

//Opens database
$dbh = new PDO('sqlite:../database.db');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //To enable error handling
$inputUsername = getCurrentUser();

//Gets the user
$stmt = $dbh->prepare('SELECT * FROM users WHERE username = ?');
$stmt->execute(array($inputUsername));
$selectedUser = $stmt->fetch();	
if($selectedUser == null){ //In case of a non-existing name
	header('Location: ../Error404.php');
}

//Get the infos needed
$userId = $selectedUser['idUser'];
$userName = $selectedUser['name'];
$userPassword = $selectedUser['password'];
$userPhoto = getProfilePicturePath($userId);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Edit Profile</title>
	<meta charset="utf-8">
</head>
<body>
	<header>
		<?php include '../header.php' ?>
		<nav>
			<?php include '../nav.php' ?>
		</nav>
		<h1>Edit Profile</h1>
	</header>
	<div id="main">
		<section id="editData">
			<form>
				Change Name - <?=$userName?>:<br>
				<input type="text" name="fullname"><br>
				Change Password:<br>
				<input type="text" name="password"><br>
			</form>
			<form action="upload.php" method="post" enctype="multipart/form-data">
				Change Profile Picture:<br>
				<img src=<?=$userPhoto?> alt="Photo" width="200" height="200"><br>
				<input type="file" name="fileToUpload" id="fileToUpload">
				<input type="submit" value="Upload Image" name="uploadImage">
			</form>
		</section>
		<section id="confirmChanges">
			<form>
				Current Password:<input type="text" name="currentPassword"><br>
				Confirm Password:<input type="text" name="confirmPassword"><br>
				<input type="submit" value="Confirm Changes" name="submit">
			</form>
		</section>
	</div>

</body>
</html>