<?php
error_reporting(E_ALL ^ E_NOTICE);
include('../includes/all_func.php');
session_start();

//print_r($_GET);
//exit;
$add_by=$_SESSION['SD_User_Name'];
	$s="select user_id,paid_to,paypal_account from registration where user_name='$add_by'";
	$r=mysql_query($s);
	$resuser=mysql_fetch_array($r);
	$userid=$resuser['user_id'];
	$curdate=date('Y-m-d');
	$admincharge=$_SESSION['amount1']-$_SESSION['amount'];
	
	if($_GET['mode']=='debit')
	{
		$t_no=$_SESSION['t_no'];
		if($_POST['cardtype']!='add')
		{
			$sqlcard="select * from card_info where id='$_POST[cardtype]'";
			$rescard=mysql_query($sqlcard);
			$rowcard=mysql_fetch_assoc($rescard);
			$card_name=$rowcard['card_name'];
			$card_no=$rowcard['card_no'];
			$cvs_no=$rowcard['cvs_no'];
			$expiry_month_year=$rowcard['expiry_month_year'];
		}
		else
		{
			$card_name=$_POST['card_name'];
			$card_no=$_POST['card_no'];
			$cvs_no=$_POST['cvs_no'];
			$expiry_month_year=$_POST['exmonth'].'-'.$_POST['exyy'];
		}
	}
	else if($_GET['mode']=='paypal')
	{
		$t_no=$_GET['order_no'];
	}
	$mode=$_GET['mode'];
	$sqlinsert="INSERT INTO `add_money` (`transaction_no`, `user_id`, `admin_charge`, `amount`, `total_amount`, `pay_mode`, `status`, `pay_date`, `card_name`, `card_no`, `cvs_no`,`expiry_month_year`) VALUES ( '$t_no', '$userid', '$admincharge', '$_SESSION[amount]', '$_SESSION[amount1]', '$mode', '0', '$curdate', '$card_name', '$card_no', '$cvs_no','$expiry_month_year')";
	//echo $sqlinsert;exit;
	mysql_query($sqlinsert);

mysql_query("update final_e_wallet set amount=amount+$_SESSION[amount] where user_id='$userid'");

$update_cr1=mysql_query("insert into credit_debit(user_id,credit_amt,debit_amt,receiver_id,sender_id,receive_date,ttype,TranDescription,Cause,Remark,transaction_no,status,paid_status) values('$userid','$_SESSION[amount]','0','$userid','vanle','$curdate','','Recharge E-wallet using $_POST[payout]','','Recharge E-wallet using $_POST[payout]','$_SESSION[t_no]','1','1')");

// get merchant amount
	/*$sql_cm_ew1="select  CAST(`amount` AS SIGNED) as amount from final_e_wallet where user_id='$userid'";
	$res_cm_ew1=mysql_query($sql_cm_ew1);
	$row_cm_ew1=mysql_fetch_assoc($res_cm_ew1);
	$pending_tcm=$row_cm_ew1['amount'];*/
	
	sent_mail_to_vip($userid,$_SESSION['amount'],$admincharge,'Recharge E-walle',$mode,$t_no);
	//exit;
	$curdate=date('Y-m-d');

$sql_cm="select * from cashback_merchant where seller_id='$userid' and status=0 and section<>'market_place'";
$res_cm=mysql_query($sql_cm);
$num_cm=mysql_num_rows($res_cm);
while($row_cm=mysql_fetch_assoc($res_cm))
{
	$pending_cm=$row_cm['price'];
	$sql_cm_ew="select  CAST(`amount` AS SIGNED) as amount from final_e_wallet where user_id='$userid'";
	$res_cm_ew=mysql_query($sql_cm_ew);
	$row_cm_ew=mysql_fetch_assoc($res_cm_ew);
		if($row_cm_ew['amount']>=$pending_cm)
		{
			mysql_query("update final_e_wallet set amount=(amount-$pending_cm) where user_id='$userid'");
			$cashbackstatus1=1;
			$pending_tcm+=$pending_cm;
			
			mysql_query("insert into credit_debit(user_id,credit_amt,debit_amt,receiver_id,sender_id,receive_date,ttype,TranDescription,Cause,Remark,invoice_no,status,paid_status) values('$userid','','$row_cm[price]','Distribute to all','$userid','$curdate','','Seller $row_cm[remark]','','Seller $row_cm[remark]','','1','1')");
		}
		else
		{
			$cashbackstatus1=0;
		}
		mysql_query("update cashback_merchant set status='$cashbackstatus1' where id='$row_cm[id]'");
}


$sql="select * from cashback_user where seller_id='$userid' and paid_status=0 and section<>'market_place'";
			$res=mysql_query($sql);
			while($row=mysql_fetch_assoc($res))
			{
				if($pending_tcm>=$row['find_cashback'])
				{
				    $pending_tcm=$pending_tcm-$row['find_cashback'];
					if(showmemtype($row[income_id]) || $row[income_id]=='vanle')
					{
						$final_ewallet3=mysql_query("update final_e_wallet set amount=(amount+$row[find_cashback]) where user_id='$row[income_id]'");
						mysql_query("update cashback_user set status=1 where id='$row[id]' ");
						mysql_query("insert into credit_debit(user_id,credit_amt,debit_amt,receiver_id,sender_id,receive_date,ttype,TranDescription,Cause,Remark,invoice_no,status,paid_status) values('$row[income_id]','$row[find_cashback]','0','$row[income_id]','$userid','$curdate','','$row[remark]','','$row[remark]','','1','1')");
					}
					mysql_query("update cashback_user set paid_status=1 where id='$row[id]' ");
					//mysql_query("update credit_debit set paid_status=1 where id='$row[credit_debit_id]' ");
				}
			}
			
$sql="select * from level_income where seller_id='$userid' and paid_status=0 and section<>'market_place'";
			$res=mysql_query($sql);
			while($row=mysql_fetch_assoc($res))
			{
				//echo $pending_tcm.'>='.$row['commission'].'<br>';
				if($pending_tcm>=$row['commission'])
				{
				$pending_tcm=$pending_tcm-$row['commission'];
					if(showmemtype($row[income_id]) || $row[income_id]=='vanle')
					{
						$final_ewallet3=mysql_query("update final_e_wallet set amount=(amount+$row[commission]) where user_id='$row[income_id]'");
						mysql_query("update level_income set status=1 where l_id='$row[l_id]' ");
						//mysql_query("update credit_debit set status=1 where id='$row[credit_debit_id]' ");
						//echo "insert into credit_debit(user_id,credit_amt,debit_amt,receiver_id,sender_id,receive_date,ttype,TranDescription,Cause,Remark,invoice_no,status,paid_status) values('$row[income_id]','$row[commission]','0','$row[income_id]','$userid','$curdate','','$row[remark]','','$row[remark]','','1','1')";
						//echo "<br>";
						mysql_query("insert into credit_debit(user_id,credit_amt,debit_amt,receiver_id,sender_id,receive_date,ttype,TranDescription,Cause,Remark,invoice_no,status,paid_status) values('$row[income_id]','$row[commission]','0','$row[income_id]','$userid','$curdate','','$row[remark]','','$row[remark]','','1','1')");
					}
					
					//echo "update level_income set paid_status=1 where l_id='$row[l_id]' ";
					//echo "<br>";
					mysql_query("update level_income set paid_status=1 where l_id='$row[l_id]' ");
					//mysql_query("update credit_debit set paid_status=1 where id='$row[credit_debit_id]' ");
				}
			}
			
			$sql="select * from level_income_admin where seller_id='$userid' and paid_status=0 and section<>'market_place'";
			$res=mysql_query($sql);
			while($row=mysql_fetch_assoc($res))
			{
				//echo $pending_tcm.'>='.$row['commission'].'<br>';
				if($pending_tcm>=$row['commission'])
				{
				$pending_tcm=$pending_tcm-$row['commission'];
					if(showmemtype($row[income_id]) || $row[income_id]=='vanle')
					{
						$final_ewallet3=mysql_query("update final_e_wallet set amount=(amount+$row[commission]) where user_id='$row[income_id]'");
						mysql_query("update level_income_admin set status=1 where l_id='$row[l_id]' ");
						//mysql_query("update credit_debit set status=1 where id='$row[credit_debit_id]' ");
						//echo "insert into credit_debit(user_id,credit_amt,debit_amt,receiver_id,sender_id,receive_date,ttype,TranDescription,Cause,Remark,invoice_no,status,paid_status) values('$row[income_id]','$row[commission]','0','$row[income_id]','$userid','$curdate','','$row[remark]','','$row[remark]','','1','1')";
						//echo "<br>";
						mysql_query("insert into credit_debit(user_id,credit_amt,debit_amt,receiver_id,sender_id,receive_date,ttype,TranDescription,Cause,Remark,invoice_no,status,paid_status) values('$row[income_id]','$row[commission]','0','$row[income_id]','$userid','$curdate','','$row[remark]','','$row[remark]','','1','1')");
					}
					
					//echo "update level_income set paid_status=1 where l_id='$row[l_id]' ";
					//echo "<br>";
					mysql_query("update level_income_admin set paid_status=1 where l_id='$row[l_id]' ");
					//mysql_query("update credit_debit set paid_status=1 where id='$row[credit_debit_id]' ");
				}
			}
/*$sql="select * from cashback_user where seller_id='$userid' and status=0";
$res=mysql_query($sql);
while($row=mysql_fetch_assoc($res))
{
	$sql1="select * from admin_cashback where section='merchant_circle'";
	$res1=mysql_query($sql1);
	$row1=mysql_fetch_assoc($res1);
	$buyer_per=$row1['buyer_per'];
	$shopdeal_per=$row1['shopdeal_per'];
	$uplines_per=$row1['uplines_per'];
	// end check % set by admin
	$curdate=date('Y-m-d');
	// first % goes to buyer
	$total=0;
	$total=$price*$cashback/100;
	$buyer_cashback=$total*$buyer_per/100;
	
	if(check_e_wallet_set_cashback($row['user_id'],$userid,$row['find_cashback']))
	{
		$final_ewallet3=mysql_query("update final_e_wallet set amount=(amount+$buyer_cashback) where user_id='$row[user_id]'");
		$cashbackstatus1=1;
	}
	else
	{
		$cashbackstatus1=0;
	}
	mysql_query("update cashback_user set status=$cashbackstatus1,modify_date='$curdate' where id=$row[id]");
}*/
unset($_SESSION['amount1']);
unset($_SESSION['amount']);
//exit;
echo "<script language='javascript'>alert('Thnk You For Recharge Your E-wallet');window.location.href='index.php';</script>";exit;
?>