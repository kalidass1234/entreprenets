<?php
include('../includes/all_func.php');
error_reporting(0);
session_start();
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
$idd=$_SESSION['SD_User_Name'];
$uid=showuserid($_SESSION['SD_User_Name']);
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}
if($_GET['target']!='inbox')
{
$table_name="message_sender";
//echo "update `message` set `read_sender`='0' where id='$_GET[id]' and sender_id = '$uid'";
mysql_query("update `message_sender` set `read_sender`='0' where id='$_GET[id]' and sender_id = '$uid'");
}
if($_GET['target']=='inbox')
{
$table_name="message";
mysql_query("update `message` set `read_receiver`='0' where id='$_GET[id]' and reciever_id = '$uid'");
}
//include('includes/notificationcount.php');
?>
					<?php
					$id=$_GET['id'];
					$sql_sel=mysql_query("SELECT * FROM $table_name WHERE id=$id");
						$res_sel=mysql_fetch_array($sql_sel);
					?>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="row">Reciever Name</th>
    <td><?= $res_sel[reciever_name]; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">Subject</th>
    <td><?= $res_sel[subject] ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">Message</th>
    <td><?= $res_sel[message] ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row"></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php if($res_sel['file_name']){?>
  <tr>
    <th scope="row">Attach File</th>
    <td><a href="attachfile/<?= $res_sel[file_name] ?>" target="_blank">Attach File</a></td>
    <td>&nbsp;</td>
  </tr>
  <?php
								}
								?>
  <tr>
    <th scope="row">Message Time</th>
    <td><?php
								 $curdate=date('Y-m-d');
								 $sentdate=date('Y-m-d', strtotime($res_sel['ts']));
								 $curtime=strtotime($curdate);
								 $senttime=strtotime($sentdate);
								 if($senttime=$curtime){ echo date('H:i:s', strtotime($res_sel['ts']));}
								 else {  echo date('d M, Y',strtotime($res_sel['ts']));}
								 
								//echo date('d M, Y',strtotime($x1['ts']));?></td>
    <td>&nbsp;</td>
  </tr>
</table>

<script type="text/javascript">
window.print();
</script>						