<?php
session_start();
$id=$_SESSION['adid'];
include("connection.php");
$t_date=date('d-m-Y h:i:s');
$mobile=$_REQUEST['mobile'];
//$user=$_REQUEST['loginid'];
$amt=$_REQUEST['amount'];
if($amt>5000)
{

$str="select * from final_e_wallet where user_id='$id'";
$res=mysql_query($str);
$x=mysql_fetch_array($res);
$wa_amt=$x['amount'];
$to_amt=$wa_amt-$amt;
/*
while($x=mysql_fetch_array($res))
{
$amount +=$x['amount'];
}
*/
$update_wallet="insert into investment(user_id,investment_amt,in_date) values('$id','$amt','$t_date')";
$res1=mysql_query($update_wallet);
$update_wallet1="update final_e_wallet set amount='$to_amt' where user_id='$id'";
$res2=mysql_query($update_wallet1);

header('location:../success_reinvest.php');
}
else
{
header('location:../recharge.php');
}
?>
