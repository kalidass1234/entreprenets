<script>
//window.location.href='upgrade_account_category_two.php';
</script>
<?php 
error_reporting(E_ALL ^ E_NOTICE);
include("../includes/all_func.php");
include_once ("header.php"); 
require_once '../anet_php_sdk/AuthorizeNet.php';

if(!isset($_SESSION['SD_User_Name']))
{
 header('location:../index.php');
}
//echo "<pre>"; print_r($_POST);
function meberins()
{
  //$encypt1=uniqid(rand(), true);
  $encypt1=uniqid(rand(1000000000,9999999999), true);
  $usid1=str_replace(".", "", $encypt1);
  $pre_userid = substr($usid1, 0, 10);
  
  $checkid=mysql_query("select pin_no from registration where pin_no='$pre_userid'");
  if(mysql_num_rows($checkid)>0)
  {
	   meberins();
  }
  else
   return $pre_userid;
 } 

$invoicem=meberins();

$user_id=showuserid($_SESSION['SD_User_Name']);

$sql_user="select * from registration where user_id='$user_id'";
$res_user=mysql_query($sql_user);
$row_user=mysql_fetch_assoc($res_user);

$category_one=$row_user['category_one'];
$category_two=$row_user['category_two'];
$category_three=$row_user['category_three'];
if($category_one || $category_three)
{
	$_SESSION['total_amount_now']=84.99;
	$_SESSION['category']='category_two';
}
/*** pyament with credit card */
$api_login_id = '7XGP6fshN7Q8';
$transaction_key = '7KAX3P4Gaw8tc95n';
$amount = $_SESSION['total_amount_now'];
$fp_timestamp = time();

$_SESSION['orderno']=$invoicem;
$fp_sequence = $invoicem;
$_SESSION['payment_for']="Upgrade";


$fingerprint = AuthorizeNetSIM_Form::getFingerprint($api_login_id,
$transaction_key, $amount, $fp_sequence, $fp_timestamp);


/** show amount from final ewallet of user */
  $s="select * from final_e_wallet where user_id='$s_user'";
  $q_r=mysql_query($s);
  $pin_receive_total=mysql_num_rows($q_r);
  while($row=mysql_fetch_array($q_r))
  {
	$x=$row['amount'];
	$z+=$x;
 }

?>

<script type="text/javascript">
	function ableInput(){
	//alert('display'); 
		document.getElementById('v1').style.display='';	
		document.getElementById('v11').style.display='';
	}
	function disableInput(){
		//alert('hidden');
		document.getElementById('text1').style.display='none';	
	}
</script>
<style type="text/css">
table.display td input[type=submit] {
	height: 30px !important;
	padding: 0 5px;
	border: #093868 1px solid;
}
table.display td input[type=submit] {
	border: #093868 1px solid;
}
input[type="submit"].payza {
	background:url(../paymentimage/payZa.png) no-repeat;
	border:none;
	height:73px;
	width:242px;
}
input[type="submit"].paypal1 {
	background:url(../paymentimage/payPal.png) no-repeat;
	border:none;
	height: 73px;
	width: 242px;
}
input[type="submit"].paypa91 {
	background:url(../paymentimage/payCC.png) no-repeat;
	border:none;
	height: 73px;
	width: 242px;
}
input[type="submit"].paypa92 {
	background:url(../paymentimage/payCC.png) no-repeat;
	border:none;
	height: 73px;
	width: 242px;
}
input[type="submit"].evallet {
	background:url(../paymentimage/sponser.png) no-repeat;
	border:none;
	height: 73px;
	width: 242px;
}
</style>
<body id="theme-default" class="full_block">
<div id="actionsBox" class="actionsBox">
  <div id="actionsBoxMenu" class="menu"> <span id="cntBoxMenu">0</span> <a class="button box_action">Archive</a> <a class="button box_action">Delete</a> <a id="toggleBoxMenu" class="open"></a> <a id="closeBoxMenu" class="button t_close">X</a> </div>
  <div class="submenu"> <a class="first box_action">Move...</a> <a class="box_action">Mark as read</a> <a class="box_action">Mark as unread</a> <a class="last box_action">Spam</a> </div>
</div>
<?php include('left-bar.php');?>
<div id="container">
  <div id="header" class="blue_lin">
		<div class="header_left">
			<?php
			include('header-left.php');
			?>
			<?php
			include('menu-mobile.php');
			?>
		</div>
		<?php
		include('header-right.php');
		?>
	</div>
	<div class="page_title">
		<span class="title_icon"><span class="coverflow"></span></span>
		<h3>Upgrade Account</h3>
		<!--<div class="top_search">
			<form action="#" method="post">
				<ul id="search_box">
					<li>
					<input name="" type="text" class="search_input" id="suggest1" placeholder="Search...">
					</li>
					<li>
					<input name="" type="submit" value="" class="search_btn">
					</li>
				</ul>
			</form>
		</div>-->
	</div>
  <div id="content">
    <div class="grid_container">
      <div class="grid_12 full_block">
        <div class="widget_wrap">
          <div class="grid_12">
            <div class="widget_wrap tabby">
              <div class="widget_top">
                <h6>My Current Cart</h6>
              </div>
              <div class="widget_content">
                <div id="tab2">
                  <div class="widget_content">
                    <div style="width:85%; margin-left:10%;">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <?php 
						if($category_one || $category_three)
						{
						?>
                        
                        <tr>
                          <td colspan="6">You Upgrade Your Account To Earn Residual Income</td>
                          
                        </tr>
                        
                        <tr>
                          <td>&nbsp;</td>
                          <td>
                          <!--https://test.authorize.net/gateway/transact.dll
                          https://secure.authorize.net/gateway/transact.dll-->
                          	<form method='post' id="Frmconpaypal" action=" https://test.authorize.net/gateway/transact.dll">
                            <input type='hidden' name="x_login" value="<?php echo $api_login_id?>" />
                            <input type='hidden' name="x_fp_hash" value="<?php echo $fingerprint?>" />
                            <input type='hidden' name="x_amount" value="<?php echo $amount?>" />
                            <input type='hidden' name="x_fp_timestamp" value="<?php echo $fp_timestamp?>" />
                            <input type='hidden' name="x_fp_sequence" value="<?php echo $fp_sequence?>" />
                            <input type='hidden' name="x_version" value="3.1">
                            <input type='hidden' name="x_show_form" value="payment_form">
                            <input type='hidden' name="x_test_request" value="false" />
                            <input type='hidden' name="x_method" value="cc">
                            <input type="hidden" name="x_description" value="Upgrade" >
                            <input type="hidden" name="x_invoice_num" value="<?php echo $_SESSION['orderno'];?>">
                            <!--<input type="hidden" name="x_receipt_link_method" value="LINK" >
    <input type="hidden" name="x_receipt_link_url" value="http://198.154.192.169/~develope/mike/index.php" >
    <input type="hidden" name="x_relay_response" value="TRUE" >
    <input type="hidden" name="x_relay_url" value="http://198.154.192.169/~develope/mike/index.php" >-->
                          		<!--<form action="" method="post">
                              <input type="hidden" name="merchant_id" value="livingwell">
                              <input type="hidden" name="token" value="<?php //echo $newID?>">
                              <input type="hidden" name="display_text" value="<?php //echo $packagename;?>">
                              <input type="hidden" name="currency" value="USD">
                              <input type="hidden" name="amount" value="<?php //echo $_SESSION['total_price'];?>">
                              <input type="hidden" name="language" value="en">
                              <input type="hidden" name="session_id" value="asdasd-234-asdasd">
                              <input type="hidden" name="txt1" value="<?php //echo $packagename;?>">
                              <input type="hidden" name="thanx_url" value="<?php //echo $return_url ?>.php?cashu=1&order_no=<?=$newID;?>&payment=1">
                              <input type="hidden" name="errorCode" value="<?php //echo $error_url ?>.php?error=Transaction Failed. Please Try Again"/>-->
                              <input type="submit" name="submit22" border="0" value="" style="cursor:pointer;" class="paypa91">
                            </form></td>
                          <td>&nbsp;</td>
                          <td><!--<form action="upgrade_evallet.php" method="post" class="form_container left_label">
                              <input type="submit" name="submit22" style="cursor:pointer;" border="0" value="" class="evallet">
                              <input type="hidden" name="p_type" value="<?php //echo $return_url; ?>">
                            </form>--></td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <?php
						}
						?>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <span class="clear"></span></div>
    <span class="clear"></span> </div>
</div>
</body>
</html>