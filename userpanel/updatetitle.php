<?php
include('../includes/all_func.php');
session_start();

if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	$idd=$_SESSION['SD_User_Name'];
	$s="select user_id from registration where user_name='$idd'";
	$r=mysql_query($s);
	$f=mysql_fetch_array($r);
	$id=$f['user_id'];
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}

if(isset($_POST) && $_REQUEST['r']=='title')
{
	$_SESSION['title']=$_POST['product_name1'];
	$_SESSION['condition']=$_POST['condition1'];
	$_SESSION['pro_desc']=$_POST['pro_desc1'];
	$_SESSION['prod_spec']=$_POST['prod_spec1'];
	$_SESSION['prod_box']=$_POST['prod_box1'];
	$_SESSION['ipbo_price']=$_POST['ipbo_price1'];
	$_SESSION['cost_price']=$_POST['cost_price1'];
	
	if($_REQUEST['page']=='penny')	header("Location:fifthpennyauction_page.php");
	else if($_REQUEST['page']=='dailydeal')	header("Location:fifthdailydeal_page.php");
	else if($_REQUEST['page']=='giftcard') 	header("Location:fifthgiftcard_page.php");
	else if($_REQUEST['page']=='mr') 	header("Location:fifthmrcircle_page.php");
	else header("Location:fifth_page.php");
}
else if(isset($_POST) && $_REQUEST['r']=='price')
{
	$_SESSION['ipbo_price']=$_POST['ipbo_price1'];
	$_SESSION['dailydeal_discount']=$_POST['dailydeal_discount1'];
	$_SESSION['cost_price']=$_POST['cost_price1'];
	$_SESSION['auction_price']=$_POST['auction_price1'];
	$_SESSION['reserve_price']=$_POST['reserve_price1'];
	$_SESSION['reserve_bid']=$_POST['reserve_bid1'];
	$_SESSION['duration']=$_POST['duration'];
	$_SESSION['p_qty']=$_POST['p_qty'];
	if($_POST['autorelist']){ $a=$_POST['autorelist'];} else { $a=''; }
	$_SESSION['autorelist']=$a;
	

	//  print_r($_SESSION);exit;
	//echo "<pre>";	print_r($_SESSION);exit;
	if($_REQUEST['page']=='penny')	header("Location:fifthpennyauction_page.php");
	else if($_REQUEST['page']=='dailydeal')	header("Location:fifthdailydeal_page.php");
	else if($_REQUEST['page']=='giftcard')	header("Location:fifthgiftcard_page.php");
	else if($_REQUEST['page']=='mr') 	header("Location:fifthmrcircle_page.php");
	else	header("Location:fifth_page.php");
}
else if(isset($_POST) && $_REQUEST['r']=='ship')
{

	$_SESSION['item_location']=$_POST['item_location1'];
	$_SESSION['handling_time']=$_POST['handling_time1'];
	$_SESSION['item_return']=$_POST['item_return1'];
	$_SESSION['paypal_account']=$_POST['paypa1_account1'];
	$_SESSION['shipping']=$_POST['shipping'];

	
	unset($_SESSION['shipping_economy']);
	unset($_SESSION['shipping_express']);
	unset($_SESSION['shipping_inter']);
	unset($_SESSION['duration_economy']);
	unset($_SESSION['duration_express']);
	unset($_SESSION['duration_inter']);
	
	foreach ($_POST['shiptype'] as $value)
	  {
	   $_SESSION['shipping_'.$value]=$_POST['shipping_'.$value];
	   $_SESSION['duration_'.$value]=$_POST['duration_'.$value];
	  //	echo $value . "<br>";
	  }
	  $_SESSION['shiptype']=$_POST['shiptype'];
	//  print_r($_SESSION);exit;
	//echo "<pre>";	print_r($_REQUEST);exit;
	if($_REQUEST['page']=='penny')	header("Location:fifthpennyauction_page.php");
	else if($_REQUEST['page']=='dailydeal')	{header("Location:fifthdailydeal_page.php");}
	else if($_REQUEST['page']=='giftcard')	{header("Location:fifthgiftcard_page.php");}
	else if($_REQUEST['page']=='mr') 	header("Location:fifthmrcircle_page.php");
	else	header("Location:fifth_page.php");
}
?>