<?php
include('config/directory.php');
include("config/config.php");
if(isset($_REQUEST['confirm']) && $_REQUEST['confirm']=='confirm')
			{
				$id=$_REQUEST['id'];
				$modify_date=date('Y-m-d');
				mysql_query("update finance_request set status=1,accept_date='$modify_date' where id='$id' and status=0");
				// update wallet
				// get the amount and user id
				$sql_money="select * from finance_request where id='$id' and status=1";
				$res_money=mysql_query($sql_money);
				while($row_money=mysql_fetch_assoc($res_money))
				{
					$user_id=$row_money['user_id'];
					$amount=$row_money['amount'];
					$user_id=$row_money['user_id'];
				mysql_query("update final_e_wallet set amount=amount+$amount where user_id='$user_id'");
	mysql_query("insert into credit_debit set user_id='$user_id',credit_amt='$amount',debit_amt='0',receiver_id='$user_id',sender_id='$user_id',receive_date='$modify_date',Remark='Financial Request',TranDescription='Financial Request'");
				}
				header("Location:admin_main.php?page_number=174");
			}
?>