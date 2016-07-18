<?php
@session_start();
include_once("controller/connection.php");

if(isset($_REQUEST['log1']))
{
	$sql="select user_id, user_type, mem_status, package from registration where user_name='".$_REQUEST['log1']."' and user_pass='".$_REQUEST['pwd']."'";
	$rst=mysql_query($sql) or die ($sql.mysql_error());
	if($_REQUEST['log1']==''){
		header('location:index.php');
	}
	else if($_REQUEST['pwd']=='')
		header('location:index.php');
	else if(mysql_num_rows($rst) > 0)
	{
		$args_user=mysql_fetch_array($rst);
		$_SESSION['adid']=$args_user['user_id'];
		$_SESSION['package_login']=$args_user['package'];
		$ip = $_SERVER['REMOTE_ADDR'];
		$sqlLastLogin = "UPDATE registration SET last_loginIp ='".$ip."' WHERE user_name='".$_REQUEST['log1']."'";
		$rst=mysql_query($sqlLastLogin);
			header('location:userpanel/');
		
	}
	else{ //echo "wrong";
	
		header('location:index.php');
	}
}
?>