<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
include('../includes/all_func.php');
$idd=$_SESSION['SD_User_Name'];

$s="select * from registration where user_name='$idd'";
$r=mysql_query($s);
$f=mysql_fetch_array($r);
$id=$f['user_id'];

if($_REQUEST['page']=='total')
{
	$d_te=date('Y-m-d');
	$username=$_REQUEST['username'];
	$bidcount=$_REQUEST['bid_count'];
// check username
	$sql_check="select id,user_id from registration where user_name='$username' or user_id='$username'";
	$res_check=mysql_query($sql_check);
	$row_check=mysql_fetch_assoc($res_check);
	$count_check=mysql_num_rows($res_check);
	if($count_check>0)
	{	
// end to check username	
		if($bidcount>=5)
		{
		$str1="select * from bid_user_final where user_id='$id'";
		$res1=mysql_query($str1);
		$x1=mysql_fetch_array($res1);
		 $total =$x1['remain_bid_count'];
			if($total>=$bidcount)
			{
				$str_w="update bid_user_final set remain_bid_count=(remain_bid_count-$bidcount) where user_id='$id'";
				$res_w=mysql_query($str_w);
				
				$update_dr="insert into bid_transfer_history(user_id,credit_bid,debit_bid,sender_id,receiver_id,remark,transaction_date) values('$id',0,'$bidcount','$id','$row_check[user_id]','Bid Transfer To User $row_check[user_id] Account','$d_te')";
				$res_dr=mysql_query($update_dr);
				
				$str_w="update bid_user_final set remain_bid_count=(remain_bid_count+$bidcount) where user_id='$row_check[user_id]'";
				$res_w=mysql_query($str_w);
				
				$update_dr="insert into bid_transfer_history(user_id,credit_bid,debit_bid,sender_id,receiver_id,remark,transaction_date) values('$row_check[user_id]','$bidcount','0','$id','$row_check[user_id]','Bid Transfer By User $id','$d_te')";
				$res_dr=mysql_query($update_dr);
				
					$msg="You Successfully Transfer Bid";
					header("location:total_bid.php?msg=$msg");
				
			}
			else
			{
				$msg="Insufficient Bid in your Account";
				header("location:total_bid.php?msg_r=$msg");
			}
		}
		else
		{
			$msg="Minimum transfer bid is 5";
			header("location:total_bid.php?msg_r=$msg");
		}
	}
	else
	{
		$msg="Wrong Member Id";
		header("location:total_bid.php?msg_r=$msg");
	}
}

else if($_REQUEST['page']=='trade')
{
		$d_te=date('Y-m-d');
	$username=$_REQUEST['username'];
	$bidcount=$_REQUEST['bid_count'];
// check username
	$sql_check="select id,user_id from registration where user_name='$username' or user_id='$username'";
	$res_check=mysql_query($sql_check);
	$row_check=mysql_fetch_assoc($res_check);
	$count_check=mysql_num_rows($res_check);
	if($count_check>0)
	{	
// end to check username
		if($bidcount>=5)
		{
				$str_w="update bid_user_final set remain_bid_count=(remain_bid_count-$bidcount) where user_id='$id'";
				$res_w=mysql_query($str_w);
				
				$update_dr="insert into bid_transfer_history(user_id,credit_bid,debit_bid,sender_id,receiver_id,remark,transaction_date) values('$id',0,'$bidcount','$id','vanle','Bid Transfer To Admin For Trading','$d_te')";
				$res_dr=mysql_query($update_dr);
				
				$total_amount=$bidcount*0.5;
				$check_admin="select CAST(`amount` AS SIGNED) as amount from final_e_wallet where user_id='vanle'";
				$res_admin=mysql_query($check_admin);
				$row_admin=mysql_fetch_assoc($res_admin);
				if($row_admin['amount']>=$total_amount)
				{
					mysql_query("update final_e_wallet set amount=amount-$total_amount where user_id='vanle'");
					mysql_query("insert into credit_debit(user_id,credit_amt,debit_amt,receiver_id,sender_id,receive_date,ttype,TranDescription,Cause,Remark,invoice_no,status,paid_status) values('vanle','0','$total_amount','$id','vanle',curdate(),'','Paid To Buyer For Trading Bid','','Paid For Trade Bid','','1','1')");
					mysql_query("update final_e_wallet set amount=amount+$total_amount where user_id='$id'");
					mysql_query("insert into credit_debit(user_id,credit_amt,debit_amt,receiver_id,sender_id,receive_date,ttype,TranDescription,Cause,Remark,invoice_no,status,paid_status) values('$id','$total_amount','0','$id','vanle',curdate(),'','Get Credit For Trading Bid','','Get Credit For Trading Bid','','1','1')");
				}
				else
				{
					mysql_query("insert into bid_trade_request set user_id='$id',bid_count='$bidcount',remark='I Want To Trade My Bids.',request_date='$d_te'");
					$msg="You Request Successfully Sent";
				}
					header("location:trade_bid.php?msg=$msg");
		}
		else
		{
			$msg="Minimum bid trading is 5";
			header("location:trade_bid.php?msg_r=$msg");
		}
	}
	else
	{
		$msg="Wrong Member Id";
		header("location:trade_bid.php?msg_r=$msg");
	}
}	
?>
