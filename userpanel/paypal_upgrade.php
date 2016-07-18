<?php
require_once "../includes/all_func.php";
// get  user detail
$sql_user="select * from registration where user_id='".USERID."'";
$res_user=mysql_query($sql_user);
$row_user=mysql_fetch_assoc($res_user);
$_SESSION['payment_mode']='Paypal';
if($_SESSION['Session_Rand_No']==$_REQUEST['Session_id'])
{
}
else
{
	header("Location:upgrade_payment_package.php?msg=wrong url access"); exit;
}

$sql_master="select * from payment_methods where type='paypal'";
$res_master=mysql_query($sql_master);
$row_master=mysql_fetch_assoc($res_master);
if($row_master['mode']=='test')
{
	$action_url=$row_master['production_url'];
	$merchant_account=$row_master['merchant_account'];
}
if($row_master['mode']=='live')
{
	$action_url=$row_master['test_url'];
	$merchant_account=$row_master['test_merchant_account'];
}
$return_url=$row_master['return_url'];
$cancel_url=$row_master['cancel_url'];
?>
<form name="paypal" id="paypal" method="post" action="<?php echo $action_url;?>"><!--https://www.sandbox.paypal.com/cgi-bin/websc-->
<input type="hidden" name="cmd" value="_cart">  
<input type="hidden" name="business" value="<?php echo $merchant_account;?>"><!--subhash-facilitator@maxtratechnologies.com-->
<input type="hidden" name="upload" value="1">
<input type="hidden" name="item_number" value="<?=$_SESSION['orderno'];?>"> 
<input type="hidden" name="item_name_1" value="Upgrade Account to Affiliate"> 
<input type="hidden" name="amount_1" value="160">
<input type="hidden" name="item_name_2" value="Admin Charge"> 
<input type="hidden" name="amount_2" value="8">  
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="return" value="<?php echo $host_name;?>userpanel/upgrade.php?pay_mode=paypal&paypal=1&invoice=<?=$_SESSION['orderno'];?>&userupgrade=true&Session_id=<?php echo $_SESSION['Session_Rand_No'];?>">
<input type="hidden" name="cancel_return" value="<?php echo $host_name;?>userpanel/payment_fail.php?error=Transaction Failed. Please Try Again">
<input type="hidden" name="first_name" value="<?php echo $row_user['first_name'];?>">  
<input type="hidden" name="last_name" value="<?php echo $row_user['last_name'];?>">  
<input type="hidden" name="address1" value="<?php echo $row_user['address1'];?>">  
<input type="hidden" name="city" value="<?php echo $row_user['city'];?>">  
<input type="hidden" name="state" value="<?php echo $row_user['state'];?>">  
<input type="hidden" name="zip" value="<?php echo $row_user['zip'];?>">  
<input type="hidden" name="night_phone_a" value="<?php echo $row_user['mobile'];?>">  
<input type="hidden" name="email" value="<?php echo $row_user['email'];?>">
</form>
<script>
document.getElementById('paypal').submit();
</script>