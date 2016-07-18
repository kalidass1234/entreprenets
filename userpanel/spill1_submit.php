<?php
error_reporting(E_ALL ^ E_NOTICE);
include("../includes/all_func.php");
session_start();
//echo "<pre>"; print_r($_POST);

$user_id=showuserid($_SESSION['SD_User_Name']);
$username=$_POST['username'];

$sql_user="select * from registration where (user_id='$username' or user_name='$username') and category_two=1";
//echo $sql_user;echo "<br>";
$res_user=mysql_query($sql_user);
$count_user=mysql_num_rows($res_user);
if($count_user>0)
{
	$row_user=mysql_fetch_assoc($res_user);
	$nom_id=$row_user['user_id'];
	if(count($_POST['members'])>0)
	{
		# check how many member already have this member
		// start here
		$sql_check="select * from registration where nom_id='$nom_id'";
		//echo $sql_check;echo "<br>";
		$res_check=mysql_query($sql_check);
		$count_check=mysql_num_rows($res_check);
		//echo $count_check;echo "<br>";
		if($count_check<5)
		{
			if(count($_POST['members'])>$count_check)
			{
				$limit=5-$count_check;
			}
			else if(count($_POST['members'])<$count_check)
			{
				$limit=5-$count_check;
			}
			else if(count($_POST['members'])==$count_check)
			{
				$limit=5-$count_check;
			}
		// end here 
			$members=implode(",",$_POST['members']);
			$sql="select * from reserve_member where id in ($members) and status=0 and user_id='$user_id' limit $limit";
			//echo $sql;echo "<br>";
			$res=mysql_query($sql);
			$count=mysql_query($ref);
			while($row=mysql_fetch_assoc($res))
			{
				$ids=$row['id'];
				//$member_id=$row['user_id'];
				$member_id=$row['member_id'];
				$plan_name=$row['plan_name'];
				$ref=$row['ref_id'];
				$transfer_date=date('Y-m-d H:i:s');
				// update status and sender id, receiver id
				//echo "update reserve_member set status=1, sender_id='$user_id',receiver_id='$nom_id' where id='$ids'";
				//echo "<br>";
				mysql_query("update reserve_member set status=1, sender_id='$user_id',receiver_id='$nom_id',transfer_date='$transfer_date' where id='$ids'");
				// update nom
				//echo "update registration set nom_id='$nom_id' where user_id='$member_id'";
				//echo "<br>";
				mysql_query("update registration set nom_id='$nom_id' where user_id='$member_id'");
				$obj_com=new Commission();
				$obj_com->commission_distribute($ref,$nom_id,$member_id,$plan_name,2);
			}
			echo "<script type='text/javascript'>alert('You Successfully Spill Over $count reserve members to $username');window.location.href='spill1.php';</script>'";
		}
		else
		{
			echo "<script type='text/javascript'>alert('Member Already Have Five Member');window.location.href='spill1.php';</script>'";
		}
	}
	else
	{
		echo "<script type='text/javascript'>alert('Please Select maximum Five and atleast one Member To Spill Over');window.location.href='spill1.php';</script>'";
	}
}
else
{
	echo "<script type='text/javascript'>alert('Wrong User. Please Enter Valid User To Spill Over Reserve Members.');window.location.href='spill1.php';</script>'";
}
?>