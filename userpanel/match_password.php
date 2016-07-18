<?
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
if($_GET['tp_history']==1)
{
	if($result>0 )
	{
		header('location:tp_history.php');
	}
	else
	{
	?>
		<script type="text/javascript">
			alert('Wrong Transaction Password');
			location.href='financial_manager3.php';
		</script>
	<?php
	}
}
if($_GET['tp']==1)
{
	if($result>0 )
	{
		header('location:tp_wallet.php');
	}
	else
	{
	?>
		<script type="text/javascript">
			alert('Wrong Transaction Password');
			location.href='financial_manager2.php';
		</script>
	<?php
	}
}
if($_GET['tfs_history']==1)
{
	if($result>0 )
	{
		header('location:tfs_history.php');
	}
	else
	{
	?>
		<script type="text/javascript">
			alert('Wrong Transaction Password');
			location.href='financial_manager5.php';
		</script>
	<?php
	}
}
if($_GET['tfs']==1)
{
	if($result>0 )
	{
		header('location:tfs_wallet.php');
	}
	else
	{
	?>
		<script type="text/javascript">
			alert('Wrong Transaction Password');
			location.href='financial_manager4.php';
		</script>
	<?php
	}
}
?>