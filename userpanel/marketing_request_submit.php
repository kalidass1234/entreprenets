<?php
include("../includes/all_func.php");
session_start();
$user_id=showuserid($_SESSION['SD_User_Name']);
//echo "<pre>"; print_r($_POST);
$curdate=date('Y-m-d');
$query=" insert into materials_request set user_id='$user_id', ";
foreach($_POST as $key=>$val)
{
	if($key!='submit')
	{
		$query.="$key='$val',";
	}
}
$query.=" add_date='$curdate'";
//echo $query;exit;
mysql_query($query);
echo "<script language='javascript'>alert('request sent successfully.');window.location.href='marketing.php';</script>";exit;
?>