<?php
session_start();
include('../includes/all_func.php');
$uname=$_REQUEST['username'];
$user_id=$_REQUEST['uid'];
$pass=$_REQUEST['password'];

	$query="select count(*) from registration where user_name='$uname' and user_pass='$pass' and mem_status=0"; 
	$dat=mysql_query($query);
	$res=mysql_result($dat,0,0);
	if($res>0 && $uname!='' && $pass!='')
	{
		if(!isset($_SESSION['adid']))
		{
			$_SESSION['adid']=$uname;
			$update="update registration set last_login=this_login, this_login=now() where user_name='$uname'";
			$sql=mysql_query($update)or die("Error: Login Problem.");
					
		}
		if($_POST['remme'])
		{
			$year = time() + 3600;
			setcookie('remember_me', $_POST['username'], $year);
			setcookie('rememberpass_me', $_POST['password'], $year);
		}
		if($_POST['page']=="payment")
			header("location: onclick/address_confirm.php");
		if($_POST['page']=="fav")
			header("location: userpanel/favourite.php");
		if($_POST['page']=="add_fav")
			header("location: fav.php?id=$_POST[prod_id]");
		else
			header("location: index.php");
	}
	else
	{
		$query="select count(*) from user_login where user_name='$uname' and password='$pass' and status=0"; 
		$dat=mysql_query($query);
		$res=mysql_result($dat,0,0);
		
		if($res>0 && $uname!='' && $pass!='')
		{
			if(!isset($_SESSION['adid']))
			{
				$queryuser="select * from user_login where user_name='$uname' and password='$pass' and status=0";
				$resuser=mysql_query($queryuser);
				$row=mysql_fetch_assoc($resuser);
				$_SESSION['SD_Sub_User_Name']=$uname;
				$_SESSION['SD_Sub_operator_type']=$row['operator_type'];
				$_SESSION['SD_Sub_role_type']=$row['role_type'];
				$_SESSION['SD_Sub_user_type']=$row['user_type'];
				$_SESSION['SD_Sub_user_password']=$row['password'];
				$update="update user_login set last_login=this_login, this_login=now() where user_id='$row[user_id]'";
				$sql=mysql_query($update)or die("Error: Login Problem.");
				
				$sqlmain="select user_name from registration where user_id='$row[user_id]'";
				$resmain=mysql_query($sqlmain);
				$rowmain=mysql_fetch_assoc($resmain);
				$_SESSION['adid']=$rowmain['user_name'];
			}
				if($_POST['remme'])
				{
					$year = time() + 3600;
					setcookie('remember_me', $_POST['username'], $year);
					setcookie('rememberpass_me', $_POST['password'], $year);
				}
				//print_r($_SESSION);
				header("location: process_coupon.php");		
		}
		else
		{
			$msg="Wrong Username or Password. Please check it and try again.";
			header("location: login.php?msg=$msg");
		}
	}

?>