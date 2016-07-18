<?php
#======================================================================================#
# This cron execute once in a day tipicaly at 01:00 am and expire the product and related
# auctions that are expire at previous day
# If product choose for auto relist . Relist Product and auction that have option of auto relist
# 23-08-2013
include('../../includes/all_func.php');
$obj_mp=new Market_place();
$current_date=date('Y-m-d');
$curdate=date('Y-m-d H:i:s');
$newdate = strtotime ( '- 1 day' , strtotime ( $current_date ) ) ;
$previous_date=date('Y-m-d H:i:s',$newdate);
$acceptdate=strtotime ( '- 30 day' , strtotime ( $previous_date ) ) ;
$accept_date=date('Y-m-d H:i:s',$acceptdate);
# check the accept external cashback
$sql="select * from external_cashback_request where status_user=1 and holding_date<='$curdate'";
$res=mysql_query($sql);
while($row=mysql_fetch_assoc($res))
{
	$request_id=$row['id'];
	pay_cash_back_set_by_merchant_external($request_id);
	mysql_query("update external_cashback_request set status_user=3,read_user=1,read_seller=1 , paid_date='$curdate' where id='$request_id'");
}

# check Market Place Cashback Hold By Admin 30 days
$sql_m="select * from cashback_merchant where main_section='market_place' and paid_status=0 and holding_date<='$curdate'";
$res_m=mysql_query($sql_m);
while($row_m=mysql_fetch_assoc($res_m))
{
	if($row_m['status']==1)
	{
	 	$obj_mp->pay_cash_back_set_by_merchant_external($row_m['invoice_no'],$row_m['section']);
    }
	else if($row_m['status']==0)
	{
		$userid=$row_m['user_id'];
		$sql_final="select CAST(`amount` AS SIGNED) as amount from final_e_wallet where user_id='$userid'";
		$res_final=mysql_query($sql_final);
		$row_final=mysql_fetch_assoc($res_final);
		if($row_final['amount']>=$row_m['price'])
		{
			$amount=$row_m['price'];
			$seller_id=$row_m['seller_id'];
			mysql_query("update final_e_wallet set amount=(amount+$amount) where user_id='vanle'");
			$update_cr1=mysql_query("insert into credit_debit(user_id,credit_amt,debit_amt,receiver_id,sender_id,receive_date,ttype,TranDescription,Cause,Remark,invoice_no,status,paid_status) values('vanle','$amount','0','vanle','$seller_id',curdate(),'','Get Cashback Holding For 30 Days ','','Get Cashback Holding For 30 Days','','1','1')");
			
			mysql_query("update final_e_wallet set amount=(amount-$amount) where user_id='$seller_id'");
			$update_cr1=mysql_query("insert into credit_debit(user_id,credit_amt,debit_amt,receiver_id,sender_id,receive_date,ttype,TranDescription,Cause,Remark,invoice_no,status,paid_status) values('$seller_id','0','$amount','vanle','$seller_id',curdate(),'','Paid Cashback To Buyer Shopdeal and Uplines','','Paid Cashback To Buyer Shopdeal and Uplines','','1','1')");
		
			$obj_mp->pay_cash_back_set_by_merchant_external($row_m['invoice_no'],$row_m['section']);
		}
	}
}
?>