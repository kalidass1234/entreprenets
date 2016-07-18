<?php
include('../includes/all_func.php');
$idd=$_SESSION['SD_User_Name'];
$s="select * from registration where user_name='$idd'";
$r=mysql_query($s);
$f=mysql_fetch_array($r);
$id=$f['user_id'];

//print_r($_REQUEST);

extract($_REQUEST);

$sql="select * from registration where user_id='$ref' or user_name='$ref'";
$res=mysql_query($sql);
$count=mysql_num_rows($res);
if($count>0)
{
	echo "<font color='green' >User Available.</font>";
}
else
{
	echo "<font color='red' >User Not Available.</font>";
}
?>