<?php 
include('../includes/all_func.php');
session_start();
if($_GET['id']){
$id=$_GET['id'];
$idd=showuserid($_SESSION['SD_User_Name']);
$sqlupdate="update tax set status='1' where id='$id'";

$sql="update tax set status='0' where user_id='$idd' and  id not in ($id)";
//echo $sql."<br>".$sqlupdate;exit;
mysql_query($sql);
mysql_query($sqlupdate);

header("location:showtax.php");
}
?>