<?php 
include("../includes/all_func.php");
session_start();
//echo "<pre>"; print_r($_POST);exit;
// check for duplicate user name 
extract($_POST);
$sql="select id from registration where user_name='$user_name'";
$res=mysql_query($sql);
$count=mysql_num_rows($res);
$sql_ssn="select id from registration where pan_no='$ssn'";
$res_ssn=mysql_query($sql_ssn);
$count_ssn=mysql_num_rows($res_ssn);
if($count)
{
	echo "<script type='text/javascript'>alert('Username already exists');window.location.href='joinnow.php';</script>";
}
else if($count_ssn)
{
	echo "<script type='text/javascript'>alert('SSN No already exists');window.location.href='joinnow.php';</script>";
}

else
{
// check duplicate email
	$sql_email="select id from registration where user_name='$user_name'";
	$res_email=mysql_query($sql_email);
	$count_email=mysql_num_rows($res_email);
	if($count_email)
	{
		echo "<script type='text/javascript'>alert('EmailId already exists.');window.location.href='joinnow.php';</script>";
	}
	else
	{
		if($_FILES['image']['name']!='')
		{
			$image2=$_POST['user_name'].'_'.time().'_'.substr(str_replace(" ", "_", $_FILES['image']['name']),0,3).'.jpg';
			move_uploaded_file($_FILES['image']['tmp_name'],"userimages/".$image2);
		}
		$_SESSION['dob']=$_POST['year']."-".$_POST['months']."-".$_POST['day'];
		$_SESSION['fname']=$_POST['fname'];
		$_SESSION['mname']=$_POST['mname'];
		$_SESSION['lname']=$_POST['lname'];
		$_SESSION['title']=$_POST['title'];
		$_SESSION['ref_id']=$_POST['ref_id'];
		$_SESSION['ref_name']=$_POST['ref_name'];
		$_SESSION['sex']=$_POST['sex'];
		$_SESSION['address1']=$_POST['address1'];
		$_SESSION['address2']=$_POST['address2'];
		$_SESSION['city']=$_POST['city'];
		$_SESSION['state']=$_POST['state'];
		$_SESSION['country']=$_POST['country'];
		$_SESSION['zip']=$_POST['zip'];
		$_SESSION['email']=$_POST['email'];
		$_SESSION['ssn']=$_POST['ssn'];
		$_SESSION['mobile']=$_POST['mobile'];
		$_SESSION['user_name']=$_POST['user_name'];
		$_SESSION['user_pass']=$_POST['user_pass'];
		$_SESSION['image']=$image2;
		$_SESSION['category_member']=$_POST['category'];
		header("Location:payment_option.php");
	}
}
?>