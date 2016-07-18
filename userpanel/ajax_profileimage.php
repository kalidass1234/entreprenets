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
		$sql=" update registration set image=(select user_image from userimages where id='$id') where user_name='$user_name'";
		mysql_query($sql);
		$res=mysql_query("select user_image from userimages where id='$id'");
		$row=mysql_fetch_assoc($res);
		echo "<img  class='img-polaroid' src='userimages/$row[user_image]'  width=140px height=140px >";
	}
	else
	{
		$sql=" update registration set image='' where user_name='$user_name'";
		mysql_query($sql);
		echo "<img  class='img-polaroid' src='http://placehold.it/140x140' >";
	}
}
?>