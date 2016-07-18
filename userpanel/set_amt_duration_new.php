<?php
session_start();
/*echo "<pre>"; print_r($_REQUEST);
echo "<pre>"; print_r($_SESSION);exit;*/
$_SESSION['amount']=$_REQUEST['amount'];
$_SESSION['duration']=$_REQUEST['duration'];
$_SESSION['category']=$_REQUEST['category'];
if($_SESSION['category']==1)
{
	echo "<script type='text/javascript'>window.location.href='member-secure_new.php';</script>";
}
if($_SESSION['category']==2)
{
	echo "<script type='text/javascript'>window.location.href='member-secure_two_new.php';</script>";
}
if($_SESSION['category']==3)
{
	echo "<script type='text/javascript'>window.location.href='member-secure_three_new.php';</script>";
}
?>