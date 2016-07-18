<?php
session_start();
include('connection.php');
$userid=$_REQUEST['d'];
$quer="select count(*) from registration where nom_id='$userid'";
	$data=mysql_query($quer);
	$res=mysql_result($data, 0, 0);
if($res==0)
{
print " <input name='binary' type='radio' value='Left' checked='checked'/>
                                        Left
		<input name='binary' type='radio' value='Right'/>
                                        Right";
									}
									else
									{
$quer1="select count(*) from registration where nom_id='$userid'";
$data1=mysql_query($quer1);
$res1=mysql_result($data1,0,0);
				if($res1==2)
							{
								print "<font color='red'>Filled</font>";
								}	
								else
								{
								$quer4="select count(*) from registration where nom_id='$userid'";
	$data4=mysql_query($quer4);
	$res4=mysql_result($data4,0,0);
								$quer2="select count(*) from registration where nom_id='$userid' and binary_pos='Left'";
	$data2=mysql_query($quer2);
	$res2=mysql_result($data2,0,0);
	$quer3="select count(*) from registration where nom_id='$userid' and binary_pos='Right'";
	$data3=mysql_query($quer3);
	$res3=mysql_result($data3,0,0);
								
								if($res2>0)
								{
print " <input name='binary' type='radio' value='Left' checked='checked'/>
                                        Left";
								
								}
									if($res3>0)
								{
print "<input name='binary' type='radio' value='Right' checked='checked'/>
                                        Right";
								
								}
							}
									}
?>
