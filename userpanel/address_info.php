<?php
include('../includes/all_func.php');
error_reporting(0);
session_start();

if(isset($_SESSION) && $_SESSION['adid'])
{
$idd=$_SESSION['adid'];

$s="select * from registration where user_name='$idd'";
$r=mysql_query($s);
$f=mysql_fetch_array($r);
$id=$f['user_id'];
	 if(isset($_POST) && $_POST['user_id']!='')
	 {
	 	extract($_POST);
		if($country){$country_cond=", country='$country'";}
		//echo "update registration set acc_name='$acc_name',ac_no='$ac_no',bank_nm='$bank_nm',branch_nm='$branch_nm',swift_code='$swift_code' where user_id='$id'";
		$res=mysql_query("update registration set address1='$address1',city='$city',state='$state',zip='$zip' $country_cond where user_id='$id'");
		$rowcount=mysql_affected_rows();
		if($_POST['refferal']!='')
		{
			header("Location:".$_POST['refferal']);
		}
	 }	
	 $res_user=mysql_query("select * from registration where user_id='$id'");
}
else
{
	echo "<script language='javascript'>window.location.href='../index.php';</script>";exit;
}



?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Welcome To Pridezone</title>
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
<script type="text/javascript" src="../dist/country.js"></script>
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
						<h6>Add Address Info </h6>
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
   							<form action="" method="post" class="form_container left_label">
							<ul>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Address</label>
									<div class="form_input">
										<input name="address1" type="text" value="<?php echo $rowcard2['address1'];?>" required tabindex="6" style="width:44%;" />
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">City</label>
									<div class="form_input">
										<input name="city" type="text" value="<?php echo $rowcard2['city'];?>" required tabindex="8" style="width:44%;" />
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">State</label>
									<div class="form_input">
										<input name="state" type="text" value="<?php echo $rowcard2['state'];?>" required tabindex="7" style="width:44%;" />
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title">Country</label>
									<div class="form_input"><?php echo $rowcard2['country'];?>
										<select name="country" id="country" class="chzn-select" ></select>
										<script language="javascript">
                                          populateCountries("country");
                                          // populateCountries("country2");
                                        </script>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Zip</label>
									<div class="form_input">
										<input name="zip" type="text" value="<?php echo $rowcard2['zip'];?>" required tabindex="7" style="width:44%;" />
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input"><input type="hidden" id="user_id" name="user_id" value="<? echo $id;?>" />
									
									<input type="hidden" id="edit" name="edit" value="<? echo $id;?>" />
                                    <input type="hidden" id="refferal" name="refferal" value="<? echo $_GET['refferal_link'];?>" />
										<button type="submit" name="submit" tabindex="13" class="btn_small btn_gray"><span><?php if($id){ echo "Edit";} else echo "Add";?> Address </span></button>
										<button type="reset" class="btn_small btn_gray" tabindex="14"><span>Reset</span></button>
										
									</div>
								</div>
								</li>
								<?php if($rowcount>0){?>
								<li>
								<div class="form_grid_12">
									
									<div class="form_input">
										<font color="#FF0000" size="2">Bank Info Updated Successfully</font>
									</div>
								</div>
								</li>
								<?php }?>
								
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