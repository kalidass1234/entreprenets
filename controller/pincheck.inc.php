<?php
include('connection.php');
	$userid=$_REQUEST['v'];
	$plan=$_REQUEST['p'];
    if($plan=='3100')
	{
	$quer="select * from pins where pin_no='$userid' and status='0'";
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

if($plan=='7100')
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

?>