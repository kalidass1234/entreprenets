<?php
error_reporting(E_ALL ^ E_NOTICE);
include('../includes/all_func.php');
session_start();
	$add_by=$_SESSION['SD_User_Name'];
	$s="select user_id,paid_to,paypal_account from registration where user_name='$add_by'";
	$r=mysql_query($s);
	$f=mysql_fetch_array($r);
	$userid=$f['user_id'];

$sql="select dailydeal_discount from merchant_circle where add_by='$userid'";
$res=mysql_query($sql);
$row=mysql_fetch_assoc($res);
$amount=$_POST['amount1'];
$totcb=$amount*$row['dailydeal_discount']/100;

$sqlcb="select * from admin_cashback where section='merchant_circle'";
$rescb=mysql_query($sqlcb);
$rowcb=mysql_fetch_assoc($rescb);

?>
							  <th scope="row">&nbsp;</th>
							  <td><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #CCCCCC;">
                                <tr>
                                  <th width="50%" scope="row">Total Cash Back</th>
                                  <td width="50%"><?php echo $totcb;?></td>
                                </tr>
                                <tr>
                                  <th scope="row">&nbsp;</th>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <th scope="row">Buyer's</th>
                                  <td><?php echo $totcb*$rowcb['buyer_per']/100;?> </td>
                                </tr>
                                <tr>
                                  <th scope="row">&nbsp;</th>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <th scope="row">Shopdeal</th>
                                  <td><?php echo $totcb*$rowcb['shopdeal_per']/100;?> </td>
                                </tr>
                                <tr>
                                  <th scope="row">&nbsp;</th>
                                  <td>&nbsp;</td>
                                </tr>
								 <tr>
                                  <th scope="row">Uplines</th>
                                  <td><?php echo $totcb*$rowcb['uplines_per']/100;?> </td>
                                </tr>
                               
                              </table></td>
							  <th scope="row"></th>

