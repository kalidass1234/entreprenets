<?php
include("../includes/all_func.php");
if($_SESSION['Session_Rand_No']==$_REQUEST['Session_id'])
{
}
else
{
	header("Location:upgrade_payment_package.php?msg=wrong url access"); exit;
}
$user_id=showuserid($_SESSION['SD_User_Name']);
$bonus_date=date('Y-m-d');
// check the transaction password and match the amount to be deducted

include("../config/class_commission.php");
$obj_commission=new Class_Commission();
$obj_query=new mysql_func();
$obj_rep=new Representative();
//echo "<pre>"; print_r($_POST); print_r($_SESSION);exit;
$bonus_date=date('Y-m-d');
$Date=$bonus_date;
$expire_date=date('Y-m-d', strtotime($Date. ' + 30 day'));

$package_id=1;
$duration=1;
$amount=160;
$order_no=$_SESSION['orderno'];
$payment_mode=$_SESSION['payment_mode'];
if($payment_mode=='Bank Wire')
{
	$cond=",acc_name='$acc_name',bank_nm='$bank_nm',ac_no='$ac_no',branch_nm='$branch_nm',swift_code='$swift_code'";
}
else
{
	$cond="";
}
// get the product id form the member package id

//echo "update registration set bonus=1 , bonus_date='$bonus_date',category_one=1 where user_id='".$user_id."'";exit;
mysql_query("update registration set transaction_no='$order_no',plan_name='$amount',plan_type='Affiliate',bonus_request=1 , bonus_request_date='$bonus_date',category_one='$package_id',duration_one='$duration' $cond where user_id='".$user_id."'");

// end to check subscription is first time
unset($_SESSION['orderno']);
unset($_SESSION['payment_for']);
unset($_SESSION['payment_mode']);
header("Location:upgrade_payment_package.php");
?>