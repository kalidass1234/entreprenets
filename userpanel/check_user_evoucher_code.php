<?php
include("../includes/all_func.php");
session_start();
//echo "<pre>"; print_r($_SESSION); 
//print_r($_POST);
$t_date=date('Y-m-d');
if(isset($_SESSION['category']))
{
	if($_SESSION['category']==3){ $return_page='member-secure.php';}
	if($_SESSION['category']==2){ $return_page='member-secure_two.php';}
	if($_SESSION['category']==3){ $return_page='member-secure_three.php';}
	// check if user subscription expire till 72 hour the 25 dollor add in amount
	$user_id=showuserid($_SESSION['SD_User_Name']);
	$category=$_SESSION['category'];
	$sql_subs="select * from subscription where user_id='$user_id'  and type='$category'";
	$res_subs=mysql_query($sql_subs);
	$count_subs=mysql_num_rows($res_subs);
	if($count_subs)
	{
		// check for 72 hour 
		$row_subs=mysql_fetch_assoc($res_subs);
		if($row_subs['status']==1 || $row_subs['status']==2)
		{
			$end_date=strtotime($row_subs['update_time']);
			$curdate=time();
			$diff=floor(($curdate-$end_date)/8640);
			if($diff>=72)
			{
				$penalty=25;
			}
			else
			{
				$penalty=0;
			}
		}
	}
	// end of the penalty	
	$amount=$_SESSION['amount']+$penalty;
	
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
		echo "<script type='text/javascript'>window.location.href='../upgrade_one.php';</script>";exit;
	}
	else
	{
		//$return_page=$_POST['return_page'];
		echo "<script type='text/javascript'>alert('Wrong Voucher Code.');window.location.href='$return_page';</script>";exit;
	}		
}
?>