<?php
session_start();
$userid=$_REQUEST['d'];
include("connection.php");
$quer="select count(*) from registration where nom_id='$userid'";
	$data=mysql_query($quer);
	$res=mysql_result($data, 0, 0);

	if($res>=2)
	{
		$opt="Upline ID Has Two Members Plz Insert Another ID";
	}
	echo $opt;
	 $quer="select count(*) from registration where user_id='$userid'";
	$data=mysql_query($quer);
	$res=mysql_result($data, 0, 0);
$quer2="select * from registration where user_id='$userid'";
$data2=mysql_query($quer2);
$x=mysql_fetch_assoc($data2);
if($res>0)
{
 $opt1=$x['title_nm']." ".$x['first_name']." ".$x['mid_name']." ".$x['last_name']; 
}
	else
	{
		$opt1="Invalid upline ID";
	}
	echo $opt1;
?>