<?php

session_start();

$username = $_POST['uname'];
$inputPassword = $_POST['psw'];

$text = '<div class="alert alert-danger" role="alert">Could not login!</div>';
$loginState = false;


$dbh = new PDO('sqlite:../database.db');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $dbh->prepare('SELECT password FROM users WHERE username = ?');
$stmt->execute(array($username));
$storedPassword = $stmt->fetch();

$hashedPassword = $storedPassword['password'];

if(password_verify($inputPassword, $hashedPassword)){
	$loginState = true;
	$_SESSION['username'] = $_POST['uname'];
}
else
	$loginState = false;

sendAnswer:

$dataBack = array('text' => $text, 'loginState' => $loginState);

$dataBack = json_encode($dataBack);
echo $dataBack;

?>