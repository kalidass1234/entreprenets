<?php 
error_reporting(E_ALL ^ E_NOTICE);
include("../includes/all_func.php");
include_once ("header.php"); 
require_once '../anet_php_sdk/AuthorizeNet.php';

if(!isset($_SESSION['SD_User_Name']))
{
 header('location:../index.php');
}
  if($_POST['check']==1)
  {
	  $invoice_amont=$_SESSION['total_amount_now'];
	 $tot_tax=$_SESSION['tot_tax'];
	 $date=date('Y-m-d');
	  $total_invo=$invoice_amont+$tot_tax;
	 /*$h=mysql_query("select * from product_delivery"); 
	$h1=mysql_fetch_array($h);
	$d_charge=($h1['delivery_charge']*$invoice_amont)/100;*/
	 $tota=$invoice_amont+$d_charge;

  }
  else
  {
	 $invoice_amont=$_SESSION['total_amount_now'];
	 $tot_tax=$_SESSION['tot_tax'];
	 $date=date('Y-m-d');
	  $total_invo=$invoice_amont+$tot_tax;
	  $tota=$invoice_amont;
  }
 $tota=$tota+$tot_tax;
 $_SESSION['total_amount_now']=$tota;

if ($_REQUEST['normal'])
{
	$pass=$_REQUEST['transactPassword'];
	$sel="select count(*) from registration where t_code='$pass' and user_id='$s_user'";
	$sql=mysql_query($sel);
	$result=mysql_num_rows($sql);
	
	if($result>0 )
	{
		$_SESSION[emode]='Cash On Delivery';
		$_SESSION[edone]='0';
		$_SESSION[done_date]='0000-00-00';
		header('location:conformorder.php');
	}
	else
	{
		?>
		<script type="text/javascript">
		alert('Wrong Transaction Password');
		location.href='conform_order_done.php';
		</script>
		<?php
	}
}
/*
if ($_REQUEST['wallet'])
{
	$pass=$_REQUEST['transactPassword1'];
	 $sel="select count(*) from registration where t_code='$pass' and user_id='$s_user'";
	$sql=mysql_query($sel);
	 $result=mysql_num_rows($sql);
	if($result>0 )
	{		
		$str1="select * from final_e_wallet where user_id='$s_user'";
		$res1=mysql_query($str1);
		$x1=mysql_fetch_array($res1);
		  $total=$x1['amount'];
		  $amount=$_SESSION['total_amount_now'];
		if($total>=$amount)
		{
			/*$fbalance1=$x1['amount']-$amount;	
			$update_cr1=mysql_query("insert into credit_debit(user_id,credit_amt,debit_amt,receiver_id,sender_id,receive_date,Remark,final_bal)values('$id','0','$amount','Admin','$id', '$date','Product Purchase  Through E-wallet','$fbalance1')");
			
			$final_ewallet3=mysql_query("update final_e_wallet set amount=(amount-$amount) where user_id='$s_user'");*/
			
			/*$_SESSION[emode]='e-wallet';
			$_SESSION[done_date]=date('Y-m-d');
			
			$_SESSION[edone]='1';
			 
			   $_SESSION['ch_leg']=$_REQUEST['radio1'];
			   $_SESSION['delivery_mode']=$_REQUEST['office']; 
			 header('location:conformorder.php');
		
		}
		else 
		{  
		?>
<script type="text/javascript">
      
        location.href='conform_order_done.php?msg=Insufficient Fund in your Ewallet';
        </script>
<?php
			 /*header("location:conform_order_done.php?msg=Insufficient Fund in your Ewallet");  */
	/*	}
		
	}
	else
	{
	?>
<script type="text/javascript">
        alert('Wrong Transaction Password');
        location.href='conform_order_done.php';
        </script>
<?php
	}
}*/


function meberins()
{
  //$encypt1=uniqid(rand(), true);
  $encypt1=uniqid(rand(1000000000,9999999999), true);
  $usid1=str_replace(".", "", $encypt1);
  $pre_userid = substr($usid1, 0, 10);
  
  $checkid=mysql_query("select invoice_no from amount_detail where invoice_no='$pre_userid'");
  if(mysql_num_rows($checkid)>0)
  {
	   meberins();
  }
  else
   return $pre_userid;
 } 

$invoicem=meberins();

/*** pyament with credit card */
$sql_master="select * from payment_methods where type='authorize'";
$res_master=mysql_query($sql_master);
$row_master=mysql_fetch_assoc($res_master);
/*$api_login_id = '7XGP6fshN7Q8';
$transaction_key = '7KAX3P4Gaw8tc95n';*/
$api_login_id = $row_master['username'];//'7XGP6fshN7Q8';
$transaction_key = $row_master['account'];//'7KAX3P4Gaw8tc95n';
$producttion_url=$row_master['production_url'];
$amount = $_SESSION['total_amount_now'];
$fp_timestamp = time();

$_SESSION['orderno']=$invoicem;
$fp_sequence = $invoicem;
$_SESSION['payment_for']="shopping";


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
		<h3>Confirm Order</h3>
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
                        <tr>
                          <td>&nbsp;</td>
                          <td>
                          <?php 
						  $user_id=showuserid($_SESSION['SD_User_Name']);
						  $sql_user="select * from registration where user_id='$user_id'";
						  $res_user=mysql_query($sql_user);
						  $row_user=mysql_fetch_assoc($res_user);
						  ?>
                          <!--https://test.authorize.net/gateway/transact.dll
                          https://secure.authorize.net/gateway/transact.dll-->
                          	<form method='post' id="Frmconpaypal" action="<?php echo $producttion_url;?>">
                            <input type='hidden' name="x_login" value="<?php echo $api_login_id?>" />
                            <input type='hidden' name="x_fp_hash" value="<?php echo $fingerprint?>" />
                            <input type='hidden' name="x_amount" value="<?php echo $amount?>" />
                            <input type='hidden' name="x_fp_timestamp" value="<?php echo $fp_timestamp?>" />
                            <input type='hidden' name="x_fp_sequence" value="<?php echo $fp_sequence?>" />
                            <input type='hidden' name="x_version" value="3.1">
                            <input type='hidden' name="x_show_form" value="payment_form">
                            <input type='hidden' name="x_test_request" value="false" />
                            <input type='hidden' name="x_method" value="cc">
                            <input type="hidden" name="x_description" value="Sale" >
                            <input type="hidden" name="x_invoice_num" value="<?php echo $_SESSION['orderno'];?>">
                            <input type="hidden" name="x_first_name" value="<?php echo $row_user['first_name'];?>">
                            <input type="hidden" name="x_last_name" value="<?php echo $row_user['last_name'];?>">
                            <input type="hidden" name="x_address" value="<?php echo $row_user['address'];?>">
                            <input type="hidden" name="x_state" value="<?php echo $row_user['state'];?>">
                            <input type="hidden" name="x_zip" value="<?php echo $row_user['zip'];?>">
                            <input type="hidden" name="x_city" value="<?php echo $row_user['city'];?>">
                            <input type="hidden" name="x_mobile" value="<?php echo $row_user['mobile'];?>">
                            <input type="hidden" name="x_email" value="<?php echo $row_user['email'];?>">
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
                          <td>&nbsp;
                          <a href="evallet.php"><img src="../paymentimage/sponser.png"></a>
                          <!--<form action="evallet.php" method="post" class="form_container left_label">
                              <input type="submit" name="submit22" style="cursor:pointer;" border="0" value="" class="evallet">
                              <input type="hidden" name="p_type" value="<?php echo $return_url; ?>">
                            </form>--></td>
                          <td><!--<a href="paypal.php"><img src="../paymentimage/payPal.png"></a>-->&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
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