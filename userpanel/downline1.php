<?php
include('../includes/all_func.php');
error_reporting(0);
session_start();
$id=$_GET['id'];
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	$sql_product=mysql_fetch_array(mysql_query("SELECT * FROM registration WHERE user_id='$id'"));	
}
else
{
	echo "<script language='javascript'>window.location.href='login.php';</script>";exit;
}

$sql="select * from product_category where p_cat_id=$pid ";
$res=mysql_query($sql);
$row=mysql_fetch_assoc($res);
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
<script src="js/chart-plugins/jqplot.dateAxisRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.cursor.min.js"></script>
<script src="js/chart-plugins/jqplot.logAxisRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.canvasTextRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.highlighter.min.js"></script>
<script src="js/chart-plugins/jqplot.pieRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.barRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script src="js/chart-plugins/jqplot.pointLabels.min.js"></script>
<script src="js/chart-plugins/jqplot.meterGaugeRenderer.min.js"></script>
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
	<div class="page_title">
		<span class="title_icon"><span class="coverflow"></span></span>
		<h3>Downline: <?=  $sql_product[user_name] ?></h3>
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
	</div>
	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list_image"></span>
						<h6>Downline: <?=  $sql_product[user_name] ?></h6>
					</div>
					<div class="widget_content">
						<h3>Downline: <?=  $sql_product[user_name] ?></h3>
						
						<form action="" name="addproduct" id="addproduct" method="post" class="form_container left_label" enctype="multipart/form-data">
							<ul>
							<li>
								<div class="form_grid_12">
									<label class="field_title">User Id </label>
									<div class="form_input">
										<?= $sql_product[user_id]; ?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Upline Id </label>
									<div class="form_input">
										<?= $sql_product[nom_id]; ?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Sponser Id </label>
									<div class="form_input">
										<?= $sql_product[ref_id]; ?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">User Name </label>
									<div class="form_input">
										<?= $sql_product[user_name]; ?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Name </label>
									<div class="form_input">
										<?= $sql_product[first_name].' '.$sql_product[mid_name].' '.$sql_product[last_name]; ?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Date Of Birth </label>
									<div class="form_input">
										<?= date('d, M Y',strtotime($sql_product[dob])); ?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Address </label>
									<div class="form_input">
										<!--<textarea rows="7" cols="70">--><?= $sql_product[address]; ?>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">City </label>
									<div class="form_input">
										<?= $sql_product[city]; ?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">State </label>
									<div class="form_input">
										<?= $sql_product[state]; ?>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Country </label>
									<div class="form_input">
										<?= $sql_product[country]; ?>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Zip Code </label>
									<div class="form_input">
										<?= $sql_product[zip]; ?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Phone </label>
									<div class="form_input">
										<?= $sql_product[phoner]; ?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Mobile No</label>
									<div class="form_input">
										<?= $sql_product[mobile]; ?>
									</div>
								</div>
								</li><li>
								<div class="form_grid_12">
									<label class="field_title">Email Id </label>
									<div class="form_input">
										<?= $sql_product[email]; ?>
									</div>
								</div>
								</li>
								
							
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="genealogydoenline.php"><button type="button" class="btn_small btn_gray"><span>Back</span></button></a>
										
									</div>
								</div>
								</li>
								
							</ul>
						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
</body>
</html>