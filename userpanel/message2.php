<?php 
session_start();
include('../includes/all_func.php');
if(!$_SESSION['adid'])
{
 //header('location:login.php');
}
//echo "<pre>"; print_r($_POST); print_r($_FILES); exit;
$idd=$_SESSION['adid'];
$s="select user_id from registration where user_name='$idd'";
$r=mysql_query($s);
$f=mysql_fetch_array($r);
$id=$f['user_id'];

$send=mysql_query("select *from registration where user_id='$id'");
$res_send=mysql_fetch_array($send);
//exit;
$u_name=$_REQUEST['u_name'];
$subject=$_REQUEST['filed01'];
$msg=$_REQUEST['filed06']; 
$idd=$_REQUEST['user_id']; 
$draft_id=$_REQUEST['draft_id']; 
$date=date("Y-m-d");
$find=mysql_query("select *from registration where user_name='$u_name'");
$res=mysql_fetch_array($find);
$r_id=$res[user_id];

if(mysql_num_rows($find)>0){

if($_FILES['attachfile']['name']!='')
{
	$arr_file=explode(".",$_FILES['attachfile']['name']);
	$ext=end($arr_file);
	$filename=$arr_file[0];
	$file_name=$filename."_".time().".".$ext;
	 move_uploaded_file($_FILES['attachfile']['tmp_name'],"attachfile/".$file_name); 
}
else if($_POST['attachfile_name'])
{
	$file_name=$_POST['attachfile_name'];
}
$sql_d=mysql_query("select * from message_draft where id='$draft_id'");
$count_d=mysql_num_rows($sql_d);
if($count_d)
{
	 mysql_query("update message_draft set user_id='$id',subject='$subject',message='$msg',reciever_id='$r_id',sender_id='$id',sender_name='$res_send[user_name]',reciever_name='$u_name',msg_date='$date',file_name='$file_name' where id='$draft_id'");
	 echo $iis=$draft_id;
}
else
{
$ins="insert into message_draft(user_id,subject,message,reciever_id,sender_id,sender_name,reciever_name,msg_date,file_name) values ('$id','$subject','$msg','$r_id','$id','$res_send[user_name]','$u_name','$date','$file_name')";
	 $data=mysql_query($ins) or die("error");
	 echo $ii=mysql_insert_id();
}
 $ins="insert into message_sender(user_id,subject,message,reciever_id,sender_id,sender_name,reciever_name,msg_date,file_name) values ('$id','$subject','$msg','$r_id','$id','$res_send[user_name]','$u_name','$date','$file_name')";
//$data=mysql_query($ins) or die("error");
/*echo "<html><script>alert('Message has been saved Successfully');</script></html>";*/
/*print"<script>document.location='compose.php';</script>";*/
}
 else{
 	echo "<html><script>alert('Username is not valid.');</script></html>";
/*print"<script>document.location='compose.php';</script>";*/

 }
 
?>