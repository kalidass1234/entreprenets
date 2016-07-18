<?php
include('../includes/all_func.php');
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	//transaction history
	$id=showuserid($_SESSION['SD_User_Name']);
    //echo "<pre>"; print_r($_POST);
	$action=$_REQUEST['id'];
	mysql_query("update billing_address set status='1' where id='$action'");
	echo "<script language='javascript'>alert('Card Information Cancel Successfully.');window.location.href='debitcard.php';</script>";exit;
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}
?>