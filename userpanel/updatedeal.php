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

if(isset($_POST) && $_REQUEST['r']=='deal')
{
	$pid=$_POST['pid'];
	$deal_id=$_POST['deal_id'];
	$udeal_price=$_POST['udeal_price'];
	$sdeal_price=$_POST['sdeal_price'];
	$scounter_offer=$_POST['scounter_offer'];
	$remark=$_POST['remark'];
	$deal_qty=$_POST['deal_qty'];
	$deal_date=$_POST['deal_date'];
	$buser_id=$_POST['buser_id'];
	$cost_price=$_POST['cost_price'];
	$ipbo_price=$_POST['ipbo_price'];
	
	$current_date=date('Y-m-d H:i:s');
	$sqlinsert=" INSERT INTO `make_a_deal` ( `deal_id`,`deal_qty`, `user_id`, `p_id`, `cost_price`, `ipbo_price`, `udeal_price`, `sdeal_price`, `scounter_offer`, `reciever_id`, `sender_id`, `remark`, `status`, `deal_date`, `response_date`, `ts`) VALUES ('$deal_id','$deal_qty','$id', '$pid', '$cost_price', '$ipbo_price', '$udeal_price', '$sdeal_price', '$scounter_offer', '$buser_id', '$id', '$remark', '0', '$deal_date', '$current_date', CURRENT_TIMESTAMP);";
	mysql_query($sqlinsert);
	
	mysql_query("update final_deal set count_scounter=count_scounter+1,read_sender='1' where id='$deal_id'");
	header("Location:showmydeal.php?id=$deal_id");
}
if(isset($_POST) && $_REQUEST['r']=='bdeal')
{
	$pid=$_POST['pid'];
	$deal_id=$_POST['deal_id'];
	$udeal_price=$_POST['udeal_price'];
	$sdeal_price=$_POST['sdeal_price'];
	$bcounter_offer=$_POST['bcounter_offer'];
	$remark=$_POST['remark'];
	$deal_qty=$_POST['deal_qty'];
	$deal_date=$_POST['deal_date'];
	$suser_id=$_POST['suser_id'];
	$cost_price=$_POST['cost_price'];
	$ipbo_price=$_POST['ipbo_price'];
	
	$current_date=date('Y-m-d H:i:s');
	$sqlinsert=" INSERT INTO `make_a_deal` ( `deal_id`,`deal_qty`, `user_id`, `p_id`, `cost_price`, `ipbo_price`, `udeal_price`, `sdeal_price`, `ucounter_offer`, `reciever_id`, `sender_id`, `remark`, `status`, `deal_date`, `response_date`, `ts`) VALUES ('$deal_id','$deal_qty','$id', '$pid', '$cost_price', '$ipbo_price', '$udeal_price', '$sdeal_price', '$bcounter_offer', '$suser_id', '$id', '$remark', '0', '$deal_date', '$current_date', CURRENT_TIMESTAMP);";
	//echo $sqlinsert;exit;
	mysql_query($sqlinsert);
	mysql_query("update final_deal set count_ucounter=count_ucounter+1,read_receiver='1' where id='$deal_id'");
	header("Location:showdeal.php?id=$deal_id");
}
?>