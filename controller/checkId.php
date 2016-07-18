<?php
session_start();
$id=$_REQUEST['q'];
include("connection.php");
$quer="select * from registration where user_id='$id'";
$data=mysql_query($quer);
$arr=mysql_fetch_array($data);
if($arr)
{
	echo $opt1=$x['title_nm']." ".$x['first_name']." ".$x['mid_name']." ".$x['last_name'];
}
else
{
	echo "Wrong Sponser Name";
}
?>