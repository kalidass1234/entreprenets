<?php
include("../includes/all_func.php");
if($_SESSION['Session_Rand_No']==$_REQUEST['Session_id'])
{
}
else
{
	header("Location:load_cashwallet.php?msg=wrong url access"); exit;
}
$user_id=showuserid($_SESSION['SD_User_Name']);
$bonus_date=date('Y-m-d');
// check the transaction password and match the amount to be deducted

//echo "<pre>"; print_r($_SESSION);

$amount=$_SESSION['amount'];
$payment_mode=$_SESSION['payment_mode'];
$orderno=$_SESSION['orderno'];
$pay_date=date('Y-m-d');
if($payment_mode=='Bank Wire')
{
	$insert=" insert into add_money set transaction_no='$orderno',user_id='$user_id',amount='$amount',total_amount='$amount',pay_mode='$payment_mode',pay_date='$pay_date'";
	mysql_query($insert);
}
else if($payment_mode=='Paypal')
{
 $insert=" insert into add_money set transaction_no='$orderno',user_id='$user_id',amount='$amount',total_amount='$amount',pay_mode='$payment_mode',pay_date='$pay_date',status=1";
	mysql_query($insert);
	// update the final_e_wallet and credit debit
	mysql_query("update final_e_wallet set amount=amount+$amount where user_id='$user_id'");
	mysql_query("insert into credit_debit set user_id='$user_id',credit_amt='$amount',debit_amt='0',receiver_id='$user_id',sender_id='$user_id',receive_date='$pay_date',Remark='Load Wallet',TranDescription	='Load Wallet'");
}

// end to check subscription is first time
unset($_SESSION['orderno']);
unset($_SESSION['payment_for']);
unset($_SESSION['payment_mode']);
unset($_SESSION['amount']);
header("Location:load_cashwallet.php?payment=true");
?>