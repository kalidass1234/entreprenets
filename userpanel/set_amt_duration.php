<?php
session_start();
if($_REQUEST['your_level']=='your_level')
{
	echo "<script type='text/javascript'>window.location.href='user_profile.php';</script>";
}
//echo "<pre>"; print_r($_REQUEST);
$_SESSION['amount']=$_REQUEST['amount'];
$_SESSION['duration']=$_REQUEST['duration'];
$_SESSION['category']=$_REQUEST['category'];
if($_SESSION['category']==1)
{
	echo "<script type='text/javascript'>window.location.href='member-secure.php';</script>";
}
if($_SESSION['category']==2)
{
	echo "<script type='text/javascript'>window.location.href='member-secure_two.php';</script>";
}
if($_SESSION['category']==3)
{
	echo "<script type='text/javascript'>window.location.href='member-secure_three.php';</script>";
}
?>