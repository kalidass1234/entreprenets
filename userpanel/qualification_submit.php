<?php
include("../includes/all_func.php");
if($_SESSION['Session_Rand_No']==$_REQUEST['Session_id'])
{
}
else
{
	header("Location:qualification.php?msg=wrong url access"); exit;
}
$user_id=showuserid($_SESSION['SD_User_Name']);
$bonus_date=date('Y-m-d');
// check the transaction password and match the amount to be deducted
if($_SESSION['payment_mode']=='Cash Wallet')
{
	// check user transaction password 
	$sql_u="select id from registration where t_code='$_POST[t_code]' and user_id='$user_id'";
	$res_u=mysql_query($sql_u);
	$count_u=mysql_num_rows($res_u);
	if($count_u)
	{
		// deduct amount form cash wallet
		$sql_update="update final_e_wallet set amount=amount-30 where user_id='$user_id'";
		mysql_query($sql_update);
		$insert="insert into credit_debit set user_id='$user_id',credit_amt='0',debit_amt='30',receiver_id='admin',sender_id='$user_id',receive_date='$bonus_date',TranDescription='Qualification Monthly Subscription',Remark='Qualification Monthly Subscription'";
		mysql_query($insert);
	}
	else
	{
		echo "<script>alert('wrong transaction password');window.location.href='cash_wallet_qualification.php?msg=wrong transaction password';</script>"; exit;
	}
}
include("../config/class_commission.php");
$obj_commission=new Class_Commission();
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
	mysql_query("update registration set $cond where user_id='".$user_id."'");
}
else
{
	$cond="";
}
// get the product id form the member package id

//echo "update registration set bonus=1 , bonus_date='$bonus_date',category_one=1 where user_id='".$user_id."'";exit;

mysql_query("update subscription_qualification set status=1 where user_id='$user_id'");
mysql_query("insert into subscription_qualification set order_no='$order_no',user_id='$user_id',subs_fee='$amount',payment_mode='$payment_mode',subs_date='$bonus_date',end_date='$expire_date'");


// end to check subscription is first time
unset($_SESSION['orderno']);
unset($_SESSION['payment_for']);
unset($_SESSION['payment_mode']);
header("Location:qualification.php");
?>