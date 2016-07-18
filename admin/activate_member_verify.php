<?php
include('config/directory.php');
include("config/config.php");

// check the member is valid or not
$user_id=$_REQUEST['user_id'];
$sql="select * from apply_for_verify where user_id='$user_id' and status=0";
$res=mysql_query($sql);
$count=mysql_num_rows($res);
if($count)
{
	$row=mysql_fetch_assoc($res);
	
	$bonus_date=date('Y-m-d');
	mysql_query("update apply_for_verify set status=1,accept_date='$bonus_date' where user_id='$user_id'");
}
header("Location:admin_main.php?page_number=172");
?>