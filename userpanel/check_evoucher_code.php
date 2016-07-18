<?php
include("../includes/all_func.php");
session_start();
//echo "<pre>"; print_r($_SESSION); 
//print_r($_POST);
$t_date=date('Y-m-d');
if(isset($_SESSION['category']))
{
	if($_SESSION['category']==1){ $return_page='member-secure_account_upgrade.php';}
	if($_SESSION['category']==2){ $return_page='member-secure_two_account_upgrade.php';}
	if($_SESSION['category']==3){ $return_page='member-secure_three_account_upgrade.php';}
	$amount=$_SESSION['amount'];
	
	$sql_pin="select * from pins where status=0 and amount='$amount' and pin_no='$_POST[pin]'";
	$res_pin=mysql_query($sql_pin);
	$count_pin=mysql_num_rows($res_pin);
	if($count_pin>0)
	{
		mysql_query("update pins set status=1,t_date='$t_date' where pin_no='$_POST[pin]'");
		function meberins()
		 {
		  //$encypt1=uniqid(rand(), true);
		  $encypt1=uniqid(rand(1000000000,9999999999), true);
		  $usid1=str_replace(".", "", $encypt1);
		  $pre_userid = substr($usid1, 0, 10);
		  
		  $checkid=mysql_query("select transaction_no from registration where transaction_no='$pre_userid'");
		  if(mysql_num_rows($checkid)>0)
		  {
		   meberins();
		  }
		  else
		   return $pre_userid;
		 }
		$_SESSION['order_no']=meberins();
		echo "<script type='text/javascript'>window.location.href='../upgrade.php';</script>";exit;
	}
	else
	{
		//$return_page=$_POST['return_page'];
		echo "<script type='text/javascript'>alert('Wrong Voucher Code.');window.location.href='$return_page';</script>";exit;
	}		
}
?>