<?php 
error_reporting(E_ALL ^ E_NOTICE);
include("../includes/all_func.php");
// check the url hit
if($_SESSION['Session_Rand_No']==$_REQUEST['Session_id'])
{
}
else
{
	header("Location:load_cashwallet.php?msg=wrong url access"); exit;
}
include_once ("header.php"); 
//require_once '../anet_php_sdk/AuthorizeNet.php';

if(!isset($_SESSION['SD_User_Name']))
{
 header('location:../index.php');
}

/*echo "<pre>"; print_r($_SESSION);
echo "<pre>"; print_r($_REQUEST);
exit;*/
// 
function meberins()
{
  //$encypt1=uniqid(rand(), true);
  $encypt1=uniqid(rand(1000000000,9999999999), true);
  $usid1=str_replace(".", "", $encypt1);
  $pre_userid = substr($usid1, 0, 10);
  
  $checkid=mysql_query("select transaction_no from add_money where transaction_no='$pre_userid'");
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
$_SESSION['orderno']=$invoicem;
$_SESSION['payment_for']="Load_Wallet";
$_SESSION['amount']=$_POST['amount'];
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
		<h3>Load Wallet</h3>
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
                <h6>Load Wallet</h6>
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
                          <td colspan="6">You Upgrade Your Account To Earn Affiliate Income</td>
                          
                        </tr>

                       <tr>
                          <td colspan="6">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="3"><img src="../paymentimage/BANKWIRE.png" style="cursor:pointer" onClick="setLocation('load_wallet_bank_wire.php?userupgrade=true&Session_id=<?php echo $_SESSION['Session_Rand_No'];?>');"></td>
                          <td colspan="3"><img src="../paymentimage/payPal.png" style="cursor:pointer" onClick="setLocation('load_wallet_paypal.php?userupgrade=true&Session_id=<?php echo $_SESSION['Session_Rand_No'];?>');"></td>
                          
                        </tr>
                        <tr>
                          <td colspan="6">&nbsp;</td>
                        </tr>
                        <!--<tr>
                          <td colspan="6"><button type="button" onClick="showlocation();">Continue(Direct payment)</button></td>
                        </tr>-->
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
<script>
function showlocation()
{
	window.location.href='upgrade.php?userupgrade=true&Session_id=<?php echo $_SESSION['Session_Rand_No'];?>';
}
function setLocation(url)
{
	window.location.href=url;
}
</script>