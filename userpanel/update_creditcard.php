<?php
include('../includes/all_func.php');
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	//transaction history
	$id=showuserid($_SESSION['SD_User_Name']);
    //echo "<pre>"; print_r($_POST);
	$card_name=$_POST['card_name'];
	$card_type=$_POST['card_type'];
	$card_no=$_POST['card_no'];
	$cvv=$_POST['cvv'];
	$exp_date=$_POST['exp_date'];
	$first_name=$_POST['first_name'];
	$mid_name=$_POST['mid_name'];
	$last_name=$_POST['last_name'];
	$mobile=$_POST['mobile'];
	$email=$_POST['email'];
	$address1=$_POST['address1'];
	$address2=$_POST['address2'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$zip=$_POST['zip'];
	$country=$_POST['country'];
	
	$lid=$_GET['id'];
	//echo $update;exit;
	if($card_no!=''){$concardno=",card_no='$card_no'";}
	
	$action=$_REQUEST['action'];
	if($action=='update')
	{
	//$update="update registration set first_name='$first_name',mid_name='$mid_name',last_name='$last_name',mobile='$mobile',email='$email',address1='$address1',address2='$address2',city='$city',state='$state',zip='$zip',country='$country' where user_id='$id'";
	$update="update registration set address1='$address1',address2='$address2',city='$city',state='$state',zip='$zip' where user_id='$id'";
	mysql_query($update);
	mysql_query("update billing_address set card_type='$card_type' $concardno ,exp_date='$exp_date',cvv='$cvv',address1='$address1',city='$city',state='$state',zip='$zip' where user_id='$id' and id='$lid'");
	$sql_reccuring="SELECT * FROM  `recurring_billing` where user_id='$id' ";
	$res_reccuring=mysql_query($sql_reccuring);
	$row_reccuring=mysql_fetch_assoc($res_reccuring);
	$subscription_id_bill=$row_reccuring['subscription_id'];
	include("../php_arb_xml/subscription_get_status.php");
	echo "<script language='javascript'>alert('Card Information Updated Successfully.');window.location.href='debitcardlist.php';</script>";exit;
	}
	if($action=='insert')
	{
		mysql_query("insert into billing_address set card_name='$card_name',card_type='$card_type',card_no='$card_no',exp_date='$exp_date',cvv='$cvv',user_id='$id',address1='$address1',address2='$address2',city='$city',state='$state',zip='$zip'");
		echo "<script language='javascript'>alert('Card Information Updated Successfully.');window.location.href='debitcardlist.php';</script>";exit;
	}
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}
?>