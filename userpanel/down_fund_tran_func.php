<?php
session_start();
$idd=$_SESSION['SD_User_Name'];
include('../includes/all_func.php');

$s="select * from registration where user_name='$idd'";
$r=mysql_query($s);
$f=mysql_fetch_array($r);
$id=$f['user_id'];

$t_date=date('Y-m-d');
$user=$_REQUEST['loginid'];
$amt=$_REQUEST['max_amt'];
$remark=$_REQUEST['remark'];
$tpass=$_REQUEST['tpass'];
$str="select * from final_e_wallet where user_id='$id'";
$res=mysql_query($str);
$x=mysql_fetch_array($res);
$wa_amt=$x['amount'];
$charge=0;

$sql=mysql_query("select * from registration where user_id='$user' or  user_name='$user'");
$count=mysql_num_rows($sql);
$ff_u=mysql_fetch_array($sql);
$user=$ff_u[user_id];
$first_name=$ff_u[first_name];

if($count>0){
if($wa_amt>=$amt)
{

$sql_charge="SELECT * FROM `master_group_income` where '$amount' between `from` and `to`";
$res_charge=mysql_query($sql_charge);
$count_charge=mysql_num_rows($res_charge);
if($count_charge)
{
	$row_charge=mysql_fetch_assoc($res_charge);
	$admin_charge=$row_charge['teambv'];
}
	$amount_new=$amt-$admin_charge;		
$update_wallet1="update final_e_wallet set amount=(amount-$amt) where user_id='$id'";
$res2=mysql_query($update_wallet1);
$sql=mysql_query("select * from final_e_wallet where user_id='$id'");
	$f_current=mysql_fetch_array($sql);

$update_wallet2="update final_e_wallet set amount=(amount+$amount_new) where user_id='$user'";
$res3=mysql_query($update_wallet2);

$sql2=mysql_query("select * from final_e_wallet where user_id='$user'");
	$f_current2=mysql_fetch_array($sql2);

$update_wallet="insert into user_fund_transfer(user_id,amount,t_date,sender) values('$user','$amount_new','$t_date','$id')";
$res1=mysql_query($update_wallet);


$update_cr="insert into credit_debit(user_id,credit_amt,debit_amt,admin_charge,receiver_id,sender_id,receive_date,ttype,TranDescription,Cause,Remark,final_bal) values('$user','$amount_new','0','0','$user','$id','$t_date','','Fund Received By $f[user_name]','','','$f_current2[amount]')";
$res_cr=mysql_query($update_cr);
$update_dr="insert into credit_debit(user_id,credit_amt,debit_amt,admin_charge,receiver_id,sender_id,receive_date,ttype,TranDescription,Cause,Remark,final_bal) values('$id',0,'$amt','$admin_charge','$user','$id','$t_date','','Request Amount Transfer To $ff_u[user_name]','','','$f_current[amount]')";
$res_dr=mysql_query($update_dr);



	if($admin_charge>0)
	{
	$str_charge="update final_e_wallet set amount=(amount-$admin_charge) where user_id='$id'";
	$res_charge=mysql_query($str_charge);
	
	$sql_charge=mysql_query("select * from final_e_wallet where user_id='$id'");
	$f_charge=mysql_fetch_array($sql_charge);
	
	
	
	/*$update_charge="insert into credit_debit(user_id,credit_amt,debit_amt,sender_id,receive_date,ttype,TranDescription,Cause,Remark,final_bal) values('$id',0,'$admin_charge','','$t_date','','Fund Transfer Charges','','','$f_charge[amount]')";
	$res_dr=mysql_query($update_charge);}*/
	
	
	$final_admin=mysql_query("update final_e_wallet set amount=(amount+$admin_charge) where user_id='mark'");
	$sql_admin=mysql_query("select * from final_e_wallet where user_id='mark'");
	$f_admin=mysql_fetch_array($sql_admin);
	
	$update_cr1=mysql_query("insert into credit_debit(user_id,credit_amt,debit_amt,receiver_id,sender_id,receive_date,ttype,TranDescription,Cause,Remark,final_bal,mode) values('david','$admin_charge','0','mark','$id',curdate(),'','Income From Fund Transfer Charges','','Registration Through E-wallet','$f_admin[amount]','charge')");
	}
	$msg="You have transferred funds successfully";
	header("location: fund_trans.php?msg=$msg");
	
}
else
{
$msg="Insufficient Amount";
header("location: fund_trans.php?msg=$msg");
}
}
else
{
$msg="Wrong Member ID";
header("location: fund_trans.php?msg=$msg"); 

}
?>
