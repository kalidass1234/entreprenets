<?php
include('../includes/all_func.php');
extract($_REQUEST);
mysql_query("update purchase_detail set shipc='$shipc',ship_traking='$track_no',ship_status=1,read_receiver=1 where pd_id='$pd_id' and p_id='$p_id'");
$res=mysql_affected_rows();
if($res>=1)
{
echo 'yes';
}
else
{
echo 'no';
}
?>