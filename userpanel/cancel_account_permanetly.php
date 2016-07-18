<?php
include("../includes/all_func.php");
session_start();
$user_id=showuserid($_SESSION['SD_User_Name']);
$curdate=date('Y-m-d');
//echo "<pre>"; print_r($_POST);
		// check user category
		$sql_user="select * from registration where user_id='$user_id'";
		$res_user=mysql_query($sql_user);
		$row_user=mysql_fetch_assoc($res_user);
		if($row_user['category_one'])
		{
			mysql_query("update registration set category_one=0,mem_status=2 where user_id='$user_id'");
			mysql_query("update subscription set status=2 where type=1 and user_id='$user_id'");
			mysql_query("insert into delete_membership set user_id='$user_id',type='1',add_date='$curdate',nom_id='$row_user[nom_id]',ref_id='$row_user[ref_id]'");
		}
		if($row_user['category_two'])
		{
			mysql_query("update registration set category_two=0,mem_status=2 where user_id='$user_id'");
			mysql_query("update subscription set status=2 where type=2 and user_id='$user_id'");
			mysql_query("insert into delete_membership set user_id='$user_id',type='2',add_date='$curdate',nom_id='$row_user[nom_id]',ref_id='$row_user[ref_id]'");
		}
		if($row_user['category_three'])
		{
			mysql_query("update registration set category_three=0,mem_status=2 where user_id='$user_id'");
			mysql_query("update subscription set status=2 where type=3 and user_id='$user_id'");
			mysql_query("insert into delete_membership set user_id='$user_id',type='3',add_date='$curdate',nom_id='$row_user[nom_id]',ref_id='$row_user[ref_id]'");
			$sql_income="select * from level_income_admin where status=1 and paid_status=1 and income_id='$user_id'";
			$res_income=mysql_query($sql_income);
			while($row_income=mysql_fetch_assoc($res_income))
			{
				$total_income=$total_income+$row_income['commission'];
				$l_id=$row_income['l_id'];
				mysql_query("update level_income_admin set status=2 , paid_status=2 where l_id='$l_id'");
			}
		}
		// return all income(refferal income of user)
unset($_SESSION['SD_User_Id']);
unset($_SESSION['SD_User_Name']);
echo "<script type='text/javascript'>alert('You Successfully Delete Your Account.'); window.location.href='../index.php';</script>";
?>