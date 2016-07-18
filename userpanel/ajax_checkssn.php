<?php
session_start();
$idd=$_SESSION['SD_User_Name'];
include('../includes/all_func.php');
$s="select * from registration where user_name='$idd'";
$r=mysql_query($s);
$f=mysql_fetch_array($r);
$id=$f['user_id'];

//print_r($_REQUEST);

extract($_REQUEST);

$sql="select * from registration where pan_no='$ssn'";
$res=mysql_query($sql);
$count=mysql_num_rows($res);
if($count>0)
{
	echo "<font color='red' >Already Exists.</font>";
}
else
{
	echo "<font color='green' >Available.</font>";
}
?>