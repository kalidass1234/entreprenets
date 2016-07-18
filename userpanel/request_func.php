<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
include('../includes/all_func.php');
$idd=$_SESSION['adid'];

$s="select * from registration where (user_name='$idd' OR user_id='$idd')";
$r=mysql_query($s);
$f=mysql_fetch_array($r);
$id=$f['user_id'];

$withdraw_limit=10000;
if(_get_withdraw_today($id,$withdraw_limit))
{
	if($_GET[id]=='peronal')
	{
		$d_te=date('Y-m-d');
		$account_no=$_REQUEST['account_no'];
		$account_name=$_REQUEST['account_name'];
		$bank_name=$_REQUEST['bank_name'];
		$branch_name=$_REQUEST['branch_name'];
		$swift_code=$_REQUEST['swift_code'];
		$routing_no=$_REQUEST['routing_no'];
		$iban_no=$_REQUEST['iban_no'];
		$country=$_REQUEST['country'];
		$state=$_REQUEST['state'];
		$city=$_REQUEST['city'];
		$amount=$_REQUEST['amount'];
		$desc=$_REQUEST['desc'];
		$mamo=$_REQUEST['mamo'];
		$request_type=$_REQUEST['request_type'];
		if($amount>=30)
		{
			# check admin charge
			$sql_charge="SELECT * FROM `master_group_income` where '$amount' between `from` and `to`";
			$res_charge=mysql_query($sql_charge);
			$count_charge=mysql_num_rows($res_charge);
			if($count_charge)
			{
				$row_charge=mysql_fetch_assoc($res_charge);
				$admin_charge=$row_charge['teambv'];
			}
			$str1="select * from final_e_wallet where user_id='$id'";
			$res1=mysql_query($str1);
			$x1=mysql_fetch_array($res1);
			$total =$x1['amount'];
			$amount_new=$amount+$admin_charge;
			//echo $total.'----------------'.$amount;exit;
			if($total>=$amount_new)
			{
				
				if($request_type=='manual')
				{
				
			$str_w="update final_e_wallet set amount=(amount-$amount_new) where user_id='$id'";
			$res_w=mysql_query($str_w);
			//if(!empty($description))
			//{
			$tr="insert into withdraw_fund set user_id='$id',admin_charge='$admin_charge',amount='$amount',ifsc='',acc_name='$account_name',acc_no='$account_no',bank='$bank_name',bank_branch='$branch_name',swift_code='$swift_code',routing_no='$routing_no',iban_no='$iban_no',country='$country',state='$state',city='$city',with_date='$d_te',status=0,admin_status=0,`desc`='$mamo',mode='Personal Account'";
			// echo $tr;exit;
			$re=mysql_query($tr);
			$update_dr="insert into credit_debit(user_id,credit_amt,debit_amt,admin_charge,sender_id,receive_date,ttype,TranDescription,Cause,Remark) values('$id',0,'$amount_new','$admin_charge','','$d_te','','Withdraw Request In Personal Bank Account','','')";
			$res_dr=mysql_query($update_dr);
			/*$update_dr="insert into credit_debit(user_id,credit_amt,debit_amt,sender_id,receive_date,ttype,TranDescription,Cause,Remark) values('$id',0,'$admin_charge','','$d_te','','Administration Fees','','')";
			$res_dr=mysql_query($update_dr);*/
			$msg="Your Request will be Processed Within 2 Business Working Days";
			header("location:request_payout.php?msg=$msg");
			}
				}
				if($request_type=='automatic')
				{
					
					$tr="insert into withdraw_fund set user_id='$id',admin_charge='$admin_charge',amount='$amount',ifsc='',acc_name='$account_name',acc_no='$account_no',bank='$bank_name',bank_branch='$branch_name',swift_code='$swift_code',routing_no='$routing_no',iban_no='$iban_no',country='$country',state='$state',city='$city',with_date='$d_te',status=0,admin_status=0,`desc`='$mamo',mode='Personal Account'";
					$re=mysql_query($tr) or die(mysql_error());
					$msg="Your Request will be processed within transfer day of month";
			header("location:request_payout.php?msg=$msg");
				}
				
			else
			{
				$msg="Insufficient Fund in your Ewallet";
				header("location:request_payout.php?msg_r=$msg");
			}
		}
		else
		{
			$msg="Minimum withdrawal request is 30 Rs";
			header("location:request_payout.php?msg_r=$msg");
		}
	}
	
	if($_GET[id]=='card')
	{
		$d_te=date('Y-m-d');
		$card_name=$_REQUEST['card_name'];
		$card_no=$_REQUEST['card_no'];
		$amount=$_REQUEST['amount'];
		$desc=$_REQUEST['desc'];
		$address1=$_REQUEST['address1'];
		$city=$_REQUEST['city'];
		$state=$_REQUEST['state'];
		$zip=$_REQUEST['zip'];
		$country=$_REQUEST['country'];
		$mamo=$_REQUEST['mamo'];
		//echo $card_name.' '.$card_no.' '.$amount.' '.$desc;
		if($amount>=300)
		{
			# check admin charge
			$sql_charge="SELECT * FROM `master_group_income` where '$amount' between `from` and `to`";
			$res_charge=mysql_query($sql_charge);
			$count_charge=mysql_num_rows($res_charge);
			if($count_charge)
			{
				$row_charge=mysql_fetch_assoc($res_charge);
				$admin_charge=$row_charge['teambv'];
			}
			$str1="select * from final_e_wallet where user_id='$id'";
			$res1=mysql_query($str1);
			$x1=mysql_fetch_array($res1);
			$total =$x1['amount'];
			//echo $total.'----'.$amount;exit;
			$amount_new=$amount+$admin_charge;
			if($total>=$amount_new)
			{
				$str_w="update final_e_wallet set amount=(amount-$amount_new) where user_id='$id'";
				$res_w=mysql_query($str_w);
				//if(!empty($description))
				//{
				$tr="insert into withdraw_fund set user_id='$id',admin_charge='$admin_charge',amount='$amount',ifsc='',acc_name='',acc_no='',bank='',bank_branch='',swift_code='',with_date='$d_te',status=0,`desc`='$mamo',card_name='$card_name',card_no='$card_name',address='$address1',city='$city',state='$state',zip='$zip',country='$country',mode='Cheque'";
				$re=mysql_query($tr);
				$update_dr="insert into credit_debit(user_id,credit_amt,debit_amt,admin_charge,sender_id,receive_date,TranDescription,Remark) values('$id',0,'$amount_new','$admin_charge','','$d_te','Withdraw Request Using Check','Withdraw Request Using Check')";
				$res_dr=mysql_query($update_dr);
				/*$update_dr="insert into credit_debit(user_id,credit_amt,debit_amt,sender_id,receive_date,ttype,TranDescription,Cause,Remark) values('$id',0,'$admin_charge','','$d_te','','Admin Charge Withdrawal Request Using Cheque','','')";
				$res_dr=mysql_query($update_dr);*/
				if($re)
				{
					$msg="Your Request will be Processed Within 2 Business Working Days";
					header("location:card.php?msg=$msg");
				}
			}
			else
			{
				$msg="Insufficient Fund in your Ewallet";
				header("location:card.php?msg_r=$msg");
			}
		}
		else
		{
			$msg="Minimum withdrawal request is 300 USD";
			header("location:card.php?msg_r=$msg");
		}
	}
	
	if($_GET[id]=='shopdeal')
	{
		$d_te=date('Y-m-d');
		$shopdeal_name=$_REQUEST['shopdeal_name'];
		$shopdeal_email=$_REQUEST['shopdeal_email'];
		$amount=$_REQUEST['amount'];
		$desc=$_REQUEST['mamo'];
		if($amount>=300)
		{
			# check admin charge
			$sql_charge="SELECT * FROM `master_group_income` where '$amount' between `from` and `to`";
			$res_charge=mysql_query($sql_charge);
			$count_charge=mysql_num_rows($res_charge);
			if($count_charge)
			{
				$row_charge=mysql_fetch_assoc($res_charge);
				$admin_charge=$row_charge['teambv'];
			}
			$str1="select * from final_e_wallet where user_id='$id'";
			$res1=mysql_query($str1);
			$x1=mysql_fetch_array($res1);
			$total =$x1['amount'];
			$amount_new=$amount+$admin_charge;
			if($total>=$amount_new)
			{
				$str_w="update final_e_wallet set amount=(amount+$amount_new) where user_id='$id'";
				$res_w=mysql_query($str_w);
				//if(!empty($description))
				//{
				$tr="insert into withdraw_fund set user_id='$id',admin_charge='$admin_charge',amount='$amount',with_date='$d_te',status=0,`desc`='$mamo',shopdeal_name='$shopdeal_name',shopdeal_email='$shopdeal_email',mode='shopdeal'";
				//echo $tr;exit;
				$re=mysql_query($tr);
				$update_dr="insert into credit_debit(user_id,credit_amt,debit_amt,admin_charge,sender_id,receive_date,ttype,TranDescription,Cause,Remark) values('$id',0,'$amount_new','$admin_charge','','$d_te','','Withdraw Request In PayPal Account','','')";
				$res_dr=mysql_query($update_dr);
				/*$update_dr="insert into credit_debit(user_id,credit_amt,debit_amt,sender_id,receive_date,ttype,TranDescription,Cause,Remark) values('$id',0,'$admin_charge','','$d_te','','Admin Charge Withdrawal Request In Paypal Account','','')";
				$res_dr=mysql_query($update_dr);*/
				if($re)
				{
					$msg="Your Request will be Processed Within 2 Business Working Days";
					header("location:shopdeal.php?msg=$msg");
				}
			}
			else
			{
				$msg="Insufficient Fund in your Ewallet";
				header("location:shopdeal.php?msg_r=$msg");
			}
		}
		else
		{
			$msg="Minimum withdrawal request is 300 USD";
			header("location:shopdeal.php?msg_r=$msg");
		}
	}
	
	if($_GET[id]=='vtncard')
	{
	$d_te=date('Y-m-d');
	$shopdeal_name=$_REQUEST['shopdeal_name'];
	$card_no=$_REQUEST['card_no'];
	$amount=$_REQUEST['amount'];
	$desc=$_REQUEST['mamo'];
	
	if($amount>=300)
	{
	# check admin charge
	$sql_charge="SELECT * FROM `master_group_income` where '$amount' between `from` and `to`";
	$res_charge=mysql_query($sql_charge);
	$count_charge=mysql_num_rows($res_charge);
	if($count_charge)
	{
	$row_charge=mysql_fetch_assoc($res_charge);
	$admin_charge=$row_charge['teambv'];
	}
	$str1="select * from final_e_wallet where user_id='$id'";
	$res1=mysql_query($str1);
	$x1=mysql_fetch_array($res1);
	$total =$x1['amount'];
	$amount_new=$amount-$admin_charge;
	if($total>=$amount_new)
	{
		$str_w="update final_e_wallet set amount=(amount-$amount) where user_id='$id'";
		$res_w=mysql_query($str_w);
		//if(!empty($description))
		//{
		$tr="insert into withdraw_fund set user_id='$id',admin_charge='$admin_charge',amount='$amount_new',with_date='$d_te',status=0,`desc`='$mamo',vtn_cardname='$shopdeal_name',vtn_cardno='$card_no',mode='vtncard'";
		//echo $tr;exit;
		$re=mysql_query($tr);
		$update_dr="insert into credit_debit(user_id,credit_amt,debit_amt,admin_charge,sender_id,receive_date,ttype,TranDescription,Cause,Remark) values('$id',0,'$amount','$admin_charge','','$d_te','','Withdraw Request In VTN Card','','')";
		$res_dr=mysql_query($update_dr);
		/*$update_dr="insert into credit_debit(user_id,credit_amt,debit_amt,sender_id,receive_date,ttype,TranDescription,Cause,Remark) values('$id',0,'$admin_charge','','$d_te','','Admin Carge Withdrawal Request In VTN Card','','')";
		$res_dr=mysql_query($update_dr);*/
		if($re)
		{
			$msg="Your Request will be Processed Within 2 Business Working Days";
			header("location:shopdeal_vtncard.php?msg=$msg");
		}
		}
		else
		{
			$msg="Insufficient Fund in your Ewallet";
			header("location:shopdeal_vtncard.php?msg_r=$msg");
		}
	}
	else
	{
		$msg="Minimum withdrawal request is 300 USD";
		header("location:shopdeal_vtncard.php?msg_r=$msg");
	}
}
/*else
{
	$arr_redirect=array("peronal"=>"request_payout.php","card"=>"card.php",""=>"",""=>"");
	$redirect=$arr_redirect[$_GET['id']];
	header("location:".$redirect."?msg_r=Over withdraw limit.");
}*/
	}
?>
