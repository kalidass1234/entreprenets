<?php
include("config/config.php");
//print_r($_POST); exit;
$username=$_POST['user_name'];
$password=$_POST['password'];
$return_page=$_POST['return_page'];
$type='';
$current_page='login.php';
$obj_login->login($username,$password,$return_page,$current_page,$type='');
?>