<?php
include('../includes/all_func.php');
session_start();
$pid=$_GET['pid'];
if(isset($_SESSION) && $_SESSION['SD_User_Name'])
{
	 $res_user=mysql_fetch_array(mysql_query("select * from product_category where p_cat_id='$pid'"));
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
	<div class="page_title">
		<span class="title_icon"><span class="coverflow"></span></span>
		<h3>Market Place Product Profile</h3>
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
						<h6>Item : <?php echo $res_user['product_name'];?></h6><h6>&nbsp;&nbsp;<a href="search.php"> List New Product</a></h6>&nbsp;&nbsp;<h6><a href="products.php"> All Product List</a></h6><h6><a href="../profile.php?pid=<?php echo $pid;?>" target="_blank"> View Product In Market Place</a></h6>
					</div>
					<div class="widget_content">
						<h3>
						<img src="../product_logos/<?php echo $res_user['image'];?>" width="100" height="100">
						<?php
						$sqlimg="select * from images where p_id='$pid'";
						$resimg=mysql_query($sqlimg);
						while($rowimg=mysql_fetch_assoc($resimg))
						{
							?>	<img src="../product_logos/<?php echo $rowimg['p_image'];?>" width="100" height="100"><?php
						}
						?>
						<iframe width='100' height='100' src="<?php echo $res_user['video_link'];?>" frameborder='0' allowfullscreen></iframe>
						</h3>
						
						<form action="" name="addproduct" id="addproduct" method="post" class="form_container left_label" enctype="multipart/form-data">
							<ul>
							<li>
								<div class="form_grid_12">
									<label class="field_title">Category </label>
									<div class="form_input">
										<?php 
										$c_id=$res_user['cat_id'];
										echo mysql_result(mysql_query("select category_name from category_shop where c_id='$c_id'"),0,0);
										 ?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Subcategory: </label>
									<div class="form_input">
										<?php 
										$sub_id=$res_user['sub_id']; 
										echo mysql_result(mysql_query("select sub_name from sub_category where sub_id='$sub_id'"),0,0);
										?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Product Name:</label>
									<div class="form_input">
										<?php echo $res_user['product_name']; ?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Product Quantity:</label>
									<div class="form_input">
										<?php echo $res_user['p_qty']; ?>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Condition: </label>
									<div class="form_input">
										<?php echo $res_user['condition_name']; ?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Make A Deal Price: </label>
									<div class="form_input">
										<?php echo "$".$res_user['ipbo_price']; ?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Buy It Price: </label>
									<div class="form_input">
										<?php if($res_user['cost_price']){ echo "$".$res_user['cost_price'];} else { echo "NA";} ?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Shipping: </label>
									<div class="form_input">
										<?php 
										if($res_user['shipping_economy']){ echo "Economy Shipping : $".$res_user['shipping_economy'].' for '.$res_user['duration_economy'].' days <br>';} 
										if($res_user['shipping_express']){ echo "Express Shipping : $".$res_user['shipping_express'].' for '.$res_user['duration_express'].' days <br>';} 
										if($res_user['shipping_inter']){ echo "International Shipping : $".$res_user['shipping_inter'].' for '.$res_user['duration_inter'].' days <br>';} 
										if(!$res_user['shipping_economy'] && !$res_user['shipping_express'] && !$res_user['shipping_inter']){ echo "Free Shipping";}
										
										 ?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Handling Time: </label>
									<div class="form_input">
										<?php if($res_user['handling_time']){ echo $res_user['handling_time']." Business Day";} ?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Return: </label>
									<div class="form_input">
										<?php if($res_user['item_return']=='no'){ echo "No Return Accepted";} else { echo "Return Accepted";} ?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Add Date:</label>
									<div class="form_input">
										<?php echo date('m/d/Y',strtotime($res_user['add_date']));?>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title">Listing Duration:</label>
									<div class="form_input">
										<?php echo $res_user['duration']." Days";?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Auto Relist Product:</label>
									<div class="form_input">
										<?php if($res_user['autorelist']){ echo "Yes";} else { echo " No";}?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Listing Status:</label>
									<div class="form_input">
										<?php 
										if($res_user['status']=='0'){ echo "Active";}
										if($res_user['status']=='1'){ echo "Inactive";}
										if($res_user['status']=='2'){ echo "Block For Listing";}
										?>
									</div>
								</div>
								</li>
								
								
								<li>
								<div class="norm_text">
									
								
										<p><?php echo strip_tags(substr($res_user['pro_desc'],0,100)); ?>	</p>
									
								</div>
								</li>
								<li>
								<div class="norm_text">
									
								
										<p><a href="add_products.php?edit=edit&pid=<?php echo $res_user['p_cat_id'];?>">Edit</a>	</p>
									
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