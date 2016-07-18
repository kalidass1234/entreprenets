<?php
include "../controller/connection.php";
$loginid=$_REQUEST['loginid'];

$n=$_REQUEST['pinss'];
$amt=$_REQUEST['amt'];
$pintype=$_REQUEST['pintype'];
$tdate=date('Y-m-d');
$tr_id_ck="select count(*) from registration where user_id='$loginid'";
$res_id_ck=mysql_query($tr_id_ck);
$row_count_id=mysql_num_rows($res_id_ck);

if($row_count_id > 0)
{
	$str_p="select * from pins where status=0 and amount='$amt' and receiver_id='admin'";
	$res_p1=mysql_query($str_p);
	$num_rows=mysql_num_rows($res_p1);

	if($num_rows>=$n)
	{
		//echo $qur="insert into  t_pin_by_admin(pin_no,status,amount,receiver_id,sender_id,t_date) values('$n',0,'$amt','$loginid','admin','$tdate')";
		//$res=mysql_query($qur);
		$str="select * from pins where status=0 and amount='$amt' and receiver_id='admin'";
		$res1=mysql_query($str);

		for($i=0;$i<$n;$i++)
		{

			$row=mysql_fetch_array($res1);
			$pin_no=$row['pin_no'];
			
			 $qur1="update pins set receiver_id='$loginid',sender_id='admin',t_date=$tdate where pin_no='$pin_no' ";

			$res2=mysql_query($qur1);

		}
		header("location:admin_main.php?page_number=22&msg=Pin Transferred");
	}
	else
	{
	header("location:admin_main.php?page_number=22&msg=insufficient Pin");
	}
}
else
{
header("location:admin_main.php?page_number=22&msg=Wrong User ID Entered");
}
?>