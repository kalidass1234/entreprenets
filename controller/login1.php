<?php
@session_start();
include_once("controller/connection.php");

if(isset($_REQUEST['log1']))
{
	 $sql="select user_id, user_type, mem_status from registration where user_name='".$_REQUEST['log1']."' and user_pass='".$_REQUEST['pwd']."'";
	$rst=mysql_query($sql) or die ($sql.mysql_error());
	if($_REQUEST['log1']==''){
		header('location:login.php');
	}
	else if($_REQUEST['pwd']=='')
		header('location:login.php');
	else if(mysql_num_rows($rst) > 0)
	{
		$args_user=mysql_fetch_array($rst);
		$_SESSION['adid']=$args_user['user_id'];
		
		
			header('location:userpanel/');
		
	}
	else
	?>
    <?php
		header('location:login.php');
}
?>