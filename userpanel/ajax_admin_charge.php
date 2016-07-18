<?php
include("../includes/all_func.php");
$amount=$_REQUEST['amount'];
$sql_charge="SELECT * FROM `master_group_income` where '$amount' between `from` and `to`";
$res_charge=mysql_query($sql_charge);
$count_charge=mysql_num_rows($res_charge);
if($count_charge)
{
	$row_charge=mysql_fetch_assoc($res_charge);
	$admin_charge=$row_charge['teambv'];
}
if($amount>=300)
{
	$admin_charge=3;
}
else
{
	$admin_charge=3;
}
$total=$amount+$admin_charge;
?>
<?php echo $admin_charge.",".$total;?>
