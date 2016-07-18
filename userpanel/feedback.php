<?php
include('../includes/all_func.php');
error_reporting(0);
session_start();
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
$idd=$_SESSION['SD_User_Name'];
$id=showuserid($_SESSION['SD_User_Name']);
$sql="select * from purchase_detail where invoice_no='$_REQUEST[invoice_no]'";
$res=mysql_query($sql);
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
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
<style>
.binary_line1{background: url(images/topline.gif) no-repeat center top;border-top: solid #000 2px;}
</style>
<script language="javascript">
function search_node(val)
{
	if(val=='jdate')
	{
		document.getElementById('search-td2').style.display='table-row';
		document.getElementById('search-td1').style.display='none';
	}
	else if(val=='unm')
	{
		document.getElementById('search-td2').style.display='none';
		document.getElementById('search-td1').style.display='table-row';
		document.getElementById('ch_text').innerHTML='Enter Affiliate Login Name';
		document.getElementById('uid').name='unm';
	}
	else if(val=='uid')
	{
		document.getElementById('search-td2').style.display='none';
		document.getElementById('search-td1').style.display='table-row';
		document.getElementById('ch_text').innerHTML='Enter Affiliate User ID';
		document.getElementById('uid').name='uid';
	}
}
</script>
<!--<script src='js/jquery-1.5.min.js' type="text/javascript"></script>-->
<!--	<script src='../star-rating/jquery.MetaData.js' type="text/javascript" language="javascript"></script>
 <script src='../star-rating/jquery.rating.js' type="text/javascript" language="javascript"></script>
 <link href='../star-rating/jquery.rating.css' type="text/css" rel="stylesheet"/>
 <style>
  span.stars1, span.stars1 span {
    display: block;
    background: url( star-rating/star.png) 0 -16px repeat-x;
    width: 80px;
    height: 16px;
}

span.stars1 span {
    background-position: 0 0;
}
 </style>-->

<!--<script type="text/javascript" language="javascript">
$(function(){ 
 $('.form11 :radio.star').rating(); 
 $('#form2 :radio.star').rating({cancel: 'Cancel', cancelValue: '0'}); 
});
</script>
<script>
$(function(){
 $('#tab-Testing form').submit(function(){
  $('.test',this).html('');
  $('input',this).each(function(){
   if(this.checked) $('.test',this.form).append(''+this.name+': '+this.value+'<br/>');
		});
  return false;
 });
});
</script>-->
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
	<div class="page_title">
		<span class="title_icon"><span class="coverflow"></span></span>
		<h3>Support</h3>
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
				<div class="widget_wrap tabby">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Leave Feedback</h6>
						<!--<div id="widget_tab">
							<ul>
								<li><a href="#tab1" class="active_tab">Raise Ticket</a></li>
								
								<li><a href="#tab2">View Ticket Response</a></li>
								
							</ul>
						</div>-->
					</div>
					<div class="widget_content">
					<div>
						
					</div>
						<div id="tab1">
							<div class="rightmain">
								 <div id="announcer" >
								  <!--<div class="subheading"><a href="index.html">Home</a> >> Support</div>-->
									  <div class="oilhold">
								<?php 
									while($row=mysql_fetch_assoc($res))
									{
								?>
									<form action="feedback_func.php?invoice_no=<?php echo $_REQUEST['invoice_no'];?>" method="post" class="form_container left_label">
															<ul>
															
																<li>
																<div class="form_grid_12">
																	<label class="field_title">Product / Seller </label>
																	<div class="form_input">
																		<?php echo get_product_name($row['p_id'])."/".showusername($row['seller_id']);?> 
																	</div>
																</div>
																</li>
																
																<li>
																<div class="form_grid_12">
																	<label class="field_title">Rate This Seller </label>
																	<div class="form_input">
																		<div class="form11">
																			<input class="star" checked="checked" type="radio" name="rating" value="1"/>1
																			<input class="star" type="radio" name="rating" value="2"/>2
																			<input class="star" type="radio" name="rating" value="3"/>3
																			<input class="star" type="radio" name="rating" value="4"/>4
																			<input class="star" type="radio" name="rating" value="5"/>5
																		</div>
																		
																	</div>
																</div>
																<br>
																</li>
															
																<?php
																	$sql_rate="select * from seller_review where user_id='$id' and p_id='$row[p_id]'";
																	$res_rate=mysql_query($sql_rate);
																	while($row_rate=mysql_fetch_assoc($res_rate))
																	{
																?>
																<li>
																<div class="form_grid_12">
																	<label class="field_title">You Give Star:&nbsp;<?php echo $row_rate['rating'];?> <br>
																	<?php
	$cid=$row_rate['id'];
	$sqlyn="SELECT `help_yes_count` , `help_no_count` , sum( `help_yes_count` + `help_no_count` ) as total FROM `product_review` where id='$cid'";
	$resyn=mysql_query($sqlyn);
	$rowyn=mysql_fetch_assoc($resyn);
	?>
	<?php echo $rowyn['help_yes_count'];?> outof <?php echo $rowyn['total'];?> fond this review helpful
																	</label>
																	<div class="form_input">
																		<?php echo $row_rate['remark'];?>
																	</div>
																</div>
																<br>
																</li>
																<?php
																	}
																?>
																<li>
																<div class="form_grid_12">
																	<label class="field_title">Message </label>
																	<div class="form_input">
																		<textarea name="filed06" required class="input_grow" cols="50" rows="5" tabindex="5" ></textarea>
																	</div>
																</div>
																</li>
																
																
																<li>
																<div class="form_grid_12">
																	<div class="form_input">
																	<input type="hidden" name="pid" value="<?php echo $row['p_id'];?>">
																	<input type="hidden" name="seller_id" value="<?php echo $row['seller_id'];?>">
																	<input type="hidden" name="section" value="<?php echo get_section($row['p_id']);?>">
																		<button type="submit" class="btn_small btn_gray"><span>Leave Feedback</span></button>
																		<a href="purchase_order.php"><button type="button" class="btn_small btn_gray"><span>Back</span></button></a>
																		
																	</div>
																</div>
																</li>
																
															</ul>
														</form>
										<?php
											}
										?>
								</div>
								  </div>
								<div class="clr"></div>
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