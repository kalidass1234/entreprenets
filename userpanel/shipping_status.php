<?php
error_reporting(E_ALL ^ E_NOTICE);
include('../includes/all_func.php');
session_start();

if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	$add_by=$_SESSION['SD_User_Name'];
	$s="select user_id,paid_to,paypal_account from registration where user_name='$add_by'";
	$r=mysql_query($s);
	$f=mysql_fetch_array($r);
	$userid=$f['user_id'];
	//echo "select * from purchase_detail as pd inner join product_category as pc where pd.ship_status=1 and pd.user_id='$userid' and pd.p_id=pc.p_cat_id";
	$res_user=mysql_query("select * from purchase_detail as pd inner join product_category as pc where pd.ship_status=1 and pd.user_id='$userid' and pd.p_id=pc.p_cat_id");
	
	mysql_query("update purchase_detail set read_receiver=0 where  user_id='$userid'");
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
		<h3>Shipping Detail</h3>
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
						<h6>Shipping Detail :</h6>
					</div>
					<div class="widget_content">
					<?php 
					$user_id=showuserid($_SESSION['SD_User_Name']);
					$sql_user2=mysql_query("select * from registration where user_id='$user_id'");
					$res_user2=mysql_fetch_assoc($sql_user2);
					$sql_subs="select * from subscription where user_id='$user_id' and status=0 and type='2'";
					$res_subs=mysql_query($sql_subs);
					$count_subs=mysql_num_rows($res_subs);
					if(($res_user2['category_two'] && $count_subs) || $res_user2['category_one'] || $res_user2['category_three'])
					{
					?>
						<table class="display data_tbl" border="0">
						<thead>
					
						<tr>
							<!--<th>
								 Invoice No 
							</th>
							
							<th>
								Invoice Date
							</th>
							<th>
								 Product Name
							</th>
							<th>
								 Image
							</th>-->
                            <th>
								 Shipping Date
							</th>
                            <th>
								 Tracking Number
							</th>
                            <th>
								 Delivery Date
							</th>
                            <th>
								 AIR
							</th>
                            <th>
								 Ground
							</th>
							<th>
								 Company Name
							</th>
							
							<th>
								 Shipping Status
							</th>
							
						</tr>
						</thead>
						<tbody>
                        <!--<tr>
							<td class="center">
								12/21/2013
							</td>
							<td class="center">
								 000816679
							</td>
                            <td class="center">
								 12/26/2013
							</td>
                            <td class="center">
								 AIR
							</td>
                            <td class="center">
								 
							</td>
                            <td class="center">
								 UPS
							</td>
                            <td class="center">
								 Pending
							</td>
						</tr>
                        <tr>
							<td class="center">
								12/21/2013
							</td>
							<td class="center">
								 000816677
							</td>
                            <td class="center">
								 12/26/2013
							</td>
                            <td class="center">
								 
							</td>
                            <td class="center">
								 Ground
							</td>
                            <td class="center">
								 USPS
							</td>
                            <td class="center">
								 Delivered
							</td>
						</tr>-->
						<?php
						$sql="select * from amount_detail where shipping_status not in (0) and user_id='$user_id'";
	  					$res=mysql_query($sql);
						$c=1;
						while($row=mysql_fetch_assoc($res))
						{
						
						?>
						<tr>
							<td class="center">
								 <?php if($row['shipping_date']=='0000-00-00'){ echo "NA";}else{echo date('m-d-Y',strtotime($row['shipping_date']));}?>
							</td>
							
							
							<td class="center">
								 <?php echo $row['shipping_track_no'];?>
							</td>
                            <td class="center">
								 <?php if($row['delivery_date']=='0000-00-00'){ echo "NA";}else{echo date('m-d-Y',strtotime($row['delivery_date']));}?>
							</td>
                            <td class="center">
								 <?php if($row['shiping_air_ground']=='AIR'){ echo $row['shiping_air_ground'];}?>
							</td>
                            <td class="center">
								 <?php if($row['shiping_air_ground']=='Ground'){ echo $row['shiping_air_ground'];}?>
							</td>
                            <td class="center">
								 <?php echo $row['shipping_company'];?>
							</td>
							
							<td class="center">
								<?php 
								if($row['shipping_status']==1){ echo "Pending";}
								else if($row['shipping_status']==2){ echo "Dilivered";}
								else if($row['shipping_status']==3){ echo "Return";}
								else if($row['shipping_status']==0){ echo "Not Shipped";}
								?>
								
							</td>
							
						</tr>
						<?php
						$c++;
						}
						?>
					
						
						</tbody>
						
						</table>
                      <?php
                      }
					  else
					  {
					  echo "<p>You Have Not Access This Part.</p>";
					  }
					  ?>  
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
</body>
</html>