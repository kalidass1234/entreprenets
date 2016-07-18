<?php
session_start();
include('connection.php');
$to=$_REQUEST['to'];
$sender_id=$_SESSION['adid'];
$msg=$_REQUEST['msg'];
$str="insert into inbox(user_id,message,sender_id) values('$to','$msg','$sender_id')";
$res=mysql_query($str);
if($res)
{
$msent="You have sent message successfully";
header("location:../outbox.php?msent=".$msent);
}
?>