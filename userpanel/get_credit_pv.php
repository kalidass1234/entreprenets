<?php
session_start();
include('../includes/all_func.php');
$idd=$_SESSION['SD_User_Name'];
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
header('location:get_credit.php');
}
else
{
?>
<script type="text/javascript">
alert('Wrong Transaction Password');
location.href='getcredit.php';
</script>
<?
}

?>