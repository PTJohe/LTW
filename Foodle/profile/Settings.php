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
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<script src="../js/lib/jquery-1.11.3.min.js"></script>
	<script src="../js/lib/jquery.form.js"></script>
	<script src="../js/uploadFile.js"></script>

</head>
<body>
	<header>
		<?php include '../header.php' ?>
		
		<h1>Edit Profile</h1>
	</header>

	<div id="main">
		<section id="editImage">
			<div id="resultImageProfile">
				<?php echo '<p class="myImage"><img src="'.$userPhoto.'" width=250 height=250 alt="" /></p>';?>
			</div>
			<p>
				<form method="post" enctype="multipart/form-data" id="MyImageProfileUploadForm" action=""> <!-- Our form with a file type field and a hidden field containing the user ID (here 1) -->
					<div>
						<b>Add / change your profile image: </b>
					</div>
					<div>
						<input name="imageProfile" id="imageProfile" type="file" />
						<input name='userId' type='hidden' value="<?PHP echo $userId; ?>" />
						<button type="button" name="uploadImage" id="submitImage">Change Image</button>
					</div>
				</form>
			</p>
			<p>Maximum size : <b>512 Kb</b></p>
			<p>Formats accepted : <b>jpg</b>, <b>jpeg</b>, <b>png</b></p>
		</section>
		<section id="editData">
			<form>
				Change Name:<br>
				<input type="text" contenteditable="true" value="<?php echo $userName ?>" name="fullname"><br>
				Change Password:<br>
				<input type="text" name="password"><br>
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