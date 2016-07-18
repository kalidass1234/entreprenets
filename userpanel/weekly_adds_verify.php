<?php
include('../includes/all_func.php');
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	 $res_user=mysql_fetch_array(mysql_query("select * from registration where user_name='{$_SESSION['SD_User_Name']}'"));
	$user_id=showuserid($_SESSION['SD_User_Name']);
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
						<h6>Verify Adds</h6>
						<div id="widget_tab">
							<ul>
								<li><a href="next_step.php"><img src="package_img/PREVIOUS STEP.png"  height="35" alt="" border="0" /></a></li>
								<li><a href="weekly_add_central.php"><img src="package_img/NEXT STEP.png" height="35"  alt="" border="0" /></a></li>
							</ul>
						</div>
					</div>
					<!--<div class="widget_content">
					<div>-->
<div id="tab1">
                    <div class="oilhold">
    <?php
	if($res_user['reseller']):
	$sdate=date('Y-m-d');
    $sql_adds="select * from weekly_adds_mp where user_id='$user_id' and status=0 and add_date='$sdate'";
    $res_adds=mysql_query($sql_adds);
	$arr_add_count=array("","AddAccount");
    ?>
    <?php $host_name."/product-detail.php?pid=".$row_adds['product_id']; ?>
              <form action="submit.php" method="post" class="form_container left_label">
              <input type="hidden" name="action" value="Veirfy_Adds">
               <ul>
                  <li>
                   <div class="form_grid_12">
                      <label class="field_title">My AddModule</label>
                      <div class="form_input">
                        <select name="weekly_adds_id" id="weekly_adds_id" class="chzn-select" tabindex="12" required>
                          <option value="">Select My AddModule</option>
                        <?php
						while($row_adds=mysql_fetch_assoc($res_adds))
						{
						?>
                          <option value="<?php echo $row_adds['id']?>">Addmodule<?php echo $row_adds['add_count'];?></option>
                        <?php
						}
						?>
                        </select>
                       </div>
                   </div>
                  </li>
                  <li>
                   <div class="form_grid_12">
                      <label class="field_title">Publishing Site</label>
                      <div class="form_input">
                       <input name="publishing_site" type="text" required value="<?php echo $rowcard2['publishing_site'];?>" tabindex="11" style="width:44%;" />
                      </div>
                   </div>
                 </li>
                 <li>
                  <div class="form_grid_12">
                      <label class="field_title">Ad Link</label>
                      <div class="form_input">
                       <input name="ad_link" type="text" required value="<?php echo $rowcard2['ad_link'];?>" tabindex="11" style="width:44%;" />
                      </div>
                  </div>
                 </li>
                  <li>
                            <div class="form_grid_12">
                      <div class="form_input">
                                <button type="submit" name="submit" tabindex="13" class="btn_small btn_gray"><span>
                                Save</span></button>
                                <button type="reset" class="btn_small btn_gray" tabindex="14"><span>Reset</span></button>
                              </div>
                    </div>
                          </li>
                </ul>
                      </form>
           <?php
           endif;
		   ?>           
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