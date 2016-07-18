<?php 
//session_start();
include('../includes/all_func.php');
if(!$_SESSION['adid'])
{
 //header('location:login.php');
}
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
	$main_file_name=$arr_file[0].".".$ext;
	move_uploaded_file($_FILES['attachfile']['tmp_name'],"attachfile/".$file_name); 
}
else if($_POST['attachfile_name'])
{
	$file_name=$_POST['attachfile_name'];
}
$draft_id=$_REQUEST['draft_id'];
$sql_d=mysql_query("select * from message_draft where id='$draft_id'");
$count_d=mysql_num_rows($sql_d);
if($count_d)
{
	mysql_query("update message_draft set status=1 where id='$draft_id'");
}


//echo "<pre>"; print_r($_POST); exit;
 $ins="insert into message(user_id,subject,message,reciever_id,sender_id,sender_name,reciever_name,msg_date,file_name) values ('$id','$subject','$msg','$r_id','$id','$res_send[user_name]','$u_name','$date','$file_name')";
$data=mysql_query($ins) or die("error");

 $ins="insert into message_sender(user_id,subject,message,reciever_id,sender_id,sender_name,reciever_name,msg_date,file_name) values ('$id','$subject','$msg','$r_id','$id','$res_send[user_name]','$u_name','$date','$file_name')";
$data=mysql_query($ins) or die("error");

if($_POST['email'])
{
	if($file_name!='')
	{
	$mailto=$_POST['email'];
	$cc=$_POST['cc'];
	$bcc=$_POST['bcc'];
	$from_mail='subhash@maxtratechnologies.com';
	$from_name='AWUF';
	$replyto='subhash@maxtratechnologies.com';
	$file = "attachfile/".$file_name;
		$file_size = filesize($file);
		$handle = fopen($file, "r");
		$content = fread($handle, $file_size);
		fclose($handle);
		$content = chunk_split(base64_encode($content));
		$uid = md5(uniqid(time()));
		$name = basename($file);
		$header = "From: ".$from_name." <".$from_mail.">\r\n";
		$header.= "Cc: $cc" . "\r\n";
		$header.= "Bcc: $bcc" . "\r\n";
		$header .= "Reply-To: ".$replyto."\r\n";
		$header .= "MIME-Version: 1.0\r\n";
		$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
		$header .= "This is a multi-part message in MIME format.\r\n";
		$header .= "--".$uid."\r\n";
		$header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
		$header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
		$header .= $msg."\r\n\r\n";
		$header .= "--".$uid."\r\n";
		$header .= "Content-Type: application/octet-stream; name=\"".$file_name."\"\r\n"; // use different content types here
		$header .= "Content-Transfer-Encoding: base64\r\n";
		$header .= "Content-Disposition: attachment; filename=\"".$file_name."\"\r\n\r\n";
		$header .= $content."\r\n\r\n";
		$header .= "--".$uid."--";
		
		mail($mailto, $subject, "", $header);
	}
	else
	{
		$to=$_POST['email'];
		$cc=$_POST['cc'];
		$bcc=$_POST['bcc'];
		$from='subhash@maxtratechnologies.com';
		 
		$header = "From: AWUF<" .$from. ">\r\n"; 
		$header.= "Cc: $cc" . "\r\n";
		$header.= "Bcc: $bcc" . "\r\n";
		$header.= "X-Mailer: PHP/" . phpversion();
	//echo $to;
		mail($to, $subject, $msg, $header);
	}
}
echo "<html><script>alert('Message has been sent Successfully');</script></html>";
/*print"<script>document.location='compose.php';</script>";*/
}
 else{
 	echo "<html><script>alert('Username is not valid.');</script></html>";
/*print"<script>document.location='compose.php';</script>";*/

 }
 
?>