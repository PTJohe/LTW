<?php
session_start();

include_once('database/connection.php');
include_once('database/insert_users.php');

insertUser($_POST['cname'],$_POST['uname'],$_POST['psw1'],$_POST['psw2']);


  // header('Location: HomePage.php']);
 ?>
