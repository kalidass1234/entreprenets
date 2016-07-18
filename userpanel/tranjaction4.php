<?php
session_start();
include('../includes/all_func.php');
$idd=$_SESSION['SD_User_Name'];
$s="select * from registration where user_name='$idd'";
$r=mysql_query($s);
$f=mysql_fetch_array($r);
$id=$f['user_id'];

$pass=$_REQUEST['password'];
$sel="select count(*) from registration where t_code='$pass' and user_id='$id'"; 
$sql=mysql_query($sel);
$result=mysql_result($sql,0,0);
//echo $result;exit;
if($result>0 )
{
	$page=$_REQUEST['page'];
	if($page=='total')
	{
		$page1='total_bid.php';
	}
	else if($page=='trade')
	{
		$page1='trade_bid.php';
	}
	else if($page=='history')
	{
		$page1='bid_manager_view.php';
	}

header('location:'.$page1);
}
else
{
	$page=$_REQUEST['page'];
	if($page=='total')
	{
	$page1='financial_manager4.php';
	}
	else if($page=='trade')
	{
	$page1='financial_manager5.php';
	}
	else if($page=='history')
	{
	$page1='financial_manager3.php';
	}

?>
<script type="text/javascript">
alert('Wrong Transaction Password');
location.href='<?php echo $page1;?>';
</script>
<?
}

?>