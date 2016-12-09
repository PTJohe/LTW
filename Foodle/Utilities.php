<?php

session_start();

function isLoggedIn(){
	//True if logged in, false otherwise
	if ($_SESSION['username'])
		return true;
	else return false; 
}

function getCurrentUser(){
	return $_SESSION['username'];
}

?>