<?PHP
session_start();
/*echo "<pre>"; print_r($_POST);exit;
echo "<pre>"; print_r($_SESSION);exit;*/

include_once('../includes/all_func.php');
extract($_POST);
$x_exp_date=$exp_month.$exp_year;
//$_SESSION['amount']=0.1;
// check if user subscription expire till 72 hour the 25 dollor add in amount
$user_id=showuserid($_SESSION['SD_User_Name']);
$category=$_SESSION['category'];
$sql_subs="select * from subscription where user_id='$user_id'  and type='$category' order by id desc limit 1";
$res_subs=mysql_query($sql_subs);
$count_subs=mysql_num_rows($res_subs);
if($count_subs)
{
	// check for 72 hour 
	$row_subs=mysql_fetch_assoc($res_subs);
	if($row_subs['status']==1 || $row_subs['status']==2)
	{
		$end_date=strtotime($row_subs['update_time']);
		$curdate=time();
		$diff=floor(($curdate-$end_date)/8640);
		if($diff>=72)
		{
			$penalty=25;
		}
		else
		{
			$penalty=0;
		}
	}
}
// end of the penalty
$x_amount=$_SESSION['amount']+$penalty;
$fp_timestamp = time();
function meberins()
	 {
	  //$encypt1=uniqid(rand(), true);
	  $encypt1=uniqid(rand(1000000000,9999999999), true);
	  $usid1=str_replace(".", "", $encypt1);
	  $pre_userid = substr($usid1, 0, 10);
	  
	  $checkid=mysql_query("select business_name from registration where business_name='$pre_userid'");
	  if(mysql_num_rows($checkid)>0)
	  {
	   meberins();
	  }
	  else
	   return $pre_userid;
	 }
	 $invoicem=meberins();
	 
$_SESSION['orderno']=$invoicem;
$_SESSION['payment_for'] = "registration";
$_SESSION['paymode']='credit_card';
$fp_sequence = $invoicem; // Enter an invoice or other unique number.
//$fingerprint = AuthorizeNetSIM_Form::getFingerprint($api_login_id, $transaction_key, $amount, $fp_sequence, $fp_timestamp)
// By default, this sample code is designed to post to our test server for
// developer accounts: https://test.authorize.net/gateway/transact.dll
// for real accounts (even in test mode), please make sure that you are
// posting to: https://secure.authorize.net/gateway/transact.dll
// find the authorize.net login and tansaction key x_login=7XGP6fshN7Q8    x_tran_key=7KAX3P4Gaw8tc95n;
$sql_master="select * from payment_methods where type='authorize'";
$res_master=mysql_query($sql_master);
$row_master=mysql_fetch_assoc($res_master);
//$post_url = "https://test.authorize.net/gateway/transact.dll";
$post_url =$row_master['production_url'];
$post_values = array(
	// the API Login ID and Transaction Key must be replaced with valid values
	"x_login"			=> $row_master['username'],
	"x_tran_key"		=> $row_master['account'],
	"x_version"			=> "3.1",
	"x_delim_data"		=> "TRUE",
	"x_delim_char"		=> "|",
	"x_relay_response"	=> "FALSE",
	"x_type"			=> "AUTH_CAPTURE",
	"x_method"			=> "CC",
	"x_card_num"		=> $card_no,
	"x_exp_date"		=> $x_exp_date,
	"x_amount"			=> $x_amount,
	"x_description"		=> "Registration",
	"x_invoice_num"		=> $_SESSION['orderno'],
	"x_first_name"		=> $x_first_name,
	"x_last_name"		=> $x_last_name,
	"x_address"			=> $x_address,
	"x_state"			=> $x_state,
	"x_zip"				=> $x_zip,
	"x_city"			=> $x_city,
	"x_mobile"			=> $x_mobile,
	"x_email"			=> $x_email
	// Additional fields can be added here as outlined in the AIM integration
	// guide at: http://developer.authorize.net
);

// This section takes the input fields and converts them to the proper format
// for an http post.  For example: "x_login=username&x_tran_key=a1B2c3D4"
$post_string = "";
foreach( $post_values as $key => $value )
	{ $post_string .= "$key=" . urlencode( $value ) . "&"; }
$post_string = rtrim( $post_string, "& " );

// The following section provides an example of how to add line item details to
// the post string.  Because line items may consist of multiple values with the
// same key/name, they cannot be simply added into the above array.
//
// This section is commented out by default.
/*
$line_items = array(
	"item1<|>golf balls<|><|>2<|>18.95<|>Y",
	"item2<|>golf bag<|>Wilson golf carry bag, red<|>1<|>39.99<|>Y",
	"item3<|>book<|>Golf for Dummies<|>1<|>21.99<|>Y");
	
foreach( $line_items as $value )
	{ $post_string .= "&x_line_item=" . urlencode( $value ); }
*/

// This sample code uses the CURL library for php to establish a connection,
// submit the post, and record the response.
// If you receive an error, you may want to ensure that you have the curl
// library enabled in your php configuration
$request = curl_init($post_url); // initiate curl object
	curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
	curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
	curl_setopt($request, CURLOPT_POSTFIELDS, $post_string); // use HTTP POST to send form data
	curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response.
	$post_response = curl_exec($request); // execute curl post and store results in $post_response
	// additional options may be required depending upon your server configuration
	// you can find documentation on curl options at http://www.php.net/curl_setopt
curl_close ($request); // close curl object

// This line takes the response and breaks it into an array using the specified delimiting character
$response_array = explode($post_values["x_delim_char"],$post_response);
//print_r($response_array);
# redirect to regis.php page
if($response_array[0]==1)
{
	//echo $response_array[3];
	$rr_json=json_encode($response_array);
	$transaction_no_card=$response_array[6];
	$_SESSION['total_price']=$_SESSION['amount'];
	$user_name=$_SESSION['user_name'];
	include("../php_arb_xml/subscription_create.php");
	include("../XML/profile_create.php");
	$subscription_id=$_SESSION['subscription_id'];
	$insert="insert into billing_address set user_name='$user_name',first_name='$x_first_name',last_name='$x_last_name',mobile='$x_mobile',email='$x_email',address1='$x_address',city='$x_city',state='$x_state',zip='$x_zip',country='USA',card_type='$card_type',card_no='$card_no',exp_date='$x_exp_date',cvv='$cvv',response_array='$rr_json',transaction_no_card='$transaction_no_card',subscription_id='$subscription_id'";
	//echo $insert;exit;
	mysql_query($insert);
	
	?>
<script>window.location.href='../upgrade_one.php';</script>
<?php
	//header("Location:../upgrade_one.php");
	//header("Location:regis.php");
}
else
{
	$msg=$response_array[3];
	?>
<script>window.location.href='../payment_fail.php?msg=<?php echo $msg;?>';</script>
<?php
	//header("Location:../payment_fail.php?msg=".$msg);
	//echo $response_array[3];
}
exit;
# end of redirection
// The results are output to the screen in the form of an html numbered list.
//print_r($response_array);
echo "<OL>\n";
foreach ($response_array as $value)
{
	echo "<LI>" . $value . "&nbsp;</LI>\n";
}
echo "</OL>\n";
// individual elements of the array could be accessed to read certain response
// fields.  For example, response_array[0] would return the Response Code,
// response_array[2] would return the Response Reason Code.
// for a list of response fields, please review the AIM Implementation Guide
?>