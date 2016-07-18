<?php
//session_start();
include('../includes/all_func.php'); 

$resp=$_REQUEST['response'];
$date=date('Y-m-d');
 $sel="select * from message";
$x=mysql_query($sel);
$count=mysql_num_rows($x);

if($_REQUEST['checkbox'])
{
 $checkbox=$_POST['checkbox'];

for($i=0; $i<$count; $i++)
{
 $checkbox[$i]. '<br>';
$id = $checkbox[$i];
$delete="delete from message where id='$id'";
$qur1=mysql_query($delete) or die(mysql_error());
}

$table_name=$_POST['table_name'];
mysql_query("update $table_name set status=1 WHERE id='{$_POST['user_id']}'");
//mysql_query("DELETE FROM $table_name WHERE id='{$_POST['user_id']}'");
echo "<html><script>alert('Message deleted successfully');</script></html>";
print "<script language='javascript'>document.location='compose.php'</script>";
}
else
{
$table_name=$_POST['table_name'];
mysql_query("update $table_name set status=1 WHERE id='{$_POST['user_id']}'");
//mysql_query("DELETE FROM $table_name WHERE id='{$_POST['user_id']}'");
echo "<html><script>alert('Message deleted successfully');</script></html>";
print "<script language='javascript'>document.location='compose.php'</script>";
}
?>