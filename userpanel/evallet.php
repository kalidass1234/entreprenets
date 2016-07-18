<?php 
include("../includes/all_func.php");
include_once ("header.php"); 

if(!$_SESSION['SD_User_Name'])
{
 header('location:../index.php');
}
$user_id=showuserid($_SESSION['SD_User_Name']);
$res_ewallet=mysql_fetch_array(mysql_query("select * from final_e_wallet where user_id='{$user_id}'"));
$amount=$res_ewallet['amount'];
$cost=$_SESSION['total_amount_now'];
$return_url=$_SESSION[p_type];

?>
<body id="theme-default" class="full_block">
<div id="actionsBox" class="actionsBox">

	<div id="actionsBoxMenu" class="menu">

		<span id="cntBoxMenu">0</span>

		<a class="button box_action">Archive</a>

		<a class="button box_action">Delete</a>

		<a id="toggleBoxMenu" class="open"></a>

		<a id="closeBoxMenu" class="button t_close">X</a>

	</div>

	<div class="submenu">

		<a class="first box_action">Move...</a>

		<a class="box_action">Mark as read</a>

		<a class="box_action">Mark as unread</a>

		<a class="last box_action">Spam</a>

	</div>

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
		<h3>Announcement</h3>
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

						

						<h6>Pay With Ewallet</h6>

						

					</div>

					<div class="widget_content">

					<div>

						

					</div>

						<div id="tab1">

							<div class="rightmain">

				<div id="announcer" >



			  	<div class="oilhold">

                <?php 
//echo $amount.'>='.$cost;
					if($amount>=$cost){

			

				?>

					<form action="confirmorder.php?pay_mode=ewallet" method="post" class="form_container left_label">

							<ul>
								<li>

								<div class="form_grid_12">

									<label class="field_title">Transaction Password</label>

									<div class="form_input">

										<input required type="password" name="password" style="width:200px;" >

									</div>

								</div>

								</li>

									<li>

								<div class="form_grid_12">

									<label class="field_title">Total Ewallet Amount Available</label>

									<div class="form_input">

										$<?php echo $amount ;?>

									</div>

								</div>

								</li>

								<li>

								<div class="form_grid_12">

									<label class="field_title">Total Price</label>

									<div class="form_input">

									$<?php echo round($cost, 2) ;?>

									

									</div>

								</div>

								</li>

							

								<li>

								<div class="form_grid_12">

									<div class="form_input">

										<button type="submit" class="btn_small btn_gray" name="ewallet"><span>Purchase Now</span></button>

										<!--<button type="reset" class="btn_small btn_gray"><span>Back</span></button>-->

										

									</div>

								</div>

								</li>

							</ul>

						</form>

 				<?php }else{ ?>

                <ul>

								<li>

								<div class="form_grid_12">

									<label class="field_title">&nbsp;</label>

									<div class="form_input">You did not have sufficient balance in your E-wallet.

									</div>

								</div>

								</li>

								</ul>

                

                <?php } ?>

		</div>



  

  </div>

			<div class="clr"></div>

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