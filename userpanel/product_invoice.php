<?php
error_reporting(E_ALL ^ E_NOTICE);
include("../includes/all_func.php");
include_once ("header.php");
if(!isset($_SESSION['SD_User_Name']))

{

 header('location:../index.php');

}
$invoice_amont=$_SESSION['total_amount_now'];

$h=mysql_query("select * from tax"); 
$h1=mysql_fetch_array($h);
$tot_tax=($h1['tax']*$invoice_amont)/100;
 

$_SESSION['tot_tax']=$tot_tax;
$date=date('Y-m-d');
$total_invo=$invoice_amont+$tot_tax;
$d_charge=$_SESSION['shipping'];
$tota=$invoice_amont+$d_charge;
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
			$fbalance1=$x1['amount']-$amount;	
			$update_cr1=mysql_query("insert into credit_debit(user_id,credit_amt,debit_amt,receiver_id,sender_id,receive_date,Remark,final_bal)values('$id','0','$amount','Admin','$id', '$date','Product Purchase  Through E-wallet','$fbalance1')");
			$final_ewallet3=mysql_query("update final_e_wallet set amount=(amount-$amount) where user_id='$s_user'");
			$_SESSION[emode]='e-wallet';
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
		}
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

  $s="select * from final_e_wallet where user_id='$s_user'";

			$q_r=mysql_query($s);

			$pin_receive_total=mysql_num_rows($q_r);

			while($row=mysql_fetch_array($q_r))

			{

			

			$z=$row['amount'];

		

			}

?>

<script type="text/javascript">

	function ableInput(){

	//alert('display'); 

		document.getElementById('total_amt1').style.display='';

		document.getElementById('total_amt').style.display='none';

		document.getElementById('pickup1').style.display='';

	}

	function disableInput(){

		document.getElementById('total_amt1').style.display='none';

		document.getElementById('total_amt').style.display='';

		document.getElementById('pickup1').style.display='none';

		

	}

</script>

<style type="text/css">

 table.display td input[type=submit] {

height: 30px !important;

padding: 0 5px;

border: #093868 1px solid;



}

 table.display td input[type=submit] {

	 border: #093868 1px solid;}



input[type="submit"].payza{

	background:url(../paymentimage/payZa.png) no-repeat;

	border:none;

	height:73px;

	width:242px;

}

input[type="submit"].paypal1{

	background:url(../paymentimage/payPal.png) no-repeat;

	border:none;

	height: 73px;

width: 242px;

}



input[type="submit"].paypa91{

	background:url(../paymentimage/cashu.png) no-repeat;

	border:none;

	height: 73px;

width: 242px;

}



input[type="submit"].paypa92{

	background:url(../paymentimage/payCC.png) no-repeat;

	border:none;

	height: 73px;

width: 242px;

} 

input[type="submit"].evallet{

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
		<h3>Product Invoice</h3>
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

               

                    <div class="oilhold">

   							<form action="conform_order_done.php" method="post" class="form_container left_label">

							<ul>

                           <div class="form_grid_12" style="margin:5%; padding-top:1%;display:none;">

								

			      <span class="checked"><!--<input name="check" class="radio" type="radio" value="2" tabindex="19" style="opacity: 0;" onClick="disableInput()" checked="checked"></span>Home<span class="checked">

								<input type="radio" value="1" name="check" onClick="ableInput()" class="radio" tabindex="19" style="opacity: 0;" >

						Pickup --> </span>	

								</div>

							<li>

								<div class="form_grid_12">

									<label class="field_title">Total Purchase Amount:</label>

									<div class="form_input"><?php echo "$".$invoice_amont; ?></div>

								</div>

								</li>

								<li id="pickup1" >

								<div class="form_grid_12">

									<label class="field_title"> Shipping &amp; Handling Charge:</label>

									<div class="form_input">

										$<?php echo $d_charge;?>

									</div>

								</div>

								</li>
                                
                                <li id="pickup1" >

								<div class="form_grid_12">

									<label class="field_title"> Tax:</label>

									<div class="form_input">

										$<?php echo $tot_tax; ?>

									</div>

								</div>

								</li>

                              

								<li id="total_amt" style="display:none;">

								<div class="form_grid_12" >

									<label class="field_title"> Total Invoice Amount:</label>

									<div class="form_input">

										<?php echo "$".$invoice_amont; ?>

										

									</div>

								</div>

								</li>

							

								<li id="total_amt1">

								<div class="form_grid_12">

									<label class="field_title"> Total Invoice Amount:</label>

									<div class="form_input">

										<?php echo "$".$tota; ?>

										

									</div>

								</div>

								</li>

								

								

								<li>

								<div class="form_grid_12">

									<div class="form_input"><input type="hidden" id="user_id" name="user_id" value="<? echo $id;?>" />

										<button type="submit" class="btn_small btn_blue" ><span>Proceed</span></button>

                                        <a href="eshop_check.php"><button type="button" class="btn_small btn_blue" ><span>Back</span></button></a>

										

									</div>

								</div>

								</li>

							</ul>

						</form>

					

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