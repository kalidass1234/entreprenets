<?php
session_start();

if(isset($_GET['uid']) && isset($_GET['username'])){
	
	// set session
	$_SESSION['token_id'] = md5($_GET['uid']);
	$_SESSION['user_id'] = $_GET['uid'];		
	$_SESSION['SD_User_Name'] = $_GET['username'];
	$_SESSION['SD_User_ID'] = $_GET['uid'];
	
	// redirect into user account
	header('Location:../../userpanel/');
}

?>