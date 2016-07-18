<?php
include('../includes/all_func.php');
session_start(); 
error_reporting(E_ALL ^ E_NOTICE);
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
		$remark=mysql_real_escape_string($_POST['filed06']);
		$username=showuserid($_SESSION['SD_User_Name']);
		$rating=$_POST['rating'];
		$section=$_POST['section'];
		$pid=$_POST['pid'];
		$seller_id=$_POST['seller_id'];
		mysql_query("INSERT INTO `seller_review` (`id`, `p_id`, `seller_id`, `user_id`, `rating`, `section`, `remark`, `ts`) VALUES (NULL, '$pid', '$seller_id', '$username', '$rating', '$section', '$remark', CURRENT_TIMESTAMP);");
	echo "<script language='javascript'>window.location.href='feedback.php?invoice_no=$_REQUEST[invoice_no]';</script>";exit;
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}
?>