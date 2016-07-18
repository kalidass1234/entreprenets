<?php
include('../includes/all_func.php');
session_start();
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	$user_name=$_SESSION['SD_User_Name'];
	$id=$_REQUEST['checkval'];
	$status=$_REQUEST['status'];
	if($status=='yes')
	{
		$sql=" update userimages set public_status=1 where id='$id'";
		mysql_query($sql);
	}
	else
	{
		$sql=" update userimages set public_status=0 where id='$id'";
		mysql_query($sql);
	}
}
?>