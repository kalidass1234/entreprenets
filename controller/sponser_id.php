<?php
include('connection.php');
	$userid=$_REQUEST['v'];
	//$plan=$_REQUEST['p'];
    //if($plan=='1000')
	//{
	$quer="select * from registration where user_id='$userid'";
	$data=mysql_query($quer);
	$res=mysql_fetch_array($data);
    $pin=$res['user_id'];
	if($userid!=$pin)
	{
		$opt1="<font color='red'>Invalid Sponser ID</font>";
		//echo $opt1;
	}
	else
	{
	$opt1="<font color='green'>Correct Sponser ID</font>";
	}
	echo $opt1;
//}
/*
if($plan=='1500')
	{
	$quer="select * from pins1 where pin_no='$userid' and status='0'";
	$data=mysql_query($quer);
	$res=mysql_fetch_array($data);
    $pin=$res['pin_no'];
	if($userid!=$pin)
	{
		$opt1="<font color='red'>Invalid Pin No</font>";
		//echo $opt1;
	}
	echo $opt1;

}


if($plan=='2700')
	{
	$quer="select * from pins2 where pin_no='$userid' and status='0'";
	$data=mysql_query($quer);
	$res=mysql_fetch_array($data);
    $pin=$res['pin_no'];
	if($userid!=$pin)
	{
		$opt1="<font color='red'>Invalid Pin No</font>";
		//echo $opt1;
	}
	echo $opt1;

}
*/
?>