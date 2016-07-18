<?php
session_start();
include("../includes/all_func.php");
$q=trim($_GET["q"]);
$user_id=showuserid($_SESSION['SD_User_Name']); 
$sql="SELECT * FROM pins WHERE pin_no='$q' and receiver_id='$user_id'";
$result = mysql_query($sql);
$num=mysql_num_rows($result);
if($num>0){
$x=mysql_fetch_array($result);
if($x[status]==0){$status='Fresh';}else{$status='Used';}

  echo "<table width='200' border='0'>
  <tr>
    <td width='61'>Pin No. </td>
    <td width='10'>&nbsp;</td>
    <td width='115'>$x[pin_no]</td>
  </tr>
  <tr>
    <td>Amount</td>
    <td></td>
    <td>$x[amount]</td>
  </tr>
  <tr>
    <td>Status</td>
    <td>&nbsp;</td>
    <td>$status</td>
  </tr>
</table>
";}else{echo "<b style='color:#FF0000'>Wrong Pin No.</b>";}
?>
