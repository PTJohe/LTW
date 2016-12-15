<?php

session_start();

include_once('../database/insert_users.php');

$result = insertUser($_POST['cname'],$_POST['uname'],$_POST['psw1'],$_POST['psw2']);

if($result == 0){
	$_SESSION['username'] = $_POST['uname'];
}

$resultStringsArray = array('OK', 'Passwords don\'t match', 'Username already taken', 'Password must have at least 6 characters');
$resultString = $resultStringsArray[$result];

$text = "<div class='alert alert-danger' role='alert'>" . $resultString . "</div>";

sendAnswer:

$dataBack = array('text' => $text, 'regState' => $result);

$dataBack = json_encode($dataBack);
echo $dataBack;


?>