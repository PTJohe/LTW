<?php

$username = $_POST['username'];

$inputName = $_POST['fullname'];
$inputNewPassword = $_POST['newPassword'];
$inputNewPasswordConfirm = $_POST['newPasswordConfirm'];

$inputPassword = $_POST['currentPassword'];
$inputPasswordConfirm = $_POST['currentPasswordConfirm'];


$text = '<div class="alert alert-danger" role="alert">Error!</div>';

if($inputPassword != $inputPasswordConfirm){
	$text = '<div class="alert alert-danger" role="alert">Password does not match!</div>';
}
else{
	$dbh = new PDO('sqlite:../database.db');
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //To enable error handling

	$stmt = $dbh->prepare('SELECT password FROM users WHERE username = ?');
	$stmt->execute(array($username));
	$storedPassword = $stmt->fetch();

	$hashedPassword = $storedPassword['password'];

	if(password_verify($inputPassword, $hashedPassword))
	{
		if(strlen($inputNewPassword) > 0 || strlen($inputNewPasswordConfirm) > 0)
		{
			if($inputNewPassword != $inputNewPasswordConfirm){
				$text = '<div class="alert alert-danger" role="alert">New password does not match!</div>';
				goto sendAnswer;
			}elseif(strlen($inputNewPassword) < 6){
				$text = '<div class="alert alert-danger" role="alert">New password must contain at least 6 characters!</div>';
				goto sendAnswer;
			}
		}
		if(strlen($inputName) == 0){
			$text = '<div class="alert alert-danger" role="alert">Name must not be empty!</div>';
			goto sendAnswer;
		}
		if(preg_match("/[^a-zA-ZÀ-ÿ'- ]/", $inputName)){
			$text = '<div class="alert alert-danger" role="alert">Name contains invalid characters!</div>';
			goto sendAnswer;
		}

		if(strlen($inputName) > 0){
			$stmt = $dbh->prepare('UPDATE users SET name = ? WHERE username = ?');
			$stmt->execute(array($inputName, $username));
		}
		if(strlen($inputNewPassword) >= 6){
			$hashedNewPassword = password_hash($inputNewPassword, PASSWORD_BCRYPT);

			$stmt = $dbh->prepare('UPDATE users SET password = ? WHERE username = ?');
			$stmt->execute(array($hashedNewPassword, $username));
		}
		$text = '<div class="alert alert-success" role="alert">Profile details successfully changed.</div>';
	}
	else{
		$text = '<div class="alert alert-danger" role="alert">Invalid password!</div>';
	}
}

sendAnswer:

$dataBack = array('text' => $text);

$dataBack = json_encode($dataBack);
echo $dataBack;

?>

