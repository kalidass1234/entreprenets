<?php
session_start();
//include("wp-config.php");
include("controller/connection.php");

$user_name=$_SESSION['adid'];
$s="select * from registration where user_id='$user_name'";
$r=mysql_query($s);
$f=mysql_fetch_array($r);
$user_id=$f['user_id'];
$today = date('Y-m-d H:i:s');
$update="update registration set last_login=NOW() where user_id='$user_id'";
$sql=mysql_query($update)or die("");

unset($_SESSION['adid']);

//session_destroy();
header('location:index.php');
?>