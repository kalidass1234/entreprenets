<?php
include('../includes/all_func.php');
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
 $idd=$_SESSION['SD_User_Name'];
 $s="select * from registration where user_name='$idd'";
 $r=mysql_query($s);
 $f=mysql_fetch_array($r);
 $id=$f['user_id'];
 $_SESSION['payment_mode']='Cash Wallet';
 $res_user=mysql_query("select * from registration where user_id='$id'");
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}

if($_SESSION['Session_Rand_No']==$_REQUEST['Session_id'])
{
}
else
{
	header("Location:upgrade_payment_package.php?msg=wrong url access"); exit;
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title><?php echo $TITLE_USER;?></title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/layout.css" rel="stylesheet" type="text/css">
<link href="css/themes.css" rel="stylesheet" type="text/css">
<link href="css/typography.css" rel="stylesheet" type="text/css">
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link href="css/shCore.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/jquery.jqplot.css" rel="stylesheet" type="text/css">
<link href="css/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css">
<link href="css/data-table.css" rel="stylesheet" type="text/css">
<link href="css/form.css" rel="stylesheet" type="text/css">
<link href="css/ui-elements.css" rel="stylesheet" type="text/css">
<link href="css/wizard.css" rel="stylesheet" type="text/css">
<link href="css/sprite.css" rel="stylesheet" type="text/css">
<link href="css/gradient.css" rel="stylesheet" type="text/css">
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="css/ie/ie7.css" />
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="css/ie/ie8.css" />
<![endif]-->
<!--[if IE 9]>
<link rel="stylesheet" type="text/css" href="css/ie/ie9.css" />
<![endif]-->
<!-- Jquery -->
<script src="js/jquery-1.7.1.min.js"></script>
<script src="js/jquery-ui-1.8.18.custom.min.js"></script>
<script src="js/chosen.jquery.js"></script>
<script src="js/uniform.jquery.js"></script>
<script src="js/bootstrap-dropdown.js"></script>
<script src="js/bootstrap-colorpicker.js"></script>
<script src="js/sticky.full.js"></script>
<script src="js/jquery.noty.js"></script>
<script src="js/selectToUISlider.jQuery.js"></script>
<script src="js/fg.menu.js"></script>
<script src="js/jquery.tagsinput.js"></script>
<script src="js/jquery.cleditor.js"></script>
<script src="js/jquery.tipsy.js"></script>
<script src="js/jquery.peity.js"></script>
<script src="js/jquery.simplemodal.js"></script>
<script src="js/jquery.jBreadCrumb.1.1.js"></script>
<script src="js/jquery.colorbox-min.js"></script>
<script src="js/jquery.idTabs.min.js"></script>
<script src="js/jquery.multiFieldExtender.min.js"></script>
<script src="js/jquery.confirm.js"></script>
<script src="js/elfinder.min.js"></script>
<script src="js/accordion.jquery.js"></script>
<script src="js/autogrow.jquery.js"></script>
<script src="js/check-all.jquery.js"></script>
<script src="js/data-table.jquery.js"></script>
<script src="js/ZeroClipboard.js"></script>
<script src="js/TableTools.min.js"></script>
<script src="js/jeditable.jquery.js"></script>
<script src="js/duallist.jquery.js"></script>
<script src="js/easing.jquery.js"></script>
<script src="js/full-calendar.jquery.js"></script>
<script src="js/input-limiter.jquery.js"></script>
<script src="js/inputmask.jquery.js"></script>
<script src="js/iphone-style-checkbox.jquery.js"></script>
<script src="js/meta-data.jquery.js"></script>
<script src="js/quicksand.jquery.js"></script>
<script src="js/raty.jquery.js"></script>
<script src="js/smart-wizard.jquery.js"></script>
<script src="js/stepy.jquery.js"></script>
<script src="js/treeview.jquery.js"></script>
<script src="js/ui-accordion.jquery.js"></script>
<script src="js/vaidation.jquery.js"></script>
<script src="js/mosaic.1.0.1.min.js"></script>
<script src="js/jquery.collapse.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/jquery.autocomplete.min.js"></script>
<script src="js/localdata.js"></script>
<script src="js/excanvas.min.js"></script>
<script src="js/jquery.jqplot.min.js"></script>
<script src="js/custom-scripts.js"></script>
</head>
<body id="theme-default" class="full_block">
<?php
include('left-bar.php');
?>
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
	<!--<div class="page_title">
		<span class="title_icon"><span class="coverflow"></span></span>
		<h3>Add a Credit or Debit Card </h3>
		<div class="top_search">
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
		</div>
	</div>-->
	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
				
					<div class="widget_top">
						<!--<span class="h_icon list"></span>-->
						<h6>Payment Through Cash Wallet</h6>
						<!--<div id="widget_tab">
							<ul>
								<li><a href="#tab1" class="active_tab">Compose Message</a></li>
								
								<li><a href="inbox.php">Indox</a></li>
								<li><a href="#tab3">Sent </a></li>
							</ul>
						</div>-->
					</div>
					<!--<div class="widget_content">
					<div>-->
				
						<div id="tab1">
							<div class="oilhold">
							<?php
								$rowcard2=mysql_fetch_assoc($res_user);
								//print_r($rowcard2);
							?>
   							<form action="upgrade.php?userupgrade=true&Session_id=<?php echo $_SESSION['Session_Rand_No'];?>" method="post" class="form_container left_label">
							<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Total Amount To Be Deduct From Wallet</label>
									<div class="form_input">
										160 USD
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Amount in Cash Wallet</label>
									<div class="form_input">
										<?php
                                        $sql_cw="select amount from final_e_wallet where user_id='$rowcard2[user_id]'";
										$res_cw=mysql_query($sql_cw);
										$row_cw=mysql_fetch_assoc($res_cw);
										echo $row_cw['amount'];
										?>
									</div>
								</div>
								</li>
                                <?php 
								if($row_cw['amount']>=160):
								?>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Transaction password.</label>
									<div class="form_input">
										<input name="t_code" type="password" value="" required tabindex="7" style="width:44%;" />
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<div class="form_input"><input type="hidden" id="user_id" name="user_id" value="<? echo $id;?>" />
									<input type="hidden" id="edit" name="edit" value="<? echo $id;?>" />
										<button type="submit" name="submit" tabindex="13" class="btn_small btn_gray"><span>Make Payment</span></button>
									</div>
								</div>
								</li>
                                <?php 
								else:
								?>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">&nbsp;</label>
									<div class="form_input">
										You have not sufficient balance in your Cash Wallet.
									</div>
								</div>
								</li>
                                <?php
                                endif;
								?>
							</ul>
						</form>
            				</div>	
            			</div>
            		</div>
            	</div>
           	 </div>
		</div>
	</div>
		<span class="clear"></span>
</div>
</div>
</body>
</html>