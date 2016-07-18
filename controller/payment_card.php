<?php
session_start();
include_once('controller/connection.php');
require_once 'anet_php_sdk/AuthorizeNet.php'; // Include the SDK you downloaded in Step 2
$api_login_id = '7XGP6fshN7Q8';
$transaction_key = '7KAX3P4Gaw8tc95n';
$amount = $_SESSION['total_price'];
$fp_timestamp = time();


function meberins()
	 {
	  //$encypt1=uniqid(rand(), true);
	  $encypt1=uniqid(rand(1000000000,9999999999), true);
	  $usid1=str_replace(".", "", $encypt1);
	  $pre_userid = substr($usid1, 0, 10);
	  
	  $checkid=mysql_query("select invoice from membership where invoice='$pre_userid'");
	  if(mysql_num_rows($checkid)>0)
	  {
	   meberins();
	  }
	  else
	   return $pre_userid;
	 }
	 $invoicem=meberins();
	 
$_SESSION['orderno']=$invoicem;
echo "<pre>";
print_r($_SESSION);

$fp_sequence = $invoicem; // Enter an invoice or other unique number.
$fingerprint = AuthorizeNetSIM_Form::getFingerprint($api_login_id,
  $transaction_key, $amount, $fp_sequence, $fp_timestamp)
?>
<form method='post' id="Frmconpaypal" action="https://test.authorize.net/gateway/transact.dll">
<input type='hidden' name="x_login" value="<?php echo $api_login_id?>" />
<input type='hidden' name="x_fp_hash" value="<?php echo $fingerprint?>" />
<input type='hidden' name="x_amount" value="<?php echo $amount?>" />
<input type='hidden' name="x_fp_timestamp" value="<?php echo $fp_timestamp?>" />
<input type='hidden' name="x_fp_sequence" value="<?php echo $fp_sequence?>" />
<input type='hidden' name="x_version" value="3.1">
<input type='hidden' name="x_show_form" value="payment_form">
<input type='hidden' name="x_test_request" value="false" />
<input type='hidden' name="x_method" value="cc">
<input type='submit' value="Click here for the secure payment form">
</form>
<script type="text/javascript">
  //document.getElementById('Frmconpaypal').submit();
</script>