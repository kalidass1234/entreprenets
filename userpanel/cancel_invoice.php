<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include('../includes/all_func.php');
$obj_mp=new Market_Place();
$invoice_no=$_REQUEST['invoice_no'];
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
$idd=$_SESSION['SD_User_Name'];
$user_id=showuserid($idd);
$target=$_REQUEST['target'];
//echo "<pre>"; print_r($_REQUEST);exit;	
	if($target=='request')
	{
		// get detail about the invoice is wrong or right
		$sql="select * from amount_detail where invoice_no='$invoice_no' and section='market_place' and user_id='$user_id'";
		$res=mysql_query($sql);
		$count=mysql_num_rows($res);
		if($count>0)
		{
			$row=mysql_fetch_assoc($res);
			$seller_id=$row['seller_id'];
			$purchase_date=$row['purchase_date'];
			$request_date=date('Y-m-d H:i:s');
			mysql_query("insert into purchase_cancel set invoice_no='$invoice_no', user_id='$user_id', seller_id='$seller_id',purchase_date='$purchase_date',request_date='$request_date', read_seller=1");
			$seller_name=showusername($seller_id);
			echo "<script language='javascript'>alert('Cancel Request of Invoice $invoice_no Sent To Seller $seller_name ');window.location.href='purchase_order1.php';</script>";exit;
		}
		else
		{
			echo "<script language='javascript'>alert('Wrong Invoice Request For Cancel');window.location.href='purchase_order1.php';</script>";exit;
		}
	}
	
	else if($target=='cancel')
	{
		$sql="select * from amount_detail where invoice_no='$invoice_no' and section='market_place' and seller_id='$user_id'";
		$res=mysql_query($sql);
		$count=mysql_num_rows($res);
		if($count>0)
		{
			$row=mysql_fetch_assoc($res);
			$user_id=$row['user_id'];
			$purchase_date=$row['purchase_date'];
			$response_date=date('Y-m-d H:i:s');
			mysql_query("update purchase_cancel set status=2 , response_date='$response_date',read_user=1 where invoice_no='$invoice_no'");
		}
		else
		{
			echo "<script language='javascript'>alert('Wrong Invoice Request For Cancel');window.location.href='sell_order1.php';</script>";exit;
		}
		echo "<script language='javascript'>alert('Invoice Request  Cancel');window.location.href='sell_order1.php';</script>";exit;	
	}
	else if($target=='accept')
	{
		$sql="select * from amount_detail where invoice_no='$invoice_no' and section='market_place' and seller_id='$user_id'";
		$res=mysql_query($sql);
		$count=mysql_num_rows($res);
		if($count>0)
		{
			$row=mysql_fetch_assoc($res);
			$user_id=$row['user_id'];
			$purchase_date=$row['purchase_date'];
			$response_date=date('Y-m-d H:i:s');
			//
			
			$obj_mp->cancel_cashback_agains_invoice($invoice_no);
			echo "<script language='javascript'>alert('Cancel Invoice $invoice_no');window.location.href='sell_order1.php';</script>";exit;
		}
		else
		{
			echo "<script language='javascript'>alert('Wrong Invoice Request For Cancel');window.location.href='sell_order1.php';</script>";exit;
		}
	}
}
else
{

}
?>