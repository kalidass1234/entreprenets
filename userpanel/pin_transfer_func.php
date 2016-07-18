<?php
include "../includes/all_func.php";
$idd=$_SESSION['adid'];
$loginid=$_REQUEST['loginid'];
$n=$_REQUEST['pin'];
$amt=$_REQUEST['amt'];
$tdate=date('Y-m-d');

$t_code=$_POST['tcode'];

$s="select * from registration where user_name='$idd' and t_code='$t_code'";
$r=mysql_query($s);
$c=mysql_num_rows($r);

if($c>0)
{
	$f=mysql_fetch_array($r);
	$sender_username=$f['user_name'];
	$sender_email=$f['email'];
	$sender_name=$f['first_name'].' '.$f['last_name'];
	$id=$f['user_id'];
	$quers_sid="select * from registration where user_id='$loginid' or user_name='$loginid'";
	$dat_sid=mysql_query($quers_sid);
	$red_sid=mysql_num_rows($dat_sid);
	if($red_sid>0)
	{
		$fet=mysql_fetch_array($dat_sid);
		$loginid=$fet['user_id'];
		$receive_email=$fet['email'];
		$receive_username=$fet['user_name'];
		$receive_name=$fet['first_name'].' '.$fet['last_name'];
		$str_p="select * from pins where status=0 and receiver_id='$id' and amount='$amt' limit $n";
		$res_p1=mysql_query($str_p);
		$num_rows=mysql_num_rows($res_p1);
		if($num_rows>=$n)
		{
			
			while($row_p1=mysql_fetch_assoc($res_p1))
			{
			$pin_id=$row_p1['id'];
			$pin_no=$row_p1['pin_no'];
			$create_date=$row_p1['crt_date'];
			$creater_id=$row_p1['created_by_user'];
			$qur="insert into pin_transferred(pin_no,status,receiver_id,sender_id,t_date) values('$pin_no',0,'$loginid','$id','$tdate')";
			$res=mysql_query($qur);

			mysql_query("INSERT INTO pin_history SET pin_no='$pin_no',  crt_date='$create_date', t_date='$tdate', creater_id='$creater_id', receiver_id='$loginid', sender_id='$id'"			);
	 
			mysql_query("update pins set  receiver_id='$loginid',sender_id='$id',transfer_to='$loginid',transfer_by='$id', transfer_date='$tdate' where id='$pin_id'");
			

			}

			$msg="Voucher Transferred Successfully";
			echo "<script type='text/javascript'>alert('Voucher Transferred Successfully');window.location.href='transfer-voucher.php?msg=$msg';</script>";
			header("location:transfer-voucher.php?msg=$msg");
		}
		else
		{
			$msg="Insufficient Vouchers";
			echo "<script type='text/javascript'>alert('Insufficient Vouchers');window.location.href='transfer-voucher.php?msg=$msg';</script>";
		}
	}
	else
	{
		$msg="Wrong Member ID";
			echo "<script type='text/javascript'>alert('Wrong Member ID');window.location.href='transfer-voucher.php?msg=$msg';</script>";
	}
}
else
{
	$msg="Wrong Transaction Code";
		echo "<script type='text/javascript'>alert('Wrong Transaction Code');window.location.href='transfer-voucher.php?msg=$msg';</script>";
}
?>