<?php

include "../controller/connection.php";
$n=$_REQUEST['pin'];
$type=$_REQUEST['type'];
$price=$_REQUEST['amt'];

$str="select * from package WHERE package_id='".$price."'";
$res=mysql_query($str);
$package=mysql_fetch_array($res);
$package_amt= $package['total_price'];
						
$create_date=date('Y-m-d');
$chars = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "0", "1", "2", "3","4", "5", "6", "7", "8", "9");

for($i=0;$i<$n;$i++)
{
	$rand_id="";
	for($j=1; $j<=10; $j++)
	{
		$num = mt_rand(0,35);
		$rand_id .= $chars[$num];
	}
	
$qur="insert into pins set pin_no='$rand_id', amount='$package_amt', package_id='$price',  status=0, crt_date=curdate(), created_by_user='admin', receiver_id='admin'";

$res=mysql_query($qur) or die("Error: ".$qur.mysql_error());
}



$msg="Epins has been created";
header("location:admin_main.php?page_number=21");
?>