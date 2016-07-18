<?php
include('../includes/all_func.php');
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	$user_id=showuserid($_SESSION['SD_User_Name']);
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";
	header("Location:login.php");
	exit;
}

//echo "<pre>";print_r($_POST);
$curdate=date('Y-m-d H:i:s');
// condition to check transaction password
$sql_t="select id from registration where t_code='$_POST[password]' and user_id='$user_id'";
$res_t=mysql_query($sql_t);
$count_t=mysql_num_rows($res_t);
if($count_t>0)
{
	# check the org must be selected
	/*if($_POST['charity_org']=='')
	{
		echo "<script language='javascript'>alert('Please Select Charity Org.'); window.location.href='charity.php';</script>";
	}
	else
	{*/
		# check fund is available in e-wallet
		$sql_w="select CAST(amount as SIGNED) as amount from final_e_wallet where user_id='$user_id'";
		$res_w=mysql_query($sql_w);
		$row_w=mysql_fetch_assoc($res_w);
		if($row_w['amount']>=$_POST['amount'])
		{
			# make donation
			mysql_query("update final_e_wallet set amount=amount-$_POST[amount] where user_id='$user_id'");
			mysql_query(" insert into credit_debit set user_id='$user_id',credit_amt='0',debit_amt='$_POST[amount]',receiver_id='vanle',sender_id='$user_id',TranDescription='Make Donation for charity organization',Remark='Make Donation for charity organization',status=1,paid_status=1,receive_date='$curdate'");
			
			mysql_query("update final_e_wallet set amount=amount+$_POST[amount] where user_id='vanle_charity'");
			mysql_query(" insert into credit_debit set user_id='$user_id',credit_amt='$_POST[amount]',debit_amt='0',receiver_id='vanle',sender_id='$user_id',TranDescription='Receive Donation for charity organization',Remark='Receive Donation for charity organization',status=1,paid_status=1,receive_date='$curdate'");
			
			//mysql_query("update charity_org set fund_amount=fund_amount+$_POST[amount] where id='$_POST[charity_org]'");
			mysql_query("insert into charity_org_donate set charity_id='$_POST[charity_org]',user_id='$user_id',donate_amount='$_POST[amount]',donate_date='$curdate'");
			echo "<script language='javascript'>alert('You Make Donation Successfully.'); window.location.href='charity.php';</script>";
		}
		else
		{
			echo "<script language='javascript'>alert('No Sufficient Fund In Your E-wallet.'); window.location.href='charity.php';</script>";
		}
	/*}*/
}
else
{
	echo "<script language='javascript'>alert('Wrong Transaction Password'); window.location.href='charity.php';</script>";
}
?>