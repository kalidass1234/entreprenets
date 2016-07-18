<?php
session_start();
include("controller/connection.php");
$mobile=$_REQUEST['mobile'];
$email=$_REQUEST['email'];
$user=$_REQUEST['user'];
$str="select * from registration where user_id='$user'";
$res=mysql_query($str);
$x=mysql_fetch_array($res);
$tpass=$x['t_code'];
/*$vmobile=$x['mobile'];
if($vmobile==$mobile)*/
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.perfectsmsc.com/messageapi.asp?username=moneyrises&password=75318886&sender=SDPLAN&mobile=$mobile&message=password%20is%20$tpass.");
curl_setopt($ch, CURLOPT_HEADER, 0);
$response=curl_exec($ch);
curl_close($ch);
/* //}
}
else
{
  $msg="your mobile number and email id has been not match";
  header("location:Gettransaction_code.php?msg=$msg");	
 }

}*/

?>
<script language="javascript">
location.href='index.php';
</script>




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
