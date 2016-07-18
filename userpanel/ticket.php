<?php
include('../includes/all_func.php');
error_reporting(0);
session_start();
$id=$_GET['id'];
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	 $sql_welcome=mysql_fetch_array(mysql_query("SELECT * FROM static_page order by id desc limit 0,1"));	
	 $res_user=mysql_fetch_array(mysql_query("select * from registration where user_name='{$_SESSION['SD_User_Name']}'"));
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
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list_image"></span>
						<h6>Support</h6>
					</div>
					<div class="widget_content">
						<h3>View Response</h3>
						
						<table class="display ">
						<thead>
						<tr>
							<th>
								  Name
							</th>
							<th>
								  Ticket No
							</th>
							<th>
								 Subject
							</th>
							<th>
								 Category
							</th>
							
							<th>
								 Request Date
							</th>
							<th>
								 Response Date
							</th>
						
						</tr>
						</thead>
						<tbody>
						<?php
						$idd=showuserid($_SESSION['SD_User_Name']);
						  $str_pin="select * from tickets where  user_id='$idd' AND id='$id'";
						  $res_pin=mysql_query($str_pin);
							$sr=1;			  
						  while($x=mysql_fetch_array($res_pin))
						  {
						   $idx=showuserid($_SESSION['SD_User_Name']);;
						  $str="select * from registration where user_id='$idx'";
							$res=mysql_query($str);
							$xy=mysql_fetch_array($res);
							$name=$xy['first_name']." ".$xy['mid_name']." ".$xy['last_name'];
			 			 ?>
							<tr>
                                  <td align="center" class="ptext"><?=$name?></td>
								  <td align="center" class="ptext"><?=$x['id']?></td>
                                  <td align="center" class="ptext"><?=substr($x['subject'],0,35)?><br><?=substr($x['subject'],36,35)?><br><?=substr($x['subject'],73,35)?></td>
                                  <td align="center" class="ptext"><?=$x['tasktype']?></td>
                                 
                                  <td align="center" class="ptext"><?=date('d, M Y',strtotime($x['t_date']))?></td>
                                  <td align="center" class="ptext"><?php echo ($x[c_t_date]!='0000-00-00') ? date('d, M Y',strtotime($x[c_t_date])) : '-';?></td>
								 
                                </tr>
                                <?
								}
								?>
						
						</tbody>
						<tfoot>
						
						</tfoot>
						</table>
					</div>
					<?php
						  $str_pin="select * from tickets where  user_id='$idd' AND id='$id'";
						  $res_pin=mysql_query($str_pin);
							$sr=1;			  
						  $x=mysql_fetch_array($res_pin);
						 
						   $idx=$idd;
						  $str="select * from registration where user_id='$idx'";
							$res=mysql_query($str);
							$xy=mysql_fetch_array($res);
							$name=$xy['first_name']." ".$xy['mid_name']." ".$xy['last_name'];
							
			 			 ?>
					<div class="oilhold">
					<table class="display ">
						<thead>
						<tr>
							<th align="left">
								  ShopDeal Admin							</th>
							<th align="right">
								 <?php echo ($x[c_t_date]!='0000-00-00') ? date('d, M Y',strtotime($x[c_t_date])) : ''; ?>						</th>
						</tr>
						</thead>
						<tbody>
						
							<tr>
                                  <td colspan="2"  class="ptext"><?php echo ($x['response']!='') ? $x['response'] : 'We will response soon.';?></td>
                                </tr>
						</tbody>
						<tfoot>
						</tfoot>
						</table>
 
		</div>
		<div class="oilhold">
					<table class="display ">
						<thead>
						<tr>
							<th align="left">
								 <?= $name ?>
							</th>
							<th align="right">
								  <?= date('d, M Y',strtotime($x[t_date])) ?>
							</th>
							
						</tr>
						</thead>
						<tbody>
						<tr>
                                  <td colspan="2"  class="ptext"><?=$x['description']?></td>
                                </tr>
						</tbody>
						<tfoot>
						
						</tfoot>
						</table>
 
		</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
</body>
</html>