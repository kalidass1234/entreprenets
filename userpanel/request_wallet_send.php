<?php
include('../includes/all_func.php');
//echo "<pre>"; print_r($_REQUEST);
$user_id=showuserid($_SESSION['SD_User_Name']);
$amount=$_REQUEST['amount'];
$user_remark=$_REQUEST['user_remark'];
$request_date=date('Y-m-d');
mysql_query("insert into finance_request set user_id='$user_id',amount='$amount',user_remark='$user_remark',request_date='$request_date'");
header("Location:request_cashwallet.php");
?>