<?php
include('../includes/all_func.php');
error_reporting(0);
session_start();
$id=$_GET['id'];
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	$user_id=showuserid($_SESSION['SD_User_Name']);		
	 $res_user=mysql_fetch_array(mysql_query("select * from registration where user_id='$user_id'"));
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
  
        <!-- The plugin stylehseet -->
        <link rel="stylesheet" href="vtncard/jquery.bubbleSlideshow/jquery.bubbleSlideshow.css" />
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
	<div class="page_title">
		<span class="title_icon"><span class="coverflow"></span></span>
		<h3>Upgrade Payment Package</h3>
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
					<div class="widget_top">
						<span class="h_icon list_image"></span>
						<h6>Upgrade Payment Package</h6>
					</div>
     <style>
.form_container ul li {
	background: url(../images/dot.png) repeat-x bottom;
position: relative;
padding: 5px 15px 15px 10px;
}
	 </style>           
					<div class="widget_content" style="background-color:#FFFFFF">
			
					  <form action="upgrade_one.php" name="addproduct" id="addproduct" method="post" class="form_container left_label" enctype="multipart/form-data">
							<ul>
								<li>
                                <h3 style="color: #800080;">Upgrade Payment Package</h3>
								<div class="norm_text">
										<p>
                              <table width="100%">
                                        
                                        <tr style="line-height: 40px; background: #009ea0; color: #fff; text-transform: uppercase;">
                                        <th width="40%">&nbsp;</th>
                                        <th width="20%"><div align="left">&nbsp;&nbsp;3 Months</div></th>
                                        <th width="20%"><div align="left">&nbsp;&nbsp;6 Months</div></th>
                                        <th width="20%"><div align="left">&nbsp;&nbsp;12 Months</div></th>                                        
                                <tr>
                                <?php 
								if($res_user['category_one'])
								{
								?>
                                <tr>
                                        <td height="30" valign="bottom"><div align="center"><strong>Discount Benefit Members</strong></div></td>
                                        <td height="30" valign="bottom"><div align="left">
                                          <input type="radio" name="upgrade_one" value="1_3_1" />
                                          &nbsp;&nbsp;$89.97</div></td>
                                        <td height="30" valign="bottom"><div align="left">
                                          <input type="radio" name="upgrade_one" value="2_6_1" />
                                          &nbsp;&nbsp;$179.94</div></td>
                                        <td height="30" valign="bottom"><div align="left">
                                          <input type="radio" name="upgrade_one" value="3_12_1" />
                                          &nbsp;&nbsp;$359.88</div></td>
                                 </tr>
                                 <?php
                                 }
								 ?> 
                                <?php 
								if($res_user['category_two'])
								{
								?>      
                                <tr>
                                        <td height="30" valign="bottom"><div align="center"><strong>Discount Benefit Members + Residual Income</strong></div></td>
                                       <td height="30" valign="bottom"><div align="left">
                                         <input type="radio" name="upgrade_one" value="4_3_2" />
                                         &nbsp;&nbsp;$254.94</div></td>
                                        <td height="30" valign="bottom"><div align="left">
                                          <input type="radio" name="upgrade_one" value="5_6_2" />
                                          &nbsp;&nbsp;$509.88</div></td>
                                        <td height="30" valign="bottom"><div align="left">
                                          <input type="radio" name="upgrade_one" value="6_12_2" />
                                          &nbsp;&nbsp;$1,019.76</div></td>
                                </tr>
                                
                                <?php
                                }
								?>
                                <?php 
								if($res_user['category_three'])
								{
								?>        
                                <tr>
                                        <td height="30" valign="bottom"><div align="center"><strong>Affiliated Referral</strong></div></td>
                                        <td height="30" valign="bottom"><div align="left">&nbsp;&nbsp;NA</div></td>
                                        <td height="30" valign="bottom"><div align="left">&nbsp;&nbsp;NA</div></td>
                                        <td height="30" valign="bottom"><div align="left">
                                          <input type="radio" name="upgrade_one" value="7_12_3" />
                                          &nbsp;&nbsp;$150</div></td>
                                        
                                </tr>
                                 <?php
                                 }
								 ?>       
                                  </table>
                                        </p>
                                      
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
								  <label class="field_title" >&nbsp; </label>
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="12"><span>Upgrade</span></button>
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

