<?php

include('../includes/all_func.php');
$idd=$_SESSION['adid'];

$s="select * from registration where user_name='$idd'";
$r=mysql_query($s);
$f=mysql_fetch_array($r);
$id=$f['user_id'];

$pass=$_REQUEST['password'];
$sel="select count(*) from registration where t_code='$pass' and user_id='$id'"; 
$sql=mysql_query($sel);
$result=mysql_result($sql,0,0);
if($result>0 )
{
header('location:virtual_finance.php');
}
else
{
$msg="Password Does Not Match!";
header('location:financial_manager1.php?msg='.$msg);
}
 ?>