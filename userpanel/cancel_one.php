<?php
include("../includes/all_func.php");
session_start();
$user_id=showuserid($_SESSION['SD_User_Name']);

//echo "<pre>"; print_r($_POST);
$curdate=date('Y-m-d');
if(isset($_POST['cancel_one']) && count($_POST['cancel_one'])>0)
{
	$cancel_one=$_POST['cancel_one'];
	for($i=0;$i<count($_POST['cancel_one']);$i++)
	{
		if($_POST['cancel_one'][$i]==1)
		{
			$category_one=1;
		}
		if($_POST['cancel_one'][$i]==2)
		{
			$category_two=1;
		}
		if($_POST['cancel_one'][$i]==3)
		{
			$category_three=1;
		}
	}
	
	if($category_one)
	{
		// check the user have only one membership or multiple
		$flag1=0;
		$sql_user="select * from registration where user_id='$user_id'";
		$res_user=mysql_query($sql_user);
		$row_user=mysql_fetch_assoc($res_user);
		if($row_user['category_one'])
		{
			$flag1++;
		}
		if($row_user['category_two'])
		{
			$flag1++;
		}
		if($row_user['category_three'])
		{
			$flag1++;
		}
			mysql_query("update registration set category_one=0 where user_id='$user_id'");
			mysql_query("update subscription set status=2 where type=1 and user_id='$user_id'");
			mysql_query("insert into cancel_membership set user_id='$user_id',type='1',add_date='$curdate',nom_id='$row_user[nom_id]',ref_id='$row_user[ref_id]'");
		if($flag1==1)
		{
			//mysql_query("update registration set mem_status=1 where user_id='$user_id'");
		}
	}
	if($category_two)
	{
		$flag1=0;
		$sql_user="select * from registration where user_id='$user_id'";
		$res_user=mysql_query($sql_user);
		$row_user=mysql_fetch_assoc($res_user);
		if($row_user['category_one'])
		{
			$flag1++;
		}
		if($row_user['category_two'])
		{
			$flag1++;
		}
		if($row_user['category_three'])
		{
			$flag1++;
		}
			mysql_query("update registration set category_two=0 where user_id='$user_id'");
			mysql_query("update subscription set status=2 where type=2 and user_id='$user_id'");
			mysql_query("insert into cancel_membership set user_id='$user_id',type='2',add_date='$curdate',nom_id='$row_user[nom_id]',ref_id='$row_user[ref_id]'");
		if($flag1==1)
		{
			//mysql_query("update registration set mem_status=1 where user_id='$user_id'");
		}
	}
	if($category_three)
	{
		$flag1=0;
		$sql_user="select * from registration where user_id='$user_id'";
		$res_user=mysql_query($sql_user);
		$row_user=mysql_fetch_assoc($res_user);
		if($row_user['category_one'])
		{
			$flag1++;
		}
		if($row_user['category_two'])
		{
			$flag1++;
		}
		if($row_user['category_three'])
		{
			$flag1++;
		}
			mysql_query("update registration set category_three=0 where user_id='$user_id'");
			mysql_query("update subscription set status=2 where type=3 and user_id='$user_id'");
			mysql_query("insert into cancel_membership set user_id='$user_id',type='3',add_date='$curdate',nom_id='$row_user[nom_id]',ref_id='$row_user[ref_id]'");
		if($flag1==1)
		{
			//mysql_query("update registration set mem_status=1 where user_id='$user_id'");
		}
		
		// return all income(refferal income of user)
		$sql_income="select * from level_income_admin where status=1 and paid_status=1 and income_id='$user_id'";
		$res_income=mysql_query($sql_income);
		while($row_income=mysql_fetch_assoc($res_income))
		{
			$total_income=$total_income+$row_income['commission'];
			$l_id=$row_income['l_id'];
			mysql_query("update level_income_admin set status=2 , paid_status=2 where l_id='$l_id'");
		}
	}
	unset($_SESSION['SD_User_Id']);
	unset($_SESSION['SD_User_Name']);
echo "<script type='text/javascript'>alert('You Successfully Cancel Your Membership.'); window.location.href='../index.php';</script>";
}
else
{
echo "<script type='text/javascript'>alert('Please Choose at least one membership to delete'); window.location.href='cancel_membership.php';</script>";
}
?>