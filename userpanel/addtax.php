<?php
include('../includes/all_func.php');
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$id=$_GET['id'];
$edit=$_GET['edit'];
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
  if(showusertype($_SESSION['SD_User_Name'])=='business')
  {
		 $idd=showuserid($_SESSION['SD_User_Name']);
		 if(isset($_POST['submit']))
		 {
			if(isset($_POST['edit']) && $_POST['tax_id'])
			{
			$stid=$_POST['state'];
			$sql_s=mysql_query("select * from states where id='$stid'");
			$res_s=mysql_fetch_assoc($sql_s);
			$state_code=$res_s['abbreviation'];
			$state_name=$res_s['state'];
				mysql_query("update tax set created_by_user='{$_SESSION['SD_User_Name']}', tax='{$_POST['tax']}', state_id='{$_POST['state']}',state_code='$state_code',state_name='$state_name', user_id='$idd' where id='{$_POST['tax_id']}'");
			?>
					<script type="text/javascript">
					alert("Tax Update Successfully.");
					window.location.href='showtax.php';
					</script>
			<?php
			}
			else
			{
			$stid=$_POST['state'];
			$sql_s=mysql_query("select * from states where id='$stid'");
			$res_s=mysql_fetch_assoc($sql_s);
			$state_code=$res_s['abbreviation'];
			$state_name=$res_s['state'];		
					mysql_query("INSERT INTO tax set created_by_user='{$_SESSION['SD_User_Name']}', tax='{$_POST['tax']}', state_id='{$_POST['state']}',state_code='$state_code',state_name='$state_name', user_id='$idd'");
			?>
					<script type="text/javascript">
					alert("Tax added successfully.");
					window.location.href='showtax.php';
					</script>
			<?php
			}
		}
		if($id && $edit)
		{
			$str1="select * from tax where user_id='$idd' and id='$id' order by id desc";
			$res1=mysql_query($str1);
			$x1=mysql_fetch_array($res1);
		}
	}
	else
	{
		echo "<script language='javascript'>window.location.href='error.php';</script>";exit;
	}	
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
<script src="js/validationOnNumber.js"></script>
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
		<h3>Taxes</h3>
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
					<div class="widget_wrap tabby">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add Tax </h6>
						<!--<div id="widget_tab">
							<ul>
								<li><a href="#tab1" class="active_tab">Compose Message</a></li>
								
								<li><a href="inbox.php">Indox</a></li>
								<li><a href="#tab3">Sent </a></li>
							</ul>
						</div>-->
					</div>
					<div class="widget_content">
					<div>
						
					</div>
						<div id="tab1">
							<div class="oilhold">
   							<form action="addtax.php" method="post" class="form_container left_label">
							<ul>
								<!--<li>
								<div class="form_grid_12">
									<label class="field_title">User Name</label>
									<div class="form_input">
										<input name="u_name" type="text" tabindex="1" class="" style="width:44%;" />
									
									</div>
								</div>
								</li>-->
								<li>
								<div class="form_grid_12">
									<label class="field_title">Tax Name</label>
									<div class="form_input">
                                    <?php
                                    $sql_s="select * from states ";
									$res_s=mysql_query($sql_s);
									?>
										<select name="state" required class="chzn-select">
                                        <option value="">Select State</option>
                                        <?php
                                        while($row_s=mysql_fetch_assoc($res_s))
										{
										?>
										<option value="<?php echo $row_s['id'];?>" <?php if($row_s['id']==$x1['state_id']){ echo "selected";}?>><?php echo $row_s['state'];?></option>
										<?php
										}
										?>
                                        </select>
									</div>
								</div>
								</li>
							<li>
								<div class="form_grid_12">
									<label class="field_title">Tax(%)</label>
									<div class="form_input">
										<input name="tax" type="text" onBlur="extractNumber(this,2,false);" onKeyUp="extractNumber(this,2,false);" onKeyPress="return blockNonNumbers(this, event, true, false);" value="<?=$x1['tax'];?>" tabindex="2" style="width:44%;" required />
										
									</div>
								</div>
								</li>
								
								
								
								<li>
								<div class="form_grid_12">
									<div class="form_input"><input type="hidden" id="tax_id" name="tax_id" value="<? echo $id;?>" />
									<input type="hidden" id="edit" name="edit" value="<? echo $edit;?>" />
										<button type="submit" name="submit" class="btn_small btn_gray"><span><?php if($edit) echo "Edit"; else echo "Add";?> Tax</span></button>
										<button type="reset" class="btn_small btn_gray"><span>Reset</span></button>
										
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
		<span class="clear"></span>
	</div>
</div>
</body>
</html>