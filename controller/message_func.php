<?php
include('connection.php');
echo $u_name=$_REQUEST['u_name'];
$subject=$_REQUEST['subject'];
$msg=$_REQUEST['msg'];
 

echo $insert= "insert into message(reciever_id,subject,message,msg_date)values('$u_name','$subject','$msg','$date')";
exit();
$qur=mysql_query($insert) or die("error");

 
?>